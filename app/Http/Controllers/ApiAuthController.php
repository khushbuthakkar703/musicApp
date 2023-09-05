<?php

namespace App\Http\Controllers;

use App\AcceptedCampaign;
use App\AdditionalCampaignMusic;
use App\Advertisement;
use App\CampaignGenre;
use App\City;
use App\Club;
use App\Country;
use App\DesktopVideoInfo;
use App\Dj_Music;
use App\DjEvents;
use App\DjManager;
use App\Helpers\Notification;
use App\Helpers\notification_app;
use App\Helpers\PushNotification;
use App\IdentifiedMusic;
use App\IdentifiedMusicAll;
use App\InviteCode;
use App\MusicType;
use App\State;
use App\User;
use Exception;
use function GuzzleHttp\Psr7\copy_to_string;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\Types\Nullable;
use Symfony\Bridge\PsrHttpMessage\Tests\Fixtures\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Facades\JWTAuth;
use GuzzleHttp\Client;
use Carbon\Carbon;
use App\MusicCampaignAudio;
use App\Dj;
use App\MusicCampaign;
use Illuminate\Support\Facades\Log;
use DB;
use Illuminate\Support\Facades\Validator;

class ApiAuthController extends Controller
{
    //

    public function refresh()
    {
        //        $current_token  = JWTAuth::getToken();
        //        $token          = JWTAuth::refresh($current_token);
        //
        //        return $this->response->array(compact('token'));

        $newToken = JWTAuth::parseToken()->refresh();

        return response()->json(['token' => $newToken]);
    }

    public function login(Request $request)
    {
        $credentials = request()->only('email', 'password');
//        $credentials = array('email'=>trim($request->email), 'password'=>trim($request->password));

        try {
            $token = JWTAuth::attempt($credentials);

            if (!$token) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'something_went_wrong'], 500);
        }

        $user = JWTAuth::toUser($token);
        if($user->blocked == "yes"){
//            return response()->json(["message"=>"blocked"], 200);
        }else if($user->confirmed == 0){
            return response()->json(["message"=>"Please confirm email"], 401);
        }
        if ($request->onesignal_token != null) {
            $user->token = $request->onesignal_token;
            $user->save();
            PushNotification::editUser($user->token, $user->role);
        }

        if ($user->role == 'dj') {
            $dj = $user->dj()->first();
            return response()->json(['token' => $token, 'dj_name' => $dj->dj_name, 'first_name' => $dj->first_name, 'last_name' => $dj->last_name, 'id' => $user->id, 'dj_id' => $dj->id ,'role' => $user->role], 200);
        } else {
            return response()->json(['token' => $token, 'role' => $user->role, 'id' => $user->id], 200);
        }
    }



    public function saveOneToken(Request $request)
    {

        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);

        if ($request->onesignal_token != null) {
            $user->token = $request->onesignal_token;
            $user->save();
            PushNotification::editUser($user->token, $user->role);
        }
        return response()->json(['message' => 'success', 'id' => $user->id], 200);
    }

    public function getCountries(Request $request)
    {


        $countries = Country::all();

        return response()->json(['countries' => $countries], 200);
    }


    public function getStates(Request $request)
    {
        //        print ($request);
        $validator = Validator::make($request->all(), [
            'country_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $input = $request->all();

        $country = Country::find($input['country_id']);
        $states =  $country->states()->get();
        return response()->json(['states' => $states], 200);
    }

    public function getCities(Request $request)
    {
        //        print ($request);
        $validator = Validator::make($request->all(), [
            'state_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $input = $request->all();

        $state = State::find($input['state_id']);
        $cities = $state->cities()->get();
        return response()->json(['cities' => $cities], 200);
    }

    public function getManagers(Request $request)
    {
        $manager = \App\DjManager::orderBy('company_name')->get();

        return response()->json(['managers' => $manager], 200);
    }

    public function getClubs(Request $request)
    {

        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);

        $dj = $user->dj()->first();

        if ($dj->type == "mobile") {
            $events = DjEvents::where('dj_id', $dj->id)
                ->where('status', 'approved')
                ->get();

            $modified_event = array();
            foreach ($events as $event) {
                #$event->prime_time = "11:00 PM-03:10 AM";
                $event->city = City::find($event->city_id)->name;
                $event->contact = $event->contact_name;
                $event->phone_no = $event->contact_number;

                if ($event->start_time <= \Carbon\Carbon::now() && $event->end_time >= \Carbon\Carbon::now()) {
                    $modified_event[] = $event;
                }
            }

            return response()->json(['clubs' => $modified_event], 200);
        }
        $clubs = $dj->clubs()->get();
        return response()->json(['clubs' => $clubs], 200);
    }





    public function getCampaignsListUser(Request $request)
    {

        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);

        $campaignLists = MusicCampaign::where('user_id', $user->id)->paginate(10);

        return response()->json(['campaigns' => $campaignLists], 200);
    }

    public function advertiseList()
    {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        $adsLists = Advertisement::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get()->paginate(10);
        return response()->json(['adsLists' => $adsLists], 200);
    }

    public function invitecampaignAPI(Request $request)
    {

        $this->validate($request, [
            'email'  => 'required',
        ]);

        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        $reciptant = $request->email;
        $code = $user->id;

        if ($user->role == 'dj') {
            $dj = $user->dj()->first();


            Mail::send('email.campaigninvite', ['code' => $code, 'dj_name' => $dj->dj_name], function ($message) use ($reciptant) {
                $message->to($reciptant, 'DJ')->subject('SpinStatz Invitation!');
            });
        } elseif ($user->role == 'campaign') {

            $musicCampaign = MusicCampaign::where('user_id', $user->id)->first();
            Mail::send('email.campaigninvite', ['code' => $code, 'dj_name' => $musicCampaign->first_name], function ($message) use ($reciptant) {
                $message->to($reciptant, 'DJ')->subject('SpinStatz Invitation!');
            });
        }

        return response()->json(['message' => 'success'], 200);
    }

    public function campaignList()
    {

        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        $campaignLists = MusicCampaign::where('user_id', $user->id)->paginate(10);

        return response()->json(['campaigns' => $campaignLists], 200);
    }



    public function updateprofile(Request $request)
    {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        if ($request->campaignId) {
            $musiccampaign = MusicCampaign::find($request->campaignId);
        } else {
            $musiccampaign = MusicCampaign::where('user_id', $user->id)->first();
        }

        $musicCampaignAudio = $musiccampaign->musicCampaignAudio()->first();


        $musiccampaign->campaign_name = $request->campaignname;
        $musiccampaign->first_name = $request->fname;
        $musiccampaign->last_name = $request->lname;
        $musiccampaign->city = $request->city;
        $musiccampaign->street = $request->street;
        $musiccampaign->zipcode = $request->zipcode;
        $musiccampaign->phone = $request->phone;

        $musicCampaignAudio->company_name = $request->company_name;
        $musicCampaignAudio->song_title = $request->song_title;
        $musicCampaignAudio->artist_website = $request->artist_website;
        $musicCampaignAudio->release_date = $request->release_date;
        $musicCampaignAudio->isrc = $request->isrc;
        $musicCampaignAudio->upc = $request->upc;
        $musicCampaignAudio->artist_name = $request->artist_name;
        $musicCampaignAudio->genre = $request->musictype;

        $musiccampaign->save();
        $musicCampaignAudio->save();

        return response()->json(['message' => 'success', 'musiccampaign'=>$musiccampaign, 'musiccampaignaudio'=>$musicCampaignAudio], 200);
    }

    public function getFilters(Request $request)
    {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        if ($request->campaignId) {
            $musiccampaign = MusicCampaign::find($request->campaignId);
        } else {
            $musiccampaign = MusicCampaign::where('user_id', $user->id)->first();
        }

        return response()->json([
            'message' => 'success',
            'target_country' => $musiccampaign->target_country,
            'target_state' => $musiccampaign->target_state,
            'target_city' => $musiccampaign->target_city,
            'target_colition' => $musiccampaign->target_colition,
        ], 200);
    }

    public function getFiltersNew(Request $request)
    {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        if ($request->campaignId) {
            $musicCampaign = MusicCampaign::find($request->campaignId);
        } else {
            $musicCampaign = MusicCampaign::where('user_id', $user->id)->first();
        }
        $data = [];
        if ($musicCampaign->target_country != '[]' || sizeof(json_decode($musicCampaign->target_country)) > 0)
            for ($i = 0; $i < sizeof(json_decode($musicCampaign->target_country)); $i++) {
                $country = null;
                if (json_decode($musicCampaign->target_country)[$i] != 0) {
                    $country = Country::find(json_decode($musicCampaign->target_country)[$i])['name'];
                }
                $state = null;
                $city = null;
                $coliation = null;
                if (json_decode($musicCampaign->target_state)[$i] != 0) {
                    $state = State::find(json_decode($musicCampaign->target_state)[$i])['name'];
                }

                if (json_decode($musicCampaign->target_city)[$i] != 0) {
                    $city = City::find(json_decode($musicCampaign->target_city)[$i])['name'];
                }
                if (json_decode($musicCampaign->target_colition)[$i] != 0) {
                    $coliation = DjManager::find(json_decode($musicCampaign->target_colition)[$i])['company_name'];
                }
                $post_data = array(
                    'country' => $country,
                    'state' => $state,
                    'city' => $city,
                    'coaliation' => $coliation
                );
                array_push($data, $post_data);
            }

        return response()->json([
            'message' => 'success',
            'data' => $data,

        ], 200);
    }






    public function removeFilter(Request $request)
    {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        $index = (int)$request->index;
        if ($request->campaignId) {
            $musicCampaign = MusicCampaign::find($request->campaignId);
        } else {
            $musicCampaign = MusicCampaign::where('user_id', $user->id)->first();
        }
        $data = [];
        if ($musicCampaign->target_country != '[]' || sizeof(json_decode($musicCampaign->target_country)) > 0) {
            $countrys = json_decode($musicCampaign->target_country);
            $states = json_decode($musicCampaign->target_state);
            $citis = json_decode($musicCampaign->target_city);
            $colitions = json_decode($musicCampaign->target_colition);


            unset($countrys[$index]);
            unset($states[$index]);
            unset($citis[$index]);
            unset($colitions[$index]);
            $musicCampaign->target_country =  '[' . implode(",", $countrys) . ']';
            $musicCampaign->target_state =  '[' . implode(",", $states) . ']';
            $musicCampaign->target_city = '[' . implode(",", $citis) . ']';
            $musicCampaign->target_colition =  '[' . implode(",", $colitions) . ']';
            $data = [implode($countrys), implode($states), implode($citis), implode($colitions)];
            $musicCampaign->save();
        }
        return response()->json([
            'message' => 'success',
            'data' => $data,

        ], 200);
    }


    public function campaignDashboard(Request $request)
    {

        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        $musicCampaign = null;
        if ($request->campaignId) {
            $musicCampaign = MusicCampaign::find($request->campaignId);
        } else {
            $musicCampaign = MusicCampaign::where('user_id', $user->id)->first();
        }




        $mca = null;
        if (isset($musicCampaign->id)) {
            $mca = MusicCampaignAudio::where('campaign_id', $musicCampaign->id);
        }

        if($mca == null){
            return response()->json([
                'status' => 200,
                'message'=> 'Audio not uploaded'
                ]);
        }
        $instrumental = AdditionalCampaignMusic::where('campaign_id', '=', $musicCampaign->id)->where('music_type', '=', 'instrumental')->first();
        $radio = AdditionalCampaignMusic::where('campaign_id', '=', $musicCampaign->id)->where('music_type', '=', 'radioversion')->first();
        $acappella = AdditionalCampaignMusic::where('campaign_id', '=', $musicCampaign->id)->where('music_type', '=', 'acappella')->first();

        //Advertisement
        $date = date('Y-m-d');

        $getAds = Advertisement::where('start_date', '<=', $date)
            ->where('end_date', '>=', $date)
            ->where('status', Advertisement::STATUS_APPROVE)
            ->first();

        if ($mca->count() == 0) {
            return response()->json(['message' => 'No_compaigns'], 200);
        } else {
            $musicCampaignAudio = $mca->first();
            //return ;
            $manager = \App\DjManager::orderBy('company_name')->select('company_name','id')->get();
            $isspecial = in_array(13, json_decode($musicCampaignAudio->genre)) || in_array(6, json_decode($musicCampaignAudio->genre));
            //return $musicCampaignAudio->genre;

            $genresList = json_decode($musicCampaignAudio->genre);
            $genres = [];
            foreach ($genresList as $genre) {
                $genereActual = MusicType::find($genre);
                array_push($genres, $genereActual->name);
            }
            //$campaignLists = MusicCampaign::where('user_id', $user->id)->get();
            $totalSpent = \App\Deposit::where('campaign_uid', $user->id)->sum("amount");
            $musicCampaignAudio->genre = $genres;
            //            $jsonObj=$musicCampaignAudio.asJ
            return response()->json([
                'status' => 200,
                'message' => 'success',
                'musicCampaign' => $musicCampaign,
                'musicCampaignAudio' => $musicCampaignAudio,
                '$manager' => $manager,
                '$instrumental' => $instrumental,
                'instrumental' => $instrumental,
                '$radio' => $radio,
                'radio' => $radio,
                '$isspecial' => $isspecial,
                'isspecial' => $isspecial,
                '$acappella' => $acappella,
                'acappella' => $acappella,
                '$getAds' => $getAds,
                'getAds' => $getAds,
                #'$campaignLists' => $campaignLists,
                '$totalSpent' => $totalSpent,
                'totalSpent' => $totalSpent,
                'profileImage' => $user->profile_picture,

            ]);
        }
    }


    public function get_widget_search(Request $request)
    {
        $token = JWTAuth::getToken();
        $currentUser = JWTAuth::toUser($token);

        $id = $currentUser->id;
        $dj = Dj::where('user_id',$id)->first();

        $genres = Dj_Music::where('dj_id', $id)
            ->join('music_types','music_types.id','music_type')
            ->select('music_type','music_types.name')
            ->get();

        $genre_ids = array();

        for($i = 0; $i< count($genres); $i++){
            $genre_ids[] =   $genres[$i]['music_type'];
        }

        $m_type_ids=array();
        $music_types = DB::table('music_types')->where('name','LIKE', '%'. $request->searchKeyword .'%')->get();

        for($i = 0; $i < count($music_types); $i++){
            $m_type_ids[] =  $music_types[$i]->id;
        }

        $campaigns = MusicCampaign::join('music_campaign_audios','music_campaign_audios.campaign_id','music_campaigns.id')
            //->where('music_campaigns.campaign_name','LIKE', '%'. $_GET['searchKeyword'] .'%')
            ->where('music_campaign_audios.song_title','LIKE', '%'. $request->searchKeyword .'%')
            ->orwhere('music_campaign_audios.artist_name','LIKE', '%'. $request->searchKeyword .'%')
            ->where(function($query) use ($genre_ids) {
                for($i = 0; $i<sizeof($genre_ids); $i++ ){
                    $query->orWhereRaw('JSON_CONTAINS(music_campaign_audios.genre, \'['.$genre_ids[$i].']\')');
                }
            })->orwhere(function($query) use ($m_type_ids) {
                for($i = 0; $i < sizeof($m_type_ids); $i++ ){
                    $query->orWhereRaw('JSON_CONTAINS(music_campaign_audios.genre, \'['.$m_type_ids[$i].']\')');
                }
            })->orderBy('music_campaigns.id', 'desc')
            ->select('*','music_campaign_audios.id as audio_id')
            ->paginate(15);


        for ($i = 0; $i < sizeof($campaigns); $i++) {
            $genre_ids = json_decode($campaigns[$i]->genre);
            $genre_names = array();
            for ($j = 0; $j < sizeof($genre_ids); $j++) {

                $genre_names[$j] = MusicType::find($genre_ids[$j])->name;
            }
            $campaigns[$i]->genre = $genre_names;
            $campaigns[$i]->audio = env("APP_URL") . "96k/".$campaigns[$i]->audio_id.".mp3";
        }

        $data['status'] = true;
        $data['campaigns'] = $campaigns;
        return response()->json($data, 200);
    }


    public function getDjsThisWeekLastWeeks()
    {
        $token = JWTAuth::getToken();
        $currentUser = JWTAuth::toUser($token);
        $djs = $currentUser->djs;
        $jsonrecords = collect([]);
        foreach ($djs as $dj) {
            Carbon::setWeekStartsAt(Carbon::SUNDAY);
            Carbon::setWeekEndsAt(Carbon::SATURDAY);
            $sunday = Carbon::now()->startOfWeek();
            $saturday = Carbon::now()->endOfWeek();

            $thisweekRecords = IdentifiedMusic::whereBetween('played_timestamp', [$sunday, $saturday])->where('dj_id', '=', $dj->user_id)->get();
            $lastweekRecords = IdentifiedMusic::whereBetween('played_timestamp', [Carbon::now()->startOfWeek()->subDays(7), Carbon::now()->endOfWeek()->subDays(7)])->where('dj_id', '=', $dj->user_id)->get();
            $city = City::find($dj->city);

            if ($city == null) {
                $dj->city = 'Not Added';
                $dj->state = 'Not Added';
            } else {
                $dj->city = $city->name;
                $dj->state = $city->state->name;
            }
            $singleRec = array('dj' => $dj, 'weektotal' => sizeof($thisweekRecords), 'last_week_total' => sizeof($lastweekRecords));
            $jsonrecords->push($singleRec);
        }
        //Advertisement
        $date = date('Y-m-d');

        $getAds = Advertisement::where('start_date', '<=', $date)
            ->where('end_date', '>=', $date)
            ->where('status', Advertisement::STATUS_APPROVE)
            ->first();

        $djManager = $currentUser->manager()->first();
        //return $djManager;
        return response()->json(['records' => $jsonrecords], 200);
    }



    public function createDJAccount(Request $request)
    {


        //return $request;
        $this->validate(request(), [
            // 'invitationcode' => 'required',
            'email'          => 'required|unique:users,email',
            'firstname' => 'required',
            'password' => 'required|min:8',
            'lastname' => 'required',
            'phone' => 'required|numeric',
            'city' => 'required',
            'type' => 'required',
        ]);

        //dd("matched");

        $musicTypes = json_decode($request->musictype);
        $invitation = InviteCode::where('email', $request->email)->first();


        if ($invitation == null) {
            $invited_by = 1;
        } else {
            $invited_by = $invitation->invited_by;
        }

        if ($invitation != null && $invitation->created == 1) {
            return response()->json([
                'message' => 'failure',
                'error' => 'code_already_used',
            ], 400);
        } else {
            //$confirmation_code = str_random(30);
            $reciptant = $request->email;
            $manager = User::find($invited_by);


            $dj = new Dj();
            $user = new User();
            $user->username = $request->email;
            $user->password = bcrypt($request->password);
            $user->email = $request->email;
            $user->confirmation_code = "not required";
            $user->role = "dj";
            $user->confirmed = 1;
            $user->profile_picture = $manager->profile_picture;

            $user->save();

            $dj->first_name = $request->firstname;
            $dj->last_name = $request->lastname;
            $dj->dj_name = $request->djname;
            $dj->club_name = 'deleteThisfield';
            $dj->phone_number = $request->phone;
            $dj->user_id = $user->id;
            //$dj->country = $request->country;
            if ($request->software == null) {
                $request->software = "";
            }
            $dj->city = $request->city;
            $dj->software = $request->software;
            $dj->invited_by = $invited_by;
            $dj->type = $request->type;

            try {
                $dj->save();
            } catch (Exception $e) {
                $user->delete();
                return response()->json([
                    'message' => 'error',
                    'extra' => $e
                ], 404);
            }

            if($invitation != null){

                $invitation->created = 1;
                $invitation->save();
            }

            foreach ($musicTypes as $musicType) {
                $djMusic = new Dj_Music();
                $djMusic->dj_id = $user->id;
                $djMusic->music_type = $musicType;
                $djMusic->save();
            }


            $reciptant =   $user->email;


            $payload["user_id"]  = $user->id;
            $payload["dj_name"]  = $dj->dj_name;

            $data["source_app_id"] = "website";
            $data["created_at"] = date('Y-m-d H:i:s');
            $data["topic"] = "dj_created";
            $data["payload"] = $payload;
            //\App\KafkaProducer::produce($data["topic"],json_encode($data));


            Mail::send('email.registration', ['cc' => "test", 'reciptant' => $reciptant], function ($message) use ($reciptant) {
                $message->to($reciptant, 'DJ')->subject('SpinStatz Successful Registration!');
            });

            return response()->json([
                'message' => 'success'
            ], 200);
        }
    }

    public function getVideos(Request $request)
    {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);

        if ($user->role == 'campaign') {
            $campaign = $user->musicCampaigns()->first();
            $campaignaudio = $campaign->musicCampaignAudio()->first();
            $now =  Carbon::now();
            $amonth = $now->subDays(40);

            $spins = \App\IdentifiedMusic::select(
                "music_id as songId",
                "dj_id as user_id",
                "identified_musics.id",
                DB::raw("CONCAT('http://spinstatz.org/records/',
                identified_musics.videos) as videoUrl"),
                "played_timestamp",
                "djs.user_id",
                "djs.id as dj_id",
                "dj_name",
                "dj_managers.company_name as coliation"
            )
                ->join('djs', 'djs.user_id', 'dj_id')
                //->join('dj_managers','dj_managers.id','djs.invited_by')
                ->join('dj_managers', 'dj_managers.user_id', 'djs.invited_by')
                ->where('videos', '!=', 'null')
                ->where('music_id', $campaignaudio->id)
                ->where('played_timestamp', '>=', $amonth)
                ->groupBy('videos')
                ->paginate(9);

            return $spins;
        }
    }





    public function getNotification(Request $request)
    {

        // $token = JWTAuth::getToken();
        // $user = JWTAuth::toUser($token);

        // PushNotification::sendToAUser($user->token,"subject","helloAll");
        // PushNotification::sendToTag($user->role,"subject","helloAll tag");

    }



    public function match(Request $request)
    {
        //timezone_offet
        \Log::info('video upload started');
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        if ($request->hasFile('audio')) {
            $randStr = Str::random();
            $file = request('audio');
            $fileName = $file->getClientOriginalName();
            $audioName = $randStr . time() . $fileName;
            $ptime = explode('_', $fileName)[0];
            if ($file->move('records', $audioName)) {
                \Log::info('video has been saved');
            } else {
                \Log::info('video not saved');
                return response()->json([
                    'status' => 200,
                    'message' => 'Video Not Uploaded',
                    'video_upload' => false
                ]);
            }
        } else {
            \Log::info('video not sent');
            return response()->json([
                'status' => 200,
                'message' => 'Video Not Received',
                'video_upload' => false
            ]);
        }


        $dj = $user->dj()->first();
        $timezone_offset = request('timezone_offset');
        $latitude = request('lat');
        $longitude = request('long');


        $video_url = $audioName;
        $payload["user_id"] = $user->id;
        $payload["dj_name"] = $dj->dj_name;
        $payload["video_link"] = $audioName;
        $payload["club_id"] = (int)$request->club_id;
        $payload["played_timestamp"] = substr($ptime, 0, 10);
        $payload["latitude"] = $latitude;
        $payload["longitude"] = $longitude;
        $payload["timezone_offset"] = $timezone_offset;

        $data["source_app_id"] = "website";
        $data["created_at"] = date('Y-m-d H:i:s');
        $data["topic"] = "audio_played";
        $data["payload"] = $payload;


        //Log::info(json_encode($data));
        \App\KafkaProducer::saveAndProduce($data);

        return response()->json([
            'status' => 200,
            'message' => 'Video Successfully Uploaded',
            'video_upload' => true
        ]);


        // $client = new Client();
        // $port = env('FLASK_PORT', '8090');
        // $url   = "http://74.208.131.129:".$port."/match";
        // $resp = $client->request('POST', $url, [
        //     'multipart' => [
        //         [
        //             'name'     => 'record',
        //             'contents' => $audioName;
        //         ],
        //         [
        //             'name'     => 'user_id',
        //             'contents' => $user->id,
        //         ],
        //     ]
        // ]);
        // $data=$resp->getBody();
        // $message='empty';
        // $songid=json_decode($data, true)['songid'];
        // $userid=json_decode($data, true)['userid'];

        // responseMatch($songid,$userid,$audioName,$audioName,$payload["played_timestamp"],$payload["club_id"],$timezone_offset,$latitude, $longitude);

        // return response()->json([
        //     'status' => $songid,
        //     'video_upload' => true
        // ]);

    }

    public function testMatch(Request $request)
    {
        return response()->json([
            'status' => 200,
            'video_upload' => true
        ]);
    }


    function responseMatch($songid, $userid, $video_url, $audioName, $playedtime, $club, $timezone_offset, $latitude, $longitude)
    {
        DB::beginTransaction();

        if ($songid == 'no_match' || $songid == null) {
            $query = 'update kafka_messages SET message = JSON_SET(message, "$.match", "no_match") WHERE message->"$.payload.video_link" ="' . $video_url . '"';
            DB::update($query);
            DB::commit();
            return response()->json(array('result' => 'no_match', 'songId' => $songid));
        }

        $alreadyInserted = IdentifiedMusicAll::where('dj_id', $userid)
            ->where('video', $video_url)
            ->where('club_id', $club)
            ->where('music_id', $songid)
            ->count();
        if ($alreadyInserted > 0) {
            return response()->json(array('result' => 'already processed', 'songId' => $songid));
        }

        $musicMatchAll = new IdentifiedMusicAll();
        $musicMatchAll->music_id = $songid;
        $musicMatchAll->dj_id = $userid;
        $musicMatchAll->club_id = $club;
        $musicMatchAll->longitude = $latitude;
        $musicMatchAll->latitude = $longitude;
        $musicMatchAll->video = $video_url;

        $musicMatchAll->timezone_offset = $timezone_offset;

        $dt1 = Carbon::createFromTimestamp($playedtime)->subMinutes($timezone_offset);
        $currentTime = Carbon::createFromTimestamp($playedtime)->subMinutes($timezone_offset); //created clone because it affected both on assignment
        $currentSysTime = Carbon::createFromTimestamp($playedtime);

        $musicMatchAll->played_timestamp = $currentTime->toDateTimeString();
        $musicMatchAll->save();

        $campaign_audio = MusicCampaignAudio::find($songid);
        if ($campaign_audio == null) {
            $musicMatchAll->message = "Campaign audio Deleted";
            $musicMatchAll->save();
            return response()->json(array('result' => 'Campaign audio Deleted', 'songId' => $songid));
        }

        $campaign = MusicCampaign::find($campaign_audio->campaign_id);
        if ($campaign == null) {
            $musicMatchAll->message = "Campaign Deleted";
            $musicMatchAll->save();
            return response()->json(array('result' => 'Campaign Deleted', 'songId' => $songid));
        }

        $dj = Dj::where('user_id', $userid)->first();

        $last10minute = Carbon::createFromTimestamp($playedtime)->subMinutes($timezone_offset);
        $before10minute = Carbon::createFromTimestamp($playedtime)->subMinutes($timezone_offset);
        $last10minute->modify('-10 minutes');
        $before10minute->modify('10 minutes');

        //return [$last10minute, $currentTime];
        //\DB::enableQueryLog();

        $spin10minbefore = IdentifiedMusic::where('dj_id', $userid)
            ->where('identified_musics.music_id', $songid)
            ->where('paid',1)
            ->whereBetween('played_timestamp', array($last10minute, $before10minute))
            ->count();


        if ($spin10minbefore > 0) {
            $musicMatchAll->message = "same music Spin within 10 minutes";
            $musicMatchAll->save();
            DB::commit();
            return response()->json(array('result' => 'Spin within 10 minutes', 'songId' => $songid));
        }


        $last24hr = $dt1;
        $last24hr->modify('-24 hours');
        $spin24hrbefore = IdentifiedMusic::where('dj_id', $userid)
            ->where('paid', 1)
            ->whereBetween('played_timestamp', array($last24hr, $currentTime))
            ->where('club_id', $club)
            ->where('music_id', $songid)
            ->count();


        $dj->total_spin += 1;
        $campaign->total_spin += 1;
        $campaign->save();

        $dj->save();
        $musicmatch = new IdentifiedMusic();
        $musicmatch->music_id = $songid;
        $musicmatch->dj_id = $userid;
        $musicmatch->played_timestamp = $currentTime;
        $musicmatch->videos = $video_url;
        $musicmatch->identified_music_alls_id = $musicMatchAll->id;
        $musicmatch->club_id = $club;
        $musicmatch->save();

        if (!$campaign->isEligible($dj->id)) {
            $musicMatchAll->message = "Not Eligible";
            $musicMatchAll->save();
            DB::commit();
            return response()->json(array('result' => 'Not Eligible', 'songId' => $songid));
        }

        event(new \App\Events\GenericEvent("music-played", $dj->user_id, '{"music":' . $campaign->id . '}'));
        if ($spin24hrbefore >= 2) {
            $musicMatchAll->message = "Inserted, Pay Quota for particular club completed";
            $musicMatchAll->save();
            return response()->json(array('result' => 'Inserted, Pay Quota for particular club completed', 'songId' => $songid));
        }

        $club = Club::find($club);
        $prime_time = $club->prime_time;

        $carbon = Carbon::createFromTimestamp($playedtime)->subMinutes($timezone_offset);
        $date = $carbon->toDateString();
        $start = $date . ' ' . explode('-', $prime_time)[0];
        $end = $date . ' ' . explode('-', $prime_time)[1];

        $startPt = Carbon::createFromFormat('Y-m-d h:i A', $start);
        $endPt = Carbon::createFromFormat('Y-m-d h:i A', $end);

        //return [$startPt, $endPt, $dt];

        if ($startPt->gt($endPt)) {
            if ($currentTime->gt($endPt)) {
                $endPt->addDay(1);
            } else if ($startPt->gt($currentTime)) {
                $startPt->subDay(1);
            }
        }


        if ($dj->type != "mobile") {
            if ($currentTime < $startPt || $currentTime > $endPt) {
                $musicMatchAll->message = "Inserted, Not in Prime time";
                $musicMatchAll->save();
                DB::commit();
                return response()->json(array('result' => 'Inserted, Not in Prime time', 'songId' => $songid, 'current' => $currentTime, 'start' => $startPt, 'end' => $endPt, 'pt' => $prime_time));
            }
        }

        if ($campaign->campaign_balance < $campaign->spin_rate || $campaign->campaign_balance == 0) {
            $musicMatchAll->message = "Inserted, Campaign Balance Not Enough";
            $musicMatchAll->save();
            DB::commit();
            return response()->json(array('result' => 'Inserted, Campaign Balance Not Enough', 'songId' => $songid));
        }

        $accCamp = \App\AcceptedCampaign::where('dj_id', $dj->id)->where('campaign_id', $campaign->id)->first();
        if ($accCamp == null) {
            $musicMatchAll->message = "Inserted, Campaign Not Accepted";
            $musicMatchAll->save();
            DB::commit();
            return response()->json(array('result' => 'Inserted, Campaign Not Accepted', 'songId' => $songid));
        }


        $last1hour = Carbon::createFromTimestamp($playedtime)->subMinutes($timezone_offset);
        $last1hour->modify('-3600 seconds');

        //return [$last10minute, $currentTime];

        $spin1hourbefore = IdentifiedMusic::where('dj_id', $userid)
            //->where('club_id',$club->id)
            ->whereBetween('played_timestamp', array($last1hour->toDateTimeString(), $currentTime->toDateTimeString()))
            ->where('paid', 1)
            ->where('identified_musics.music_id', $songid)
            ->count();

        //dd(\DB::getQueryLog());

        //return [$spin1hourbefore, $last1hour->toDateTimeString(), $currentTime->toDateTimeString()];


        if ($spin1hourbefore > 0) {
            $musicMatchAll->message = "Inserted, music detected within one hour in same club";
            $musicMatchAll->save();
            return response()->json(array('result' => 'Inserted, music detected within one hour in same club', 'songId' => $songid));
        }

        if ($dj->type == "online") {
            //if(in_array(6, json_decode($campaign_audio->genre))){
            if (true) {
                $setting = \App\Setting::where('field', 'online_rate')->first();
                $key = "rate_" . $campaign->spin_rate;
                $spin_rate = json_decode($setting->value)->$key;
            } else {
                $musicMatchAll->message = "Inserted, DJ is online and music is not Gosepel";
                $musicMatchAll->save();
                return response()->json(array('result' => 'Inserted, DJ is online and music is not Gosepel', 'songId' => $songid));
            }
        } else {
//            $spin_rate = $campaign->spin_rate;
            $spin_rate = \App\Helpers\Settings::get_dj_spin_rate($dj->star,$campaign->spin_rate);
        }


        $campaignUser = User::find($campaign->user_id);
        try {
            if ($campaignUser->token != null) {
                $responseObj = [
                    'userId' => $userid,
                    'campaignAudioId' => $songid,
                    'campaignId' => $campaign->id,
                    'source' => 'song_played'

                ];

                $message = "Your music titled as " . $campaign_audio->song_title . " was played by the DJ " . $dj->dj_name;
//                PushNotification::sendToAUser($campaignUser->token, $responseObj, $message);
                Notification::publishMessage("api", "message_sent", ["push"], $campaignUser, $message, "", "/img/user-1-profile.jpg",$responseObj);
            }
        } catch (Exception $e) {
        }

        $payment_records = array();

        $campaign->campaign_balance = $campaign->campaign_balance - $spin_rate;
        $campaign->save();
        $payment_records["campaign_deduction"] = $spin_rate;

        $dj_earned_points = 95.0 / 200.0 * $spin_rate;
        $dj->points_earned = $dj->points_earned + $dj_earned_points;
        $payment_records["dj_earned_points"] = $dj_earned_points;
        $payment_records["status"] = IdentifiedMusic::no_action;

        //$accCamp = $accCamp->first();
        $accCamp->earning += 95.0 / 200.0 * $spin_rate;
        $accCamp->save();

        $manager = $dj->djmanager()->first()->manager()->first();

        $manager_earned_points = 5.0 / 200.0 * $spin_rate;
        $manager->balance = $manager->balance + $manager_earned_points;
        $manager->save();
        $payment_records["manager_earned_points"] = $manager_earned_points;
        $payment_records["manager_id"] = $manager->id;
        $dj->save();
        //return $dj->points_earned;



        $musicMatchAll->message = "Inserted, Paid";
        $musicmatch->payments_records = $payment_records;
        $musicMatchAll->save();
        $musicmatch->paid = 1;
        $musicmatch->save();
        event(new \App\Events\GenericEvent("music-played", $dj->user_id, '{"music":' . $campaign->id . '}'));
        DB::commit();
        return response()->json(array('result' => 'Inserted, Paid', 'songId' => $songid));
    }


    public function recordVideoUrl(Request $request)
    {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        //    dd($request->all());
        $json = json_decode($request->getContent(), true);
        $user_id = $user->id;
        $songId = $json['songId'];
        $videoUrl = $json['videoUrl'];
        $latitude = $json['latitude'];
        $longitude = $json['longitude'];
        $timestamp = $json['timestamp'];
        $desktopVideoInfo = new DesktopVideoInfo();
        $desktopVideoInfo->user_id = $user_id;
        $desktopVideoInfo->songId = $songId;
        $desktopVideoInfo->videoUrl = $videoUrl;
        $desktopVideoInfo->latitude = $latitude;
        $desktopVideoInfo->longitude = $longitude;
        $desktopVideoInfo->timestamp = $timestamp;
        $saved = $desktopVideoInfo->save();
        if ($saved) {
            return response()->json(['message' => 'success'], 200);
        } else {
            return response()->json(['message' => 'failure'], 200);
        }
    }

    public function mockapi()
    {
        $user = \App\Dj::first();
        $audioName = "1527701568111_record.webm";

        $payload["user_id"] = $user->user_id;
        $payload["dj_name"] = "mock-dj";
        $payload["video_link"] = $audioName;
        $payload["club_id"] = 69;
        $payload["played_timestamp"] = time();
        $payload["latitude"] = "28.3949";
        $payload["longitude"] = "84.1240";
        $payload["timezone_offset"] = "345";

        $data["source_app_id"] = "website";
        $data["created_at"] = date('Y-m-d H:i:s');
        $data["topic"] = "LIVE_audio_played";
        $data["payload"] = $payload;
        \App\KafkaProducer::produce($data["topic"], json_encode($data));

        return response()->json([
            'status' => 200,
            'video_upload' => true
        ]);
    }

    public function extractDate()
    {
        $club = Club::find(182);
        $timediff = 534;
        $prime_time = $club->prime_time;
        $mytime = Carbon::now();
        $date = $mytime->toDateString();
        $start = $date . ' ' . explode('-', $prime_time)[0];
        $end = $date . ' ' . explode('-', $prime_time)[1];
        $primeStart = Carbon::createFromFormat('Y-m-d h:i A', $start);
        $primeEnd = Carbon::createFromFormat('Y-m-d h:i A', $end);
        if ($primeStart->gt($primeEnd)) {
            $primeEnd->addDay();
        }
        $currentTime = Carbon::now();
        if ($timediff >= 0) {
            $currentTime = $currentTime->addMinutes($timediff);
        } else {
            $currentTime = $currentTime->subMinutes($timediff);
        }


        if ($primeStart->lte($currentTime) && $primeEnd->gte($currentTime)) {
            echo 'start time fram';
        } else {
            echo 'not inside';
        }


        echo $primeStart;
        echo $primeEnd;
        error_log($prime_time);
    }

    public function updatePassword(Request $request)
    {
        $currentUser = JWTAuth::toUser(JWTAuth::getToken());

        $validator = Validator::make($request->all(), [
            'password' => 'required|min:9',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }


        $currentUser->password = bcrypt($request->password);
        $currentUser->save();


        return response()->json(array('message' => 'Password Updated'), 201);
    }

    public function campaignStore(Request $request)
    {




        $validator = Validator::make($request->all(), [
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email|unique:users,email',
            'campaignname' => 'required',
            'city' => 'required',
            'password' => 'required',
            'street' => 'required',
            'zipcode' => 'required',
            'phone' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }


        $userCampaign = $request->all();

        $cc = str_random(30);
        $reciptant = $userCampaign['email'];
        $id = User::create([
            // 'username' => $userCampaign['username'],
            'email' => $reciptant,
            'password' => bcrypt($userCampaign['password']),
            'role' => 'campaign',
            'blocked' => 'no',
            'confirmation_code' => $cc,
            'confirmed' => 0,

        ])->id;


        $musicCampaign = new MusicCampaign();

        $musicCampaign->campaign_name = $userCampaign['campaignname'];
        $musicCampaign->user_id = $id;
        $musicCampaign->first_name = $userCampaign['fname'];
        $musicCampaign->last_name = $userCampaign['lname'];
        $musicCampaign->email = $userCampaign['email'];
        $musicCampaign->company_name = 'deleteThisfield';
        $musicCampaign->city = $userCampaign['city'];
        $musicCampaign->street = $userCampaign['street'];
        $musicCampaign->zipcode = $userCampaign['zipcode'];
        $musicCampaign->phone = $userCampaign['phone'];
        $musicCampaign->campaign_balance = 0;
        $musicCampaign->target_country = '[]';
        $musicCampaign->target_state = '[]';
        $musicCampaign->target_city = '[]';
        $musicCampaign->target_colition = '[]';
        // $musicCampaign->referid = $userCampaign['referid'];


        $musicCampaign->save();

        Mail::send('email.verification', [
            'link' => '/register/verify/' . $cc,
            'username' => $request->username
        ], function ($message) use ($reciptant) {
            $message->to($reciptant, '')->subject('Confirm Campaign Registration- SpinStatz.net');
        });

        return response()->json([
            'status' => 200,
            'success' => true,
            'musicCampaign' => $musicCampaign
        ]);
    }




    public function newCampaignStore(Request $request)
    {

        $currentUser = JWTAuth::toUser(JWTAuth::getToken());


        $validator = Validator::make($request->all(), [
            'campaign_name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }


        $input = $request->all();

        $userId = $currentUser->id;

        $campaign = new MusicCampaign();
        $firstCampaign = $campaign->where('user_id', $userId)->first();

        if (!$firstCampaign) {
            return response()->json([
                'status' => 200,
                'success' => true,
                'message' => 'no_previous_campaigns'
            ]);
        }

        $firstCampaign->campaign_name = $input['campaign_name'];

        /* Music Notification */
        $receiver_id = DB::table('users')
            ->select('users.id')
            ->where('users.role', 'admin')->first();


        $notification_arr = array();
        $notification = new notification_app();
        $message_array = $notification->adminReceivedMesssages;




        unset($firstCampaign->id);
        $newCampaign = $campaign->create($firstCampaign->toArray());
        $newCampaign->target_country = '[]';
        $newCampaign->target_state = '[]';
        $newCampaign->target_city = '[]';
        $newCampaign->target_colition = '[]';
        $newCampaign->save();

        $uerr = User::find($receiver_id->id);


        if ($uerr != null) {
            if ($uerr->token != null) {
                $responseObj = [
                    'userId' => $uerr->id,
                    'source' => 'campaign_created'

                    //                    'manager' => $manager->id
                ];

                $message = "A new campaign has been created ";
//                PushNotification::sendToAUser($receiver_id->token, $responseObj, $message);
                Notification::publishMessage("api", "message_sent", ["push"], $receiver_id, $message, "", "/img/user-1-profile.jpg",$responseObj);
            }
        }

        $notification_arr = [
            'user_id' => $userId, 'reference_id' => $receiver_id->id,
            'subject' => $message_array['campign_added']['subject'], 'message' => $message_array['campign_added']['message'],
            'href'   => '' . $newCampaign->id, 'seen' => 0,
            'is_shown' => 0, 'type' => 'campaign',
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $notification->onlynotification($notification_arr);
        return response()->json([
            'status' => 200,
            'success' => true,
            'message' => 'campaign_created_sucessfully',
            'id'=>$newCampaign->id,
            'name'=>$firstCampaign->campaign_name
        ]);
    }


    public function filterTargetAdvanced(Request $request)
    {
        $currentUser = JWTAuth::toUser(JWTAuth::getToken());
        $totalSpent = \App\Deposit::where('campaign_uid', $currentUser)->sum("amount");
        //        if($totalSpent < 1000){
        //            return response()->json([
        //                'status' => 200,
        //                'success' => false,
        //                'message' => 'spent_less_than_1000'
        //            ]);
        //        }

        $input = $request->all();

        if ($input['campaign_id'] != '') {
            $campaign = MusicCampaign::find($input['campaign_id']);
        } else {
            $campaign = MusicCampaign::where('user_id', $currentUser->id)->first();
        }



        $campaign->target_country = '[' . implode(",", json_decode($request->country)) . ']';
        $campaign->target_state = '[' . implode(",", json_decode($request->state)) . ']';
        $campaign->target_city = '[' . implode(",", json_decode($request->city)) . ']';
        $campaign->target_colition = '[' . implode(",", json_decode($request->collation)) . ']';



        $campaign->save();
        return response()->json(['success' => 'success'], 200);
    }

    public function uploadImage(Request $request)
    {
        $currentUser = JWTAuth::toUser(JWTAuth::getToken());

        $validator = Validator::make($request->all(), [
            'file' => 'mimes:jpeg,jpg,png,gif|required|max:10000'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        if ($request->hasFile('file')) {
            $file = request('file');

            $ppName = time() . $file->getClientOriginalName();
            $dir = 'campaignUserProfile';
            $message = $file->move($dir, $ppName);
            $currentUser->profile_picture = $dir . '/' . $ppName;
            $currentUser->save();
        }
        return response()->json(['success' => 'success'], 200);
    }




    public function estimationAdvanced(Request $request)
    {
        $countries = json_decode($request->country);
        $states = json_decode($request->state);
        $cities = json_decode($request->city);
        $coalition = json_decode($request->collation);
        $allTotal = 0;
        $countryTotal = 0;
        $stateTotal = 0;
        $cityTotal = 0;
        $coilationTotal = 0;
        for ($i = 0; $i < sizeof($countries); $i++) {

            $country = $countries[$i];
            $state = $states[$i];
            $city = $cities[$i];
            $coalitionSing = $coalition[$i];
            //            Log::info($coalition);
            $total = 0;
            $colltotal = 0;
            if ($coalitionSing != 0) {
                Log::info('coilation' . $coalitionSing);
                $manager_uid = \App\DjManager::find($coalitionSing)->user_id;
                $coalitionCount = Dj::where('invited_by', $manager_uid)->count();
                $colltotal = $coalitionCount;
                $total = $coalitionCount;
            }

            if ($country != 0) {
                $countryEle = DJ::join('cities', 'djs.city', 'cities.id')
                    ->join('states', 'states.id', 'cities.state_id')
                    ->where('states.country_id', $country)
                    ->distinct('djs.id');

                $countryCount = $countryEle->count();


                if ($coalitionSing != 0) {
                    $total = $countryEle->where('djs.invited_by', $manager_uid)->count();
                    //$total = $countryCount;
                    $colltotal = $total;
                } else {
                    $total = $countryCount;
                }
            }

            if ($state != 0) {
                Log::info('state' . $state);
                $stateEle = DJ::join('cities', 'djs.city', 'cities.id')
                    ->where('cities.state_id', $state)
                    ->distinct('djs.id');
                $stateCount = $stateEle->count();


                if ($coalitionSing != 0) {
                    $total = $stateEle->where('djs.invited_by', $manager_uid)->count();
                    $colltotal = $total;
                } else {
                    $total = $stateCount;
                }
            } else {
                if ($coalitionSing == 0) {
                    $countryTotal = $countryTotal + $countryCount;
                }
            }
            if ($city != 0) {
                Log::info('city' . $city);
                $city = Dj::where('city', $city);
                $cityCount = $city->count();

                if ($coalitionSing != 0) {
                    //$total = $countryCount;
                    $total = $city->where('djs.invited_by', $manager_uid)->count();
                    $colltotal = $total;
                } else {
                    $total = $cityCount;
                    $cityTotal = $cityTotal + $cityCount;
                }
            } else {
                if ($coalitionSing == 0 && $state != 0) {
                    $stateTotal = $stateTotal + $stateCount;
                }
            }
            $coilationTotal = $coilationTotal + $colltotal;
            $allTotal = $allTotal + $total;
        }

        return response()->json([
            'success' => 'success',
            'countryTotal' => $countryTotal,
            '$stateTotal' => $stateTotal,
            '$cityTotal' => $cityTotal,
            '$coilationTotal' => $coilationTotal,
            '$allTotal' => $allTotal
        ], 200);

        return [$countryTotal, $stateTotal, $cityTotal, $coilationTotal, $allTotal];
    }

    public function isjoined(Request $request, $campaign, $dj)
    {
        $accepted =  AcceptedCampaign::where('campaign_id', $campaign)->where('dj_id', $dj)->first();
        return response()->json(['joined' => $accepted != null], 200);
    }
}

<?php

namespace App\Http\Controllers\api;

use App\Advertisement;
use App\Helpers\notification_app;
use App\Helpers\PushNotification;
use App\Http\Controllers\Controller;
use App\DesktopVideoInfo;
use App\Http\Requests\CampaignRegisterRequest;
use App\Http\Requests\AudioUploadRequest;
use App\IdentifiedMusic;
use App\IdentifiedMusicAll;
use App\MusicType;
use App\Notification;
use App\Reaction;
use App\User;
use FFMpeg\FFMpeg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Symfony\Bridge\PsrHttpMessage\Tests\Fixtures\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use GuzzleHttp\Client;
use Carbon\Carbon;
use App\MusicCampaignAudio;
use App\Dj;
use App\MusicCampaign;
use Illuminate\Support\Facades\Log;
use Auth;
use App\Dj_Music;
use App\Helpers\UserHelper;
use Symfony\Component\Console\Helper\Helper;
use Illuminate\Support\Facades\Redis;

class ApiAuthController extends Controller
{
    //


    public function login(Request $request)
    {
        $credentials = request()->only('email', 'password');
        try {
            $token = JWTAuth::attempt($credentials);

            if (!$token) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'something_went_wrong'], 500);
        }
        $data['status'] = true;
        $data['token'] = $token;
        $user = Auth::user();
        if ($user->role == 'dj') {
            $data['profile'] = Dj::whereUser_id($user->id)->first();
            $genres = Dj_Music::where('dj_id', $data['profile']->id)
                ->join('music_types', 'music_types.id', 'music_type')
                ->select('music_type', 'music_types.name')
                ->get();
            $genre_ids = array();

            for ($i = 0; $i < count($genres); $i++) {
                $data['genres'][] =   $genres[$i]['name'];
            }
        }
        $data['user'] = Auth::user();

        return response()->json($data, 200);
    }

    public function campaigns()
    {
        $user = UserHelper::get_current_user();
        $star = $user->dj()->first()->star;
        $campaign = MusicCampaign::select('music_campaigns.*', 'music_campaign_audios.*')
            ->join('music_campaign_audios', 'music_campaign_audios.campaign_id', 'music_campaigns.id')
            // ->whereIn('music_campaign_audios.genre',$genre_ids)
            ->orderBy('music_campaigns.id', 'desc')
            ->select("*",DB::raw("concat('/300x300/',music_campaign_audios.id,'.png') as artwork, music_campaign_audios.id as audio_id"))
            ->paginate((int)request()->input('limit'));

        //$i=0;

        /*foreach ($campaign as $value) {



            //$camp['data'][$i]=$value;
            $url=explode('/',$value->artwork);
            $value->artwork =$url[0].'/'.$new = str_replace(' ', '%20', $url[1]);
            //$camp['data'][$i]['artwork']=$url[0].'/'.$new = str_replace(' ', '%20', $url[1]);



            //$camp['data'][$i]['audio']=str_replace(' ', '%20', $value->audio);
            $value->audio = str_replace(' ', '%20', $value->audio);
            $value->audio =env('APP_URL')."/audio/".str_replace(' ', '%20', $value->audio);


            $i++;
        }*/

        for ($i = 0; $i < sizeof($campaign); $i++) {
            $genre_ids = json_decode($campaign[$i]->genre);
            $genre_names = array();
            for ($j = 0; $j < sizeof($genre_ids); $j++) {

                $genre_names[$j] = MusicType::find($genre_ids[$j])->name;
            }
            $campaign[$i]->genre = $genre_names;
            $campaign[$i]->spin_rate = \App\Helpers\Settings::get_dj_spin_rate($star,$campaign[$i]->spin_rate) * 2;
            $campaign[$i]->audio = env("APP_URL") . "96k/".$campaign[$i]->audio_id.".mp3";
        }

        $data['status'] = true;
        $data['campaigns'] = $campaign;
        return response()->json($campaign, 200);
    }

    /*public function campaigns()
    {
        $currentUser = Auth::user();
        $id = Auth::Id();

        $dj = Dj::where('user_id',$id)->first();

        $genres = Dj_Music::where('dj_id', $id)
                        ->join('music_types','music_types.id','music_type')
                        ->select('music_type','music_types.name')
                        ->get();



        $genre_ids = array();

        for($i = 0; $i< count($genres); $i++){
            $genre_ids[] =   $genres[$i]['music_type'];
        }

        $campaign = MusicCampaign::select('music_campaigns.*','music_campaign_audios.*')
                        ->join('music_campaign_audios','music_campaign_audios.campaign_id','music_campaigns.id')
                        // ->whereIn('music_campaign_audios.genre',$genre_ids)
                        ->orderBy('music_campaigns.id', 'desc')
                        ->paginate(9);
       $i=0;
        foreach ($campaign as $value) {

                $camp['data'][$i]=$value;
                $url=explode('/',$value->artwork);
                $camp['data'][$i]['artwork']=$url[0].'/'.$new = str_replace(' ', '%20', $url[1]);

                $camp['data'][$i]['audio']=str_replace(' ', '%20', $value->audio);

              $i++;
            }
        $data['status']=true;
        $data['campaigns']=$camp;
        return response()->json($data,200);
    }*/

    public function acceptCampaigns()
    {
    }

    public function djprofile()
    {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        $dj = $user->dj()->select('id', 'city', 'first_name', 'last_name', 'phone_number' ,'dj_name', 'total_spin', 'facebook', 'instagram', 'youtube', 'twitter', 'soundcloud', 'points_earned', 'type', 'address', 'created_at as joined_date','paypal_email','updated_at')->first();
        $city = $dj->city()->first();
        $state = $city->state()->first();
        $country = $state->country()->first();

        $dj->city = $city->id;
        $dj->state = $state->id;
        $dj->country = $country->id;
        $dj->diamond_count = ceil($dj->total_spin / 1000 + 1);
        $dj->profile_picture = $user->profile_picture;
        $dj->email = $user->email;
        $dj->clubs =  \App\Club::where('dj_id', $dj->id)->pluck('name')->all();


        $now = \Carbon\Carbon::now();
        $month = $now->month;
        $m = ($now->subMonth())->format('F');
        $emonth = $month - 1 == 0 ? 12 : $month - 1;

        $tm =  \App\IdentifiedMusic::whereMonth('created_at', '=', $month)
            ->where('dj_id', $user->id)
            ->count();

        $lm =  \App\IdentifiedMusic::whereMonth('created_at', '=', $emonth)
            ->where('dj_id', $user->id)
            ->count();
        $diff = $tm - $lm;
        if ($diff > 0) {
            $diff = '+' . $diff;
        }

        $dj['last_month_spin'] = $lm;
        $dj['diff'] = $diff;
        $dj['last_month'] = $m;
        $dj['accepted_campaigns'] = $dj->campaigns()->pluck('campaign_id');
        $dj['liked'] = $dj->getLiked();
        return $dj;
    }

    public function spinned()
    {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        $dj = $user->dj()->first();

        $timezone_offset = request('timezone_offset');
        $club_id = request('club_id');

        //return [$timezone_offset, $club_id];
        //timezone offset has been already deducted after identifying

        if ($timezone_offset == null || $club_id == null) {
            return response()->json("invalid", 200);
        }


        $currentTime = Carbon::now()->subMinutes($timezone_offset);
        $last24hr = Carbon::now()->subMinutes($timezone_offset)->modify('-4 hours');


        $spin24hrbefore = IdentifiedMusic::where('dj_id', $user->id)
            //->where('paid',1)
            ->whereBetween('played_timestamp', array($last24hr, $currentTime))
            //->where('club_id', $club_id)
            ->pluck('music_id')->toArray();


        $accepted_campaigns = $dj->campaigns()
            ->join('music_campaign_audios', 'music_campaign_audios.campaign_id', 'accepted_campaigns.campaign_id')
            ->select('song_title', 'music_campaign_audios.id')
            ->get();

        foreach ($accepted_campaigns as $accepted_campaign) {
            $accepted_campaign->spinned = in_array($accepted_campaign->id, $spin24hrbefore);
        }

        return $accepted_campaigns;
    }

    public function getNotification()
    {
        $user = UserHelper::get_current_user();
        $url  = env("APP_URL", "https://spinstatz.net");



        $notification = \App\Notification::where('reference_id', $user->id)
            ->select('id', 'user_id', 'message', 'href', 'seen', 'type', 'created_at', 'updated_at', 'reference_id', 'subject', 'is_shown', DB::raw('CONCAT("' . $url . '",image) AS image'))
            ->where('is_shown', 0)
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        $count = \App\Notification::where('reference_id', $user->id)
            ->where('seen', 0)
            ->count();

        return [$count, $notification];
    }

    public function deleteNotification(\App\Notification $notification)
    {
        $user = UserHelper::get_current_user();

        if ($notification->reference_id == $user->id) {
            $resp = $notification->delete();
            return response()->json($resp, 200);
        }

        return response()->json("failed", 200);
    }

    public function deleteAllnotification()
    {
        $user = UserHelper::get_current_user();
        $notifications = \App\Notification::where('reference_id', $user->id)->delete();
        return response()->json("success", 200);
    }


    public function reaction(MusicCampaignAudio $campaign, $react)
    {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);

        $dj = $user->dj()->first();
        $musicCampaign = $campaign->musicCampaign()->first();



        $reaction = Reaction::where('dj_id', $dj->id)
            ->where('campaign_id', $campaign->id)
            ->first();



        if ($reaction == null) {
            $reaction = new Reaction();
            $reaction->dj_id = $dj->id;
            $reaction->campaign_id = $campaign->id;
            $reaction->reaction = $react;
            if ($react == 0) {
                $musicCampaign->dislikes += 1;
            } else {
                $musicCampaign->likes += 1;
            }
        } else if ($reaction->reaction != $react) {

            if ($react == 0) {
                $musicCampaign->dislikes += 1;
                $musicCampaign->likes -= 1;
            } else {
                $musicCampaign->likes += 1;
                $musicCampaign->dislikes -= 1;
            }
            $reaction->reaction = $react;
        }
        $reaction->save();
        $musicCampaign->save();

        $arr = array();
        $arr['likes'] = $musicCampaign->likes;
        $arr['dislikes'] = $musicCampaign->dislikes;
        event(new \App\Events\CampaignReaction($campaign->id, json_encode($arr)));

        return $dj->getLiked();
    }

    public function getChatHistory()
    {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);


        $dj = $user->dj()->first();

        $inbox = \DB::table('chat_history')
            ->select('users.username as dj_name', 'chat_history.*')
            ->join('users', 'users.id', '=', 'chat_history.sender_id')
            ->where('receiver_id', $dj->id)->paginate(50);

        return response()->json($inbox, 200);
    }

    public function createcampaignAccount(CampaignRegisterRequest $request)
    {
        //
        //return dd($request->hasFile('audio'))

        $userCampaign = $request->all();

        $cc = str_random(30);
        $reciptant = $userCampaign['email'];
        $id = User::create([
            'username' => $userCampaign['username'],
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
        $musicCampaign->referid = $userCampaign['referid'];

        /*if(isset($userCampaign['referid']) && $userCampaign['referid'] != NULL) {

            $notification_arr=array();
            $notification=new notification_app();
            $message_array=$notification->adminReceivedMesssages;

            $notification_arr=['user_id' =>Auth::id(), 'reference_id' => $userCampaign['referid'],
                 'subject' => $message_array['dj_withdraw_request']['subject'],'message' => $message_array['dj_withdraw_request']['message'],
                 'href'   => '','seen' => 0,
                 'is_shown' => 0, 'type' => 'campaign',
                 "created_at" => date('Y-m-d H:i:s'),
                 "updated_at" => date('Y-m-d H:i:s'),
            ];
            $notification->onlynotification($notification_arr);
        }*/

        $musicCampaign->save();

        Mail::send('email.verification', [
            'link' => '/register/verify/' . $cc,
            'username' => $request->username
        ], function ($message) use ($reciptant) {
            $message->to($reciptant, '')->subject('Confirm Campaign Registration- SpinStatz.net');
        });

        return response()->json(["message" => "success"], 200);
    }

    public function addMusicToCampaign(Request $request)
    {

        //

        $imagePathTotal = '';
        if ($request->hasFile('image')) {
            $file = request('image');

            $imageName = time() . $file->getClientOriginalName();
            $dir = 'artwork';
            $message = $file->move($dir, $imageName);
            $imagePath = $dir . '/' . $imageName;
            $imagePathTotal = public_path() . '/artwork/' . $imagePath;
            Log::error($message);
        } else {
            return response()->json(["status" => "error", "message" => "Artwork not uploaded"], 200);
        }

        $audioPath = '';
        $audioPathNew = '';

        if ($request->hasFile('audio')) {
            $file = request('audio');

            $fileExt = $file->getClientOriginalExtension();

            if (!in_array($fileExt, ["mp3", "MP3"])) {
                return redirect()->back()->with('audio.error', 'The audio must be a file of type: mp3, MP3.');
            }

            $audioName = time() . $file->getClientOriginalName();
            $message = $file->move('audio', $audioName);
            $audioPath = public_path() . '/audio/' . $audioName;
            $audioPathNew = public_path() . '/audio/spin' . $audioName;

            Log::error($message);
        } else {
            return response()->json(["status" => "error", "message" => "audio not uploaded"], 200);
        }
        $gen = json_encode($request->musictype, JSON_NUMERIC_CHECK);

        try {
            $arr = json_decode($gen);
            $genres = '';
            foreach ($arr as $item) { //foreach element in $arr
                $genre = MusicType::find($item);
                if ($genre) {
                    $genres = $genres . $genre->name . ', ';
                }
            }
            $ffmpeg = FFMpeg::create();
            $audio = $ffmpeg->open($audioPath);
            $audio->filters()->addMetadata([
                "title" => $request->song_title,
                "track" => 1,
                "year" => $request->release_date,
                "artist" => $request->artist_name,
                "album" => $request->artist_website,
                "artwork" => $imagePath,
                "description" => $request->company_name,
                "genre" => $genres

            ]);

            $format = new Mp3();


            $audio->save($format, $audioPathNew);
        } catch (\Exception $e) {
        }


        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        $user_id = $user->id;


        $id = $request->new_campaign_id;
        $musicCampaign = MusicCampaign::find($id);
        $musicCampaign->campaign_balance;
        $musicCampaign->slug = str_slug($request->song_title, "-") . $id;
        $musicCampaign->save();


        if ($musicCampaign->campaign_balance < 1) {
            return response()->json(["status" => "error", "message" => "Balance not enough"], 200);
        }

        $gen = json_decode($request->musictype, JSON_NUMERIC_CHECK);
        $audioInfo = MusicCampaignAudio::create([
            'campaign_id' => $id,
            'audio' => 'spin' . $audioName . '.mp3',
            'company_name' => $request->company_name,
            'artist_website' => $request->artist_website,
            'song_title' => $request->song_title,
            'release_date' => $request->release_date,
            'isrc' => $request->isrc,
            'upc' => $request->upc,
            'genre' => $request->musictype,
            'artist_name' => $request->artist_name,
            'artwork' => $imagePath,
        ]);

        //

        $responseObj = [
            'campaignAudioId' => $audioInfo->id,
            'campaignId' => $musicCampaign->id,
            'source' => 'new_music_added'

        ];

        $message = "A music titled as " . $audioInfo->song_title . " has been added to your genre ";


        PushNotification::sendToTag('dj', $responseObj, $message);
        //return $gen;
        $djs = Dj::join('dj__musics', 'dj__musics.dj_id', 'djs.id')->select('djs.user_id')->whereIn('music_type', $gen)->groupBy('djs.user_id')->get();

        $data = [];


        foreach ($djs as $dj) {
            $data[] = array('reference_id' => $dj->user_id, "is_shown" => "0", 'user_id' => $user->id, 'subject' => 'New Music Uploaded', 'message' => 'New Campaign added on Your Genre', 'href' => '' . $audioInfo->id, 'type' => 'campaign-added', 'seen' => 0);
        }

        \App\Notification::insert($data);
        $payload["user_id"] = $user->id;
        $payload["campaign_id"] = $musicCampaign;
        $payload["audio_link"] = env('APP_URL', 'http://127.0.0.1/') . '/audio' . $audioName;
        $payload["played_timestamp"] = time();

        $data["source_app_id"] = "website";
        $data["created_at"] = date('Y-m-d H:i:s');
        $data["topic"] = "audio_added";
        $data["payload"] = $payload;

        Redis::publish('wave', json_encode(array(['id' => $audioInfo->id])));


        return response()->json(["status" => "success", "message" => "Audio inserted"], 200);
    }

    public function addCampaign()
    {
        $this->validate(request(), [
            'campaign_name' => 'required',
        ]);

        $input = $request->all();

        $userId = Auth::id();

        $campaign = new MusicCampaign();
        $firstCampaign = $campaign->where('user_id', $userId)->first();

        if (!$firstCampaign) {
            return redirect('/campaign/new/create');
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


        $campaignId = $newCampaign->id;
        $uerr = User::find($receiver_id->id);


        if ($uerr != null) {
            if ($uerr->token != null) {
                $responseObj = [
                    'userId' => $uerr->id,
                    'source' => 'campaign_created'

                    //                    'manager' => $manager->id
                ];

                $message = "A new campaign has been created ";
                PushNotification::sendToAUser($uerr->token, $responseObj, $message);
            }
        }


        $notification_arr = [
            'user_id' => Auth::id(), 'reference_id' => $receiver_id->id,
            'subject' => $message_array['campign_added']['subject'], 'message' => $message_array['campign_added']['message'],
            'href'   => '' . $campaignId, 'seen' => 0,
            'is_shown' => 0, 'type' => 'campaign',
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        $notification->onlynotification($notification_arr);
        Session::put('new_campaign_id', $campaignId);
        return redirect()->route('campaignaudio')->with('message', "Campaign Successfully created");
    }





    /**
     * @param Request $request
     */
    public function storeAdvertisementAPI(Request $request)
    {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        //$redirect_urls = new RedirectUrls();
        //        // Specify return & cancel URL
        //        $redirect_urls->setReturnUrl(url('/advertisement/paypal/status'))
        //            ->setCancelUrl(url('/advertisement/paypal/status'));
        //
        //        $payment = new Payment();
        //        $payment->setIntent('Sale')
        //            ->setPayer($payer)
        //            ->setRedirectUrls($redirect_urls)
        //            ->setTransactions(array($transaction));
        //
        //        try {
        //            $payment->create($this->_api_context);
        //        } catch (\PayPal\Exception\PayPalConnectionException $ex) {
        ////            Session::flash('alert', 'Something Went wrong, funds could not be loaded');
        ////            Session::flash('alertClass', 'danger no-auto-close');
        //            return redirect('/advertisement/paypal/status');
        //        }
        //
        //        foreach ($payment->getLinks() as $link) {
        //            if ($link->getRel() == 'approval_url') {
        //                $redirect_url = $link->getHref();
        //                break;
        //            }
        //        }

        // add payment ID to session
        //        Session::put('paypal_payment_id', $payment->getId());
        //        Session::put('ads_data', $createInput);


        //        if (isset($redirect_url)) {
        //            // redirect to paypal
        //            return redirect($redirect_url);
        //        }
        $input = $request->all();

        $this->validate(request(), [
            //            'audio' => 'required|mimes:mp3,m4a,wav',
            'title' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif,JPEG,JPG,PNG,GIF|required_without:video_url|max:2048',
            'video_url' => 'required_without:image',
        ]);

        //        Session::put('advertisement_form', $request->all());

        //
        if (isset($input['video_url']) && $input['video_url'] != null) {
            preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $input['video_url'], $match);

            if (!isset($match[1])) {
                return response()->json(["status" => "failure", 'message' => 'invalid_youtube_url'], 400);

                //                return redirect()->back()->withError('Invalid Youtube URL');
            }
        }


        $checkAlreadyExist = Advertisement::where(function ($q) use ($input) {
            $q->where(function ($q) use ($input) {
                $q->whereBetween('start_date', [$input['start_date'],   $input['end_date']])
                    ->orwhereBetween('end_date', [$input['start_date'], $input['end_date']]);
            });
        })->where('user_id', Auth::id())
            ->where('status', '<>', Advertisement::STATUS_CANCEL)
            ->count();

        if ($checkAlreadyExist > 0) {
            $message = 'In this date not available';
            return response()->json(["status" => "failure", 'message' => 'date_not_available'], 400);

            //            return redirect()->back()->with('error', $message);
        }

        //For Approve
        $approveAlreadyExist = Advertisement::where(function ($q) use ($input) {
            $q->where(function ($q) use ($input) {
                $q->whereBetween('start_date', [$input['start_date'],   $input['end_date']])
                    ->orwhereBetween('end_date', [$input['start_date'], $input['end_date']]);
            });
        })->where('status', Advertisement::STATUS_APPROVE)
            ->count();

        if ($approveAlreadyExist > 0) {
            $message = 'Some ads running on this date';
            return response()->json(["status" => "failure", 'message' => 'some_ads_running'], 400);

            //            return redirect()->back()->with('error', $message);
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = request('image');

            $imageName = time() . $file->getClientOriginalName();
            $dir = 'popUpImage';
            $message = $file->move($dir, $imageName);
            $imagePath = $dir . '/' . $imageName;
        }


        $createInput = [
            'user_id' => $user->id,
            'title' => $input['title'],
            'start_date' => $input['start_date'],
            'end_date' => $input['end_date'],
            'image' => $imagePath,
            'video_url' => $input['video_url'],
            'status' => Advertisement::STATUS_PENDING,
            'per_day_amount' => $input['per_day_amount'],
            'transaction_fee' => $input['transaction_fee'],
            'total_days' => $input['total_days']
        ];

        // change 8-4-18
        $receiver_id = DB::table('users')
            ->select('users.id')
            ->where('users.role', 'admin')->first();

        $notification_arr = array();
        $notification = new notification_app();
        $message_array = $notification->adminReceivedMesssages;



        $user = Auth::user();
        if ($user->token != null) {
            $responseObj = [
                'userId' => $user,
                'receiverId' => $receiver_id->id,
                'source' => 'advertisement_created'

            ];

            $message = "Advertisement has been created successfully ";
            PushNotification::sendToAUser($user->token, $responseObj, $message);
        }

        $uerr = User::find($receiver_id->id);


        if ($uerr->token != null) {
            $responseObj = [
                'userId' => $user->id,
                'receiverId' => $uerr->id,
                'source' => 'advertisement_created'

            ];

            $message = "Advertisement has been created successfully for user  " . $user->email;
            PushNotification::sendToAUser($uerr->token, $responseObj, $message);
        }



        $notification_arr = [
            'user_id' => $user->id, 'reference_id' => $receiver_id->id,
            'subject' => $message_array['adveritesement']['subject'], 'message' => $message_array['adveritesement']['message'],
            'href'   => '', 'seen' => 0,
            'is_shown' => 0, 'type' => 'admin',
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ];
        Advertisement::create($createInput);

        $notification->onlynotification($notification_arr);
        return response()->json(["status" => "success"], 200);

        //
        //        $payer = new Payer();
        //        $payer->setPaymentMethod('paypal');
        //        \Log::info('Payment Amount: ');
        //        \Log::info($request->input('amount'));
        //        $item = new Item();
        //        $item->setName('Amount to Add')// item name
        //        ->setCurrency('USD')
        //            ->setQuantity(1)
        //            ->setPrice($request->input('amount')); // unit price
        //
        //        // add item to list
        //        $item_list = new ItemList();
        //        $item_list->setItems([$item]);

        //        $amount = new Amount();
        //        $amount->setCurrency('USD')
        //            ->setTotal($request->input('amount'));
        //
        //        $transaction = new Transaction();
        //        $transaction->setAmount($amount)
        //            ->setItemList($item_list)
        //            ->setDescription('Amount to Add');

        //        $redirect_urls = new RedirectUrls();
        //        // Specify return & cancel URL
        //        $redirect_urls->setReturnUrl(url('/advertisement/paypal/status'))
        //            ->setCancelUrl(url('/advertisement/paypal/status'));
        //
        //        $payment = new Payment();
        //        $payment->setIntent('Sale')
        //            ->setPayer($payer)
        //            ->setRedirectUrls($redirect_urls)
        //            ->setTransactions(array($transaction));
        //
        //        try {
        //            $payment->create($this->_api_context);
        //        } catch (\PayPal\Exception\PayPalConnectionException $ex) {
        ////            Session::flash('alert', 'Something Went wrong, funds could not be loaded');
        ////            Session::flash('alertClass', 'danger no-auto-close');
        //            return redirect('/advertisement/paypal/status');
        //        }
        //
        //        foreach ($payment->getLinks() as $link) {
        //            if ($link->getRel() == 'approval_url') {
        //                $redirect_url = $link->getHref();
        //                break;
        //            }
        //        }
        //
        //        // add payment ID to session
        ////        Session::put('paypal_payment_id', $payment->getId());
        ////        Session::put('ads_data', $createInput);
        //
        //
        //        if (isset($redirect_url)) {
        //            // redirect to paypal
        //            return redirect($redirect_url);
        //        }


        //        Session::flash('alert', 'Unknown error occurred');
        //        Session::flash('alertClass', 'danger no-auto-close');
        //        return redirect('/advertisement/paypal/status');
        //
        //
        //        if(redirect()->route('advertisement.list')) {
        //            Advertisement::create($createInput);
        //            $request->session()->forget('advertisement_form');
        //            return redirect()->route('advertisement.list')->with(['alert' => 'Advertisement successfully created', 'alert_class' => 'success']);
        //        }
    }

    public function marknotificationasread(Notification $notification)
    {
        $user = UserHelper::get_current_user();
        if ($notification->refrence_id == $user->id) {
            $notification->seen = 1;
        }
    }


    public function markallnotificationasread(){
        $user = UserHelper::get_current_user();

        $notificationTable = (new Notification())->getTable();
        DB::table($notificationTable)->where('reference_id', '=', $user->id)->update(array('seen' => 1));

       return response()->json(["status" => "success"], 200);

    }

    // public function get_unread_notification_count(){
    //     $user = UserHelper::get_current_user();
    //     return Notification::where('refrence_id', $user->id)
    //         ->where('seen',0)
    //         ->count()
    // }

    function get_user_table_data(User $user){
        $user->profile_picture = env("APP_URL","https://spinstatz.net").$user->profile_picture;
        return $user;
    }

}

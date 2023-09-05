<?php

namespace App\Http\Controllers;

use App\AcceptedCampaign;
use App\Dj;
use App\Dj_Music;
use App\DjManager;
use App\Helpers\UserHelper;
use App\InviteCode;
use App\MusicType;
use App\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Club;

use App\Country;
use App\State;
use App\City;
use Session;
use Carbon\Carbon;
use App\IdentifiedMusic;
use App\MusicCampaignAudio;
use App\MusicCampaign;
use Symfony\Component\Console\Helper\Helper;
use Tymon\JWTAuth\Facades\JWTAuth;

//use Illuminate\Support\Facades\Validator;

class DjController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function register(Request $data)
    {
        //
        $email = $data->email;
        $code = $data->invitationcode;
        $musicTypes = MusicType::get();

        return view('dj.register', compact('code', 'email', 'musicTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     *
     * This regex will enforce these rules:
     *
     * At least one upper case English letter, (?=.*?[A-Z])
     * At least one lower case English letter, (?=.*?[a-z])
     * At least one digit, (?=.*?[0-9])
     * At least one special character, (?=.*?[#?!@$%^&*-])
     * Minimum eight in length .{8,} (with the anchors)
     */
    public function store(Request $request)
    {


        //return $request;
        $this->validate(request(), [
            'invitationcode' => 'required',
//            'email' => 'required|unique:users,email|confirmed',
//            'username' => 'required|unique:users,username|min:5',
            'firstname' => 'required',
            'password' => 'required|min:8|confirmed',
            'lastname' => 'required',
            'djname' => 'required',
            'phone' => 'required|numeric',
            'city' => 'required',
            'type' => 'required',
        ]);

        //dd("matched");

        $musicTypes = $request->musictype;
        $code = $request->invitationcode;
        $invitation = InviteCode::where('token', $code)->first();


        if ($invitation == null) {
            return redirect()->route('djregisterform')->with('error', "Ask admin for invitation");
        } elseif ($invitation->token == $code && $invitation->created == 1) {
            return redirect()->route('djregisterform')->with('error', "Code already used");
        } else if ($invitation->token == $code && $invitation->created == 0) {
            //$confirmation_code = str_random(30);
            $reciptant = $request->email;
            $manager = User::find($invitation->invited_by);


            $dj = new Dj();
            $user = new User();
            $user->username = explode('@', $invitation->email)[0] . rand(10, 1000);
            $user->password = bcrypt($request->password);
            $user->email = $invitation->email;
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
            $dj->city = $request->city;
            $dj->software = 'n/a';
            $dj->invited_by = $invitation->invited_by;
            $dj->type = $request->type;

            try {
                $dj->save();
            } catch (Exception $e) {
                $user->delete();
                return 'Caught exception: ' . $e->getMessage();
            }


            $invitation->created = 1;
            $invitation->save();

            if ($musicTypes != null)
                foreach ($musicTypes as $musicType) {
                    $djMusic = new Dj_Music();
                    $djMusic->dj_id = $user->id;
                    $djMusic->music_type = $musicType;
                    $djMusic->save();
                }

            $reciptant = $user->email;


            $payload["user_id"] = $user->id;
            $payload["dj_name"] = $dj->dj_name;

            $data["source_app_id"] = "website";
            $data["created_at"] = date('Y-m-d H:i:s');
            $data["topic"] = "dj_created";
            $data["payload"] = $payload;
            //\App\KafkaProducer::produce($data["topic"],json_encode($data));


            Mail::send('email.registration', ['cc' => "test", 'reciptant' => $reciptant], function ($message) use ($reciptant) {
                $message->to($reciptant, 'DJ')->subject('SpinStatz Successful Registration!');
            });

            return redirect()->route('login')->with('message', "Account Successfully Created");

        } else {
            return redirect()->route('djregisterform')->with('error', "invalid code");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Dj $dj
     * @return Response
     */
    public function show(Dj $dj)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Dj $dj
     * @return Response
     */
    public function edit()
    {
        $api = false;
        if (request()->is('api/*')) {
            $api = true;
            $token = JWTAuth::getToken();
        }

        if ($api) {
            $currentUser = JWTAuth::toUser($token);
        } else {
            $currentUser = auth()->user();
        }

        $userId = $currentUser->id;
        $dj = Dj::where('user_id', $userId)->first();


        //return $dj;
        $city = $dj->city()->first();

        if ($city != null) {
            $state = $city->state()->first();
            $country = $state->country()->first();
        } else {
            $state = new State();
            $country = $state;
            $city = $country;
        }
        $clubs = $dj->clubs()->get();
        if ($api) {
            $dj->user = $dj->user;
            return array("dj" => $dj, "city" => $city, "state" => $state, "country" => $country, "clubs" => $clubs);
        }


        return view("dj.edit", compact('dj', 'city', 'state', 'country', 'clubs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Dj $dj
     * @return Response
     */
    public function update(Request $request, Dj $dj)
    {
        $api = false;
        if (request()->is('api/*')) {
            $api = true;
            $token = JWTAuth::getToken();
        }

        if ($api) {
            $currentUser = JWTAuth::toUser($token);
        } else {
            $currentUser = auth()->user();
        }

        if ($dj->user_id != $currentUser->id) {
            return response()->json(array('message' => 'access denied'), 201);
        }

        if ($api) {

        } else {
            $this->validate(request(), [
                'address' => 'required',
                'fname' => 'required',
                'lname' => 'required',
                'djname' => 'required',
                'phone' => 'required',
                'software' => 'required',
                'city' => 'required',
                'zipcode' => 'required',
            ]);
        }


        $dj->first_name = $request->fname;
        $dj->last_name = $request->lname;
        $dj->dj_name = $request->djname;
        $dj->phone_number = $request->phone;
        $dj->software = $request->software;
        $dj->address = $request->address;
        $dj->city = $request->city;
        $dj->zipcode = $request->zipcode;
        $dj->paypal_email = $request->paypal_email;
        $dj->twitter = $request->twitter;
        $dj->instagram = $request->instagram;
        $dj->facebook = $request->facebook;
        $dj->youtube = $request->youtube;
        $dj->soundcloud = $request->soundcloud;


        $dj->save();

        if ($request->password != null) {
            if (!$api) {
                $this->validate(request(), [
                    'password' => 'required|min:9',
                ]);
            }

            $user = Auth::user();
            $user->password = bcrypt($request->password);
            $user->save();
        }
        if ($api) {
            return response()->json(array('message' => 'Profile Updated', 'data'=> $dj), 201);
        }

        return redirect()->route('dj.index', ['id' => $dj->id])->with('message', "Successfully Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Dj $dj
     * @return Response
     */
    public function destroy(Dj $dj)
    {
        //
    }

    public function index($id)
    {

        $dj = (new Dj)->find($id);
        //return $dj;

        $city = City::find($dj->city);

        if ($city != null) {
            //return $city->state()->first()->country()->first();
            $state = $city->state()->first();
            $country = $state->country()->first();
        } else {
            $state = new State();
            $country = new Country();
            $city = new City();
            $state->name = 'Empty';
            $country->name = 'Empty';
            $city->name = 'Empty';
        }


        $manager = User::find($dj->invited_by)->manager()->firstOr();
        $mName = $manager->first_name . " " . $manager->last_name;
        $accCampaignCount = AcceptedCampaign::where('dj_id', $dj->id)->count();
        $completedCampaignCount = IdentifiedMusic::where('dj_id', $dj->user_id)
            ->join('music_campaign_audios', 'music_campaign_audios.id', 'music_id')
            ->distinct('music_campaign_audios.id')->count('music_campaign_audios.id');

        $currentUser = auth()->user();

        if ($currentUser != null) {

            $role = Auth::user()->role;

            if ($role == 'dj') {
                return view('dj.index', compact('dj', 'mName', 'accCampaignCount', 'city', 'state', 'country', 'completedCampaignCount'));
            } else if ($role == 'djmanager') {
                return view('dj.indexformanager', compact('dj', 'mName', 'accCampaignCount', 'city', 'state', 'country', 'completedCampaignCount'));
            } else if ($role == 'campaign') {
                return view('dj.indexforcampaign', compact('dj', 'mName', 'accCampaignCount', 'city', 'state', 'country', 'completedCampaignCount'));
            }
        }
        return view('dj.indexforguest', compact('dj', 'mName', 'accCampaignCount', 'city', 'state', 'country', 'completedCampaignCount'));

    }


    public function showDashboard(Request $request)
    {
        $articles = $this->articles->paginate(20);

        if ($request->ajax()) {
            return view('djdashboard.lay', ['articles' => $articles])->render();
        }

        return view('djdashboard.posts', compact('articles'));
    }

    public function clubs()
    {
        $user = Auth::user();
        $dj = Dj::where('user_id', $user->id)->first();
        $clubs = $dj->clubs()
            ->join('cities', 'cities.id', 'clubs.city')
            ->join('states', 'states.id', 'cities.state_id')
            ->join('countries', 'countries.id', 'states.country_id')
            ->select('clubs.name as club', 'countries.name as country', 'states.name as state', 'cities.name as city_name', 'clubs.*')
            ->get();
        return view('djdashboard.clubs', compact('clubs'));

    }

    public function addclubs(Request $request)
    {
        $user = UserHelper::get_current_user();
        $dj = Dj::where('user_id', $user->id)->first();

        $club = new Club();
        $club->name = $request->clubname;
        $club->dj_id = $dj->id;
        $club->prime_time = $request->prime_time;
        $club->address = $request->address;
        //$club->country = $request->country;
        //$club->state = $request->state;
        $club->city = $request->city;
        $club->capacity = $request->capacity;
        $club->contact = $request->contact;
        $club->phone_no = $request->phone_no;

        $club->save();
        //return $dj;
        $clubs = $dj->clubs()->get();

        if(request()->is('api/*')){
            return response()->json(['status'=>'success', 'venue'=>$club], 200);
        }

        return view('djdashboard.clubs', compact('clubs'));
    }

    public function uploadImage(Request $request)
    {
        $api = false;
        if (request()->is('api/*')) {
            $api = true;
            $token = JWTAuth::getToken();
        }

        if ($api) {
            //Todo: validation
            $user = JWTAuth::toUser($token);
        } else {
            $this->validate(request(), ['file' => 'mimes:jpeg,jpg,PNG,png,gif|required|max:10000']);
            $user = auth()->user();
        }


        if ($request->hasFile('file')) {
            $file = request('file');

            $ppName = time() . $file->getClientOriginalName();
            $dir = 'djProfile';
            $message = $file->move($dir, $ppName);
            $user->profile_picture = $dir . '/' . $ppName;
            $user->save();
        }

        if ($api) {
            return response()->json(array('message' => 'Profile picture Uploaded','picture'=> $user->profile_picture), 201);
        }
        return redirect()->back();
    }


    public function editclub(Club $club)
    {


        $user = Auth::user();
        $dj = Dj::where('user_id', $user->id)->first();

        if ($club->dj_id == $dj->id) {
            $state = $club->city()->first()->state()->first();
            $country = $state->country()->first();
            return view('djdashboard.editclub', compact('club', 'country', 'state'));
        }
    }

    public function updateClub(Club $club, Request $request)
    {

        $user = Auth::user();
        $dj = Dj::where('user_id', $user->id)->first();

        if ($club->dj_id == $dj->id) {
            $club->name = $request->clubname;
            //$club->prime_time = $request->prime_time;
            $club->address = $request->address;
            //$club->country = $request->country;
            //$club->state = $request->state;
            $club->city = $request->city;
            $club->capacity = $request->capacity;
            $club->contact = $request->contact;
            $club->phone_no = $request->phone_no;
            $club->save();
            return redirect('djlogin/success')->with('message', "Club Successfully Updated");
        }

        return redirect('djlogin/success')->with('error', "Club Uptate failed");
    }

    public function deleteClub(Club $club)
    {

        $user = Auth::user();
        $dj = Dj::where('user_id', $user->id)->first();

        if ($club->dj_id == $dj->id) {
            $club->delete();
            $message = "Club " . $club->name . " Successfully Deleted";
            return redirect('djlogin/success')->with('message', $message);
        }

        return redirect('djlogin/success')->with('error', "Club delete failed");
    }

    /* Same on dj manager view*/
    public function matchResultDJ()
    {

        Carbon::setWeekStartsAt(Carbon::SUNDAY);
        Carbon::setWeekEndsAt(Carbon::SATURDAY);
        $currentUser = Auth::user();

        $djid = Dj::where("user_id", $currentUser->id)->first();
        $managerUser = User::find($djid->invited_by);
        $manager = DjManager::where('user_id', $managerUser->id)->first();

        if ($currentUser == null) {
            return redirect('/');
        }


        $sunday = Carbon::now()->startOfWeek();
        $saturday = Carbon::now()->endOfWeek();

        $jsonrecords = collect([]);
        $records = IdentifiedMusic::distinct()->select('music_id')->where('dj_id', '=', $djid->user_id)->groupBy('music_id')->get();


        $totalspins = 0;
        foreach ($records as $record) {
            $thisweekRecords = IdentifiedMusic::whereBetween('played_timestamp', [$sunday, $saturday])->where('dj_id', '=', $djid->user_id)->where('music_id', '=', $record->music_id)->get();
            $lastweekRecords = IdentifiedMusic::whereBetween('played_timestamp', [Carbon::now()->startOfWeek()->subDays(7), Carbon::now()->endOfWeek()->subDays(7)])->where('dj_id', '=', $djid->user_id)->where('music_id', '=', $record->music_id)->get();

            $music = MusicCampaignAudio::find($record->music_id);
            $countrec = IdentifiedMusic::select('music_id')->where([['dj_id', '=', $djid->user_id], ['music_id', '=', $record->music_id]])->get();

            $campaign = MusicCampaign::find($record->music_id);

            if ($music == null) {
                continue;
            }
            $company_name = $music->company_name;


            $singleRec = array('playedByDj' => $djid->dj_name, 'label' => $company_name, 'played_count' => sizeof($countrec), 'music' => $music, 'tw' => $thisweekRecords, 'lw' => $lastweekRecords);
            $totalspins = $totalspins + sizeof($countrec);
            $jsonrecords->push($singleRec);
        }

        $djuser = User::find($djid->user_id);
        $genres = Dj_Music::where('dj_id', $djuser->id)
            ->join('music_types', 'music_types.id', '=', 'music_type')
            ->select('name')
            ->get();

        //return $jsonrecords;
        //return [$jsonrecords, $totalspins,$currentUser,$djid,$djuser,$genres,$manager];
        $clubs = $djid->clubs()->get();

        $dj = $djid;
        return view('dj.history', compact('jsonrecords', 'dj', 'totalspins', 'currentUser', 'djid', 'djuser', 'genres', 'manager', 'clubs'));
    }

    public function allDj()
    {
        $djs = Dj::join('cities', 'city', 'cities.id')
            ->select('djs.dj_name', 'cities.name as city', 'states.name as state', 'djs.id')
            ->join('users', 'users.id', 'djs.user_id')
            ->join('states', 'states.id', 'cities.state_id')
            ->where([['users.blocked', 'no'], ['users.confirmed', 1], ['djs.total_spin', '>=', '0']])
            ->orderBy('state', 'asc')
            ->orderBy('city', 'asc')
            ->paginate(50);
        //->get();
        //return $djs;
        return view('dj.listall', compact('djs'));
    }

    public function allResultDJ()
    {

        Carbon::setWeekStartsAt(Carbon::SUNDAY);
        Carbon::setWeekEndsAt(Carbon::SATURDAY);
        $currentUser = Auth::user();

        $djs = Dj::join('users', 'djs.invited_by', 'users.id')
            ->where([['users.blocked', 'no'], ['confirmed', 1]])
            ->get();
        //return $djs;
        $jsonrecords = collect([]);

        foreach ($djs as $djid) {


            //$djid = Dj::where("user_id",$currentUser->id)->first();
            $managerUser = User::find($djid->invited_by);
            $manager = DjManager::where('user_id', $managerUser->id)->first();

            $sunday = Carbon::now()->startOfWeek();
            $saturday = Carbon::now()->endOfWeek();


            $records = IdentifiedMusic::distinct()
                ->select('music_id', 'club_id')
                ->where('dj_id', '=', $djid->user_id)
                ->distinct('music_id')
                //->groupBy('music_id')
                ->take(5)
                ->get();
            //return $records;

            $totalspins = 0;
            foreach ($records as $record) {
                $thisweekRecords = IdentifiedMusic::whereBetween('played_timestamp', [$sunday, $saturday])->where('dj_id', '=', $djid->user_id)->where('music_id', '=', $record->music_id)->get();
                $lastweekRecords = IdentifiedMusic::whereBetween('played_timestamp', [Carbon::now()->startOfWeek()->subDays(7), Carbon::now()->endOfWeek()->subDays(7)])->where('dj_id', '=', $djid->user_id)->where('music_id', '=', $record->music_id)->get();

                $music = MusicCampaignAudio::find($record->music_id);
                $countrec = IdentifiedMusic::select('music_id')->where([['dj_id', '=', $djid->user_id], ['music_id', '=', $record->music_id]])->take(2)->get();

                $campaign = MusicCampaign::find($record->music_id);

                $club = Club::find($record->club_id);
                //return $record;
                if ($music == null || $club == null) {
                    continue;
                }
                $company_name = $music->company_name;


                if ($club == null) {
                    $club->name = 'blank';
                }
                //return $djid->dj_name;

                $singleRec = array(
                    'playedByDj' => $djid->dj_name,
                    'label' => $company_name,
                    'played_count' => sizeof($countrec),
                    'music' => $music,
                    'tw' => $thisweekRecords,
                    'lw' => $lastweekRecords,
                    'dj_name' => $djid->dj_name,
                    'club_name' => $club->name,
                    'club_capacity' => $club->capacity,

                );
                $totalspins = $totalspins + sizeof($countrec);
                $jsonrecords->push($singleRec);
            }


            //$djuser = User::find($djid->user_id);
            // $genres = Dj_Music::where('dj_id', $djuser->id)
            //             ->join('music_types','music_types.id','=','music_type')
            //             ->select('name')
            //             ->get();
        }
        //return $jsonrecords;
        //return [$jsonrecords, $totalspins,$currentUser,$djid,$djuser,$genres,$manager];
        //$clubs = $djid->clubs()->get();


        return view('dj.allhistory', compact('jsonrecords', 'totalspins', 'currentUser', 'djid', 'djuser', 'genres', 'manager', 'clubs'));
    }

    public function download(Request $request)
    {
        $user = Auth::user();
        $dj = $user->dj()->first();

        if ($request->type == "windows") {
            $dj->downloaded = 1;
            $path = "builds/SpinstatzInstaller.exe";
        } else {
            $dj->downloaded = 2;
            $path = "builds/spinstatz-destop-app.dmg";
        }
        $dj->save();

        return response()->download($path)->deleteFileAfterSend(false);
    }

    public function showdownload()
    {
        return view('dj.downloadpage');
    }

    public function viewinvitecampaign()
    {
        $role = Auth::user()->role;

        if ($role == 'dj') {
            $layout = 'layouts.djapp';
        } else if ($role == 'campaign') {
            $layout = 'layouts.campaignapp';
        } else if ($role == 'advertiser') {
            $layout = 'layouts.advertiser';
        } else {
            return "0";
        }
        //return $role;
        return view('dj.invitecampaign', compact('layout'));
    }

    public function invitecampaign(Request $request)
    {

        $this->validate($request, [
            'email' => 'required',
        ]);

        $user = Auth::user();
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

        return redirect()->back()->withMessage('Invitation Successful');

    }

    public function newregister(Request $data)
    {
        $code = $data->invitationcode;

        return view('v2.dj.register', compact('code'));
    }

    public function storenewregister(Request $request)
    {
        $this->validate(request(), [
            'firstname' => 'required',
            'password' => 'required|min:8|confirmed',
            'lastname' => 'required',
            'phone' => 'required|numeric',
            'city' => 'required',
            'type' => 'required',
        ]);


        $invitation = InviteCode::where('token', $request->invitationcode)->first();


        if ($invitation == null) {
            $invited_by = 1;
        } elseif ($invitation->created == 1) {
            return redirect()->back()->with('error', "Code already used");
        } else {
            $invited_by = $invitation->invited_by;
        }

        $manager = User::find($invited_by);

        $dj = new Dj();
        $user = new User();

        $user->password = bcrypt($request->password);
        $user->email = $invitation->email;
        $user->confirmation_code = "not required";
        $user->role = "dj";
        $user->confirmed = 1;
        $user->profile_picture = $manager->profile_picture;
        $user->save();

        $dj->first_name = $request->firstname;
        $dj->last_name = $request->lastname;
        $dj->club_name = 'deleteThisfield';
        $dj->user_id = $user->id;
        //$dj->country = $request->country;
        $dj->city = $request->city;
        $dj->invited_by = $invited_by;
        $dj->type = $request->type;

        try {
            $dj->save();
        } catch (Exception $e) {
            $user->delete();
            return 'Caught exception: ' . $e->getMessage();
        }


        $invitation->created = 1;
        $invitation->save();
        return redirect()->route('login')->with('message', "Account Successfully Created");
    }

    function getspinnedvioeos(){
        $spins = \App\IdentifiedMusic::where('videos','!=', 'null')
            ->where('dj_id',Auth::id())
            ->orderBy('id','desc')
            ->paginate(9);

        return view('v3.dj.spinvideos',compact('spins'));
    }
}


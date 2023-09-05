<?php

namespace App\Http\Controllers;

use App\DjManager;
use App\Dj;
use App\Helpers\PusherData;
use App\DjManagerMusicSpin;
use App\InviteCode;
use App\MusicCampaignAudio;
use App\MusicType;
use App\User;
use Illuminate\Http\Request;
use Auth;
use App\MusicCampaign;
use Carbon\Carbon;
use App\IdentifiedMusic;
use App\Notification;
use DB;
use Illuminate\Support\Facades\Mail;

use App\Country;
use App\State;
use App\City;
use App\Advertisement;

use App\Dj_Music;
use App\Helpers\notification_app;
use App\Helpers\PushNotification;

class DjManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $campaigns;
    public $output;

    public function __construct(MusicCampaign $campaigns)
    {
        $this->campaigns = $campaigns;
        //$this->output = new ConsoleOutput();

    }


    public function index()
    {
        $currentUser = auth()->user();
        //return $currentUser;
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
        return view('DjManager.index', compact('currentUser', 'jsonrecords', 'djManager','getAds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $musicTypes = MusicType::all();
        $code = request('invitationcode');
        $reciptant = request('email');
        return view('DjManager.create', compact('musicTypes', 'code', 'reciptant'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [

            'email'  => 'required|unique:users,email',
        ]);


        $invitation = InviteCode::where('email', $request->email)->first();
        $code = $request->invitationcode;


        if ($invitation == null) {
            return redirect()->route('djmanager.create')->with('error', "Ask admin for invitation");
        } elseif ($invitation->token == $code && $invitation->created == 1) {
            return redirect()->route('djmanager.create')->with('error', "Code already used");
        } elseif ($invitation->token != $code) {
            return redirect()->route('djmanager.create')->with('error', "Token not found. Please check email for new invitation mail.");
        } else if ($invitation->token == $code && $invitation->created == 0 && $invitation->user_type == 'djmanager') {
            $cc = str_random(30);
            //$confirmation_code = str_random(30);
            $reciptant = $request->email;
            $invitation->created = 0;
            $invitation->save();

            $user = new User();
            $user->username = $request->username;
            $user->password = bcrypt($request->password);
            $user->email = $request->email;
            $user->role = 'djmanager';
            $user->confirmed = 1;
            $user->confirmation_code = $cc;


            $djManager = new DjManager();
            $djManager->first_name = $request->firstname;
            $djManager->last_name = $request->lastname;
            $djManager->country = $request->country;
            $djManager->state = $request->state;
            $djManager->city = $request->city;
            $djManager->zipcode = $request->zipcode;
            $djManager->phone_no = $request->phone;
            $djManager->company_name = $request->companyname;
			$djManager->company_address = $request->companyaddress;
            $djManager->company_country = $request->companycountry;
            $djManager->company_city = $request->companycity;
            $djManager->company_state = $request->companystate;
            $djManager->company_zipcode = $request->companyzipcode;
            $djManager->company_taxid = $request->taxid;
            $djManager->year_created = $request->year_created;
            $djManager->facebook = $request->fbook;
            $djManager->twitter = $request->tw;
            $djManager->instagram = $request->instagram;
            $djManager->website = $request->weburl;
            $user->save();

            $djManager->user_id = $user->id;


            try {
                $djManager->save();

                // Mail::send('email.verification', ['link' => '/register/verify/' . $cc,
                //     'username' => $request->username
                // ], function ($message) use ($reciptant) {
                //     $message->to($reciptant, '')->subject('Confirm Coliation Registration- SpinStatz.net');
                // });

            } catch (Exception $e) {
                $user->delete();
                return 'Caught exception: ' . $e->getMessage();
            }


            $musicTypes = $request->musictype;
            if ($musicTypes != null)
                foreach ($musicTypes as $musicType) {
                    $djMusic = new DjManagerMusicSpin();
                    $djMusic->manager_id = $user->id;
                    $djMusic->music_spin_type = $musicType;
                    $djMusic->save();
                }


                $payload["user_id"]  = $user->id;
                $payload["manager_name"]  = $djManager->first_name . " " . $djManager->last_name;

                $data["source_app_id"] = "website";
                $data["created_at"] = date('Y-m-d H:i:s');
                $data["topic"] = "manager_created";
                $data["payload"] = $payload;
                \App\KafkaProducer::produce($data["topic"],json_encode($data));


                return redirect()->route('login')->with('message', "You are successfully Registered");
            }




    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DjManager $djManager
     * @return \Illuminate\Http\Response
     */
    public function show(DjManager $djManager)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DjManager $djManager
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //

        $currentUser = auth()->user();
        //return $currentUser;

        $djmanager = DjManager::where('user_id', $currentUser->id)->first();

        $city = $djmanager->city()->first();

        if ($city != null) {
            $state = $city->state()->first();
            $country = $state->country()->first();
        } else {
            $state = new State();
            $country = $state;
            $city = $country;
        }

        return view('DjManager.update', compact('currentUser', 'djmanager', 'state', 'country', 'city'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\DjManager $djManager
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DjManager $djManager)
    {
        // $this->validate(request(), [

        //     'email'          => 'required|unique:users,email|confirmed',
        //     'first_name'      => 'required',
        //     'last_name'       => 'required',
        // ]);
        $user = Auth::user();
        $djmanager = DjManager::where('user_id', $user->id)->first();

        if ($request->hasFile('logo')) {
            $file = request('logo');

            $logoName = time() . $file->getClientOriginalName();
            $dir = 'managerLogo';
            $message = $file->move($dir, $logoName);
            $djmanager->logo = $dir . '/' . $logoName;
        }
        //

        if ($request->hasFile('profile-picture')) {
            $file = request('profile-picture');

            $ppName = time() . $file->getClientOriginalName();
            $dir = 'managerProfile';
            $message = $file->move($dir, $ppName);
            $user->profile_picture = $dir . '/' . $ppName;
        }


        $djmanager->first_name = $request->first_name;
        $djmanager->last_name = $request->last_name;
        $user->email = $request->email;

        $djmanager->city = $request->city;
        $djmanager->zipcode = $request->zipcode;
        $djmanager->phone_no = $request->phone;
        $djmanager->save();
        if(isset($request->password)){
            if($request->password == $request->password_confirm){
                $user->password = bcrypt($request->password);
            }
        }

        $user->save();
        return redirect()->route('djmanager.edit');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DjManager $djManager
     * @return \Illuminate\Http\Response
     */
    public function destroy(DjManager $djManager)
    {
        //
    }

    public function invite()
    {
        $currentUser = auth()->user();
        return view('DjManager.invite', compact('currentUser'));
    }

    public function getActiveCampaign()
    {
        //DB::table('packages')->whereRaw('json_contains(destinations, \'["Goa"]\')')->get();
        $djManagerID = Auth::Id();
        $djManager = DjManager::where('user_id', $djManagerID)->first();
        $currentUser = auth()->user();


        $managerMusicCampaign = MusicCampaign::whereRaw('json_contains(target_colition, \'[' . $djManager->id . ']\')')
            ->select('music_campaigns.id as audio_id','music_campaign_audios.*','music_campaigns.*')
            //->where('accepted','!=', '-1')
            ->join('music_campaign_audios', 'music_campaign_audios.campaign_id', 'music_campaigns.id')
            ->get();
        //return $managerMusicCampaign;
        return view('DjManager.active_campaign', compact('managerMusicCampaign', 'currentUser', 'djManager'));
        //return $managerMusicCampaign;

    }

    //added 11-8
    public function campaign_invitation() {
        return view('admin.campaign_invitation');
    }

    public function uploadImage(Request $request)
    {
        $user = Auth::user();
        $this->validate(request(), [
            'file' => 'mimes:jpeg,jpg,png,gif|required|max:10000']);
        if ($request->hasFile('file')) {
            $file = request('file');

            $ppName = time() . $file->getClientOriginalName();
            $dir = 'djManagerProfile';
            $message = $file->move($dir, $ppName);
            $user->profile_picture = $dir . '/' . $ppName;
            $user->save();
        }
        return redirect()->back();
    }


    public function action($cid, $action)
    {
        $djManagerID = Auth::Id();
        $djManager = DjManager::where('user_id', $djManagerID)->first();

        if ($action == "accept") {
            $managerMusicCampaign = MusicCampaign::find($cid);
            $managerMusicCampaign->accepted = 1;
            $managerMusicCampaign->save();
        } elseif ($action == "decline") {
            $managerMusicCampaign = MusicCampaign::find($cid);
            $managerMusicCampaign->accepted = -1;
            $managerMusicCampaign->save();
        }

    }

    public function weeklyactivity($count)
    {
        Carbon::setWeekStartsAt(Carbon::SUNDAY);
        Carbon::setWeekEndsAt(Carbon::SATURDAY);
        $currentUser = Auth::user();

        if ($currentUser == null) {
            return redirect('/');
        }

        if ($count < 0) {
            return 0;
        }

        $startDate = Carbon::now()->startOfWeek()->subWeeks($count);
        $endDate = Carbon::now()->endOfWeek()->subWeeks($count);

        //$startDate = Carbon::now()->startOfWeek();
        //$endDate = Carbon::now();

        //return [$startDate, $endDate];

        $identifiedMusics = IdentifiedMusic::where('played_timestamp', '>=', $startDate)
            ->select(DB::raw('DAYNAME(played_timestamp) as date'), DB::raw('count(*) as views'))
            ->join('djs', 'djs.user_id', 'dj_id')
            ->groupBy('date')
            ->where('played_timestamp', '<=', $endDate)
            ->where('djs.invited_by', $currentUser->id);

        return $identifiedMusics->get();

    }


    public function yearlyactivity($count)
    {
        $currentUser = Auth::user();

        if ($currentUser == null) {
            return redirect('/');
        }

        if ($count < 0) {
            return 0;
        }

        $startDate = Carbon::now()->startOfYear()->subYears($count);
        $endDate = Carbon::now()->endOfYear()->subYears($count);


        $identifiedMusics = IdentifiedMusic::where('played_timestamp', '>=', $startDate)
            ->select(DB::raw('MONTHNAME(played_timestamp) as date'), DB::raw('count(*) as views'))
            ->join('djs', 'djs.user_id', 'dj_id')
            ->groupBy('date')
            ->where('played_timestamp', '<=', $endDate)
            ->where('djs.invited_by', $currentUser->id);

        return $identifiedMusics->get();

    }

    public function getNotification()
    {

        $user = Auth::user();
        
        /*$notification = Notification::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();*/
        
        $notificationsList = [];
        $messages = '';
        if($user->role == 'dj') {
            $messages=DB::table('notifications')
                ->select(DB::raw("group_concat(message SEPARATOR '<br/>') as messages"))
                ->where('reference_id',$user->id)
                ->where('seen',0)
                ->orderBy('id', 'desc')->first();

            $count = DB::table('notifications')->where('reference_id', $user->id)
                ->where('seen', 0)
                ->count();

            $notifications=DB::table('notifications')
                ->where('reference_id',$user->id)
                ->where('is_shown',0)
                ->orderBy('id', 'desc')->get()->take(10);
            foreach($notifications as $notication)
            {
                if(true)
                {
                    $subject=$notication->subject;
                    $targetId=$notication->href;
                    $type=$notication->type;
                    $newhref='';
                    $hasTarget=false;
                    if($targetId)
                    {
                        if($targetId!='#'){
                            $hasTarget=true;
                        }
                    }
                    if($subject=='New Music Uploaded')
                    {
                        if($hasTarget) {
                            $audio=MusicCampaignAudio::find($targetId);
                            if($audio!=null)
                            {
                                $newhref = '/dj/campaign/' . ($audio->campaign_id);

                                $notication->audioImage="/".$audio->artwork;
                            }
                        }
                        else{
                            $newhref='/dj/accepted/campaign';
                        }
                    }
                    elseif($subject=='Campaingn low balance')
                    {
                        if ($hasTarget) {
                            if ($type == 'admin') {
                                $newhref = '/campaign/';
                            } elseif ($type == 'approved') {
                                $newhref = '/view/campaign/' . ($targetId);
                            } elseif ($type == 'completed') {
                                $newhref = '/view/campaign/' . ($targetId);
                            } elseif ($type == 'Pending') {
                                $newhref = '/view/campaign/' . ($targetId);
                            }
                        }
                        else{
                            if ($type == 'admin') {
                                $newhref = '/campaign/';
                            } elseif ($type == 'approved') {
                                $newhref = '/djmanager/campaigns';
                            } elseif ($type == 'completed') {
                                $newhref = '/djmanager/campaigns';
                            } elseif ($type == 'Pending') {
                                $newhref = '/djmanager/campaigns';
                            }
                        }
                    }
                    elseif($subject=='Music Evennt')
                    {

                    }
                    elseif($subject=='Dj Withdraw')
                    {
                        $newhref='/admin/request/payments';
                    }
                    elseif($subject=='Campign add')
                    {
                        if($user->role=='admin')
                        {
                            $newhref='/campaign';
                        }
                        elseif ($user->role=='admin')
                        {
                            $newhref='/campaign/list';
                        }
                    }
                    elseif($subject=='denied')
                    {
                        $newhref='/advertisementList';
                    }
                    $notication->href=$newhref;
                    
                    $user = DB::table('users')
                        ->where('id',$notication->user_id)->first();

                    $notication->username = $user->username;
                    $notication->message =  '<b>'.ucfirst($user->username).'</b> has '.strtolower($notication->message);
                    if($subject=='Campign add') {
                        $notication->image = file_exists($user->profile_picture) ? $user->profile_picture : $notication->image;
                    }
                }
                $notificationsList[] = $notication;
            }
        }
        else {
            $notifications=DB::table('notifications')
                ->where('reference_id',$user->id)->where('is_shown',0)->orderBy('id', 'desc')->get()->take(10);

            foreach($notifications as $notication)
            {
                if(true)
                {
                    $subject=$notication->subject;
                    $targetId=$notication->href;
                    $type=$notication->type;
                    $newhref='';
                    $hasTarget=false;
                    if($targetId)
                    {
                        if($targetId!='#')
                        {
                            $hasTarget=true;
                        }
                    }
                    if($subject=='New Music Uploaded')
                    {
                        if($hasTarget) {
                            $audio=MusicCampaignAudio::find($targetId);
                            if($audio!=null)
                            {
                                $newhref = '/dj/campaign/' . ($audio->campaign_id);

                                $notication->audioImage="/".$audio->artwork;
                            }
                        }
                        else{
                            $newhref='/dj/accepted/campaign';
                        }
                    }
                    elseif($subject=='Campaingn low balance')
                    {
                        if ($hasTarget) {
                            if ($type == 'admin') {
                                $newhref = '/campaign/';
                            } elseif ($type == 'approved') {
                                $newhref = '/view/campaign/' . ($targetId);
                            } elseif ($type == 'completed') {
                                $newhref = '/view/campaign/' . ($targetId);
                            } elseif ($type == 'Pending') {
                                $newhref = '/view/campaign/' . ($targetId);
                            }
                        }
                        else{
                            if ($type == 'admin') {
                                $newhref = '/campaign/';
                            } elseif ($type == 'approved') {
                                $newhref = '/djmanager/campaigns';
                            } elseif ($type == 'completed') {
                                $newhref = '/djmanager/campaigns';
                            } elseif ($type == 'Pending') {
                                $newhref = '/djmanager/campaigns';
                            }
                        }
                    }
                    elseif($subject=='Music Evennt')
                    {
                        $newhref='/djmanager/manage/actions';
                    }
                    elseif($subject=='Dj Withdraw')
                    {
                        $newhref='/admin/request/payments';
                    }
                    elseif($subject=='Campign add')
                    {
                        if($user->role=='admin')
                        {
                            $newhref='/campaign';
                        }
                        elseif ($user->role=='admin')
                        {
                            $newhref='/campaign/list';
                        }
                    }
                    elseif($subject=='denied')
                    {
                        $newhref='/advertisementList';
                    }
                    $notication->href=$newhref;
                    //$notication->href=$hasTarget;
                }
                $notificationsList[] = $notication;
            }
            $count = DB::table('notifications')->where('reference_id', $user->id)
                ->where('seen', 0)
                ->count();
        }
        return [$count, $notificationsList, $messages];
    }    

    public function blockDj(Dj $dj)
    {
        //return $dj;

        $managerId = Auth::Id();
        //return [$managerId, $dj->invited_by];

        if ($dj->invited_by == $managerId) {
            $user = User::find($dj->user_id);

            $user->blocked = "yes";
            $user->save();

            $reciptant = $user->email;
            $env = env('APP_ENV');

            if ($env == 'production') {

                Mail::send('email.deactivated', ['cc' => "test", 'reciptant' => $reciptant], function ($message) use ($reciptant) {
                    $message->to($reciptant, 'DJ')->subject('SpinStatz - Sorry Your DJ account has been Deactivated!');
                });

            }

            return array("response" => "success");

        }

        return array("response" => "failed");

    }

    public function unblockDj(Dj $dj)
    {

        $managerId = Auth::Id();
        //return [$managerId, $dj->invited_by];

        if ($dj->invited_by == $managerId) {
            $user = User::find($dj->user_id);
            $user->blocked = "no";
            $user->save();

            $reciptant = $user->email;

            $env = env('APP_ENV');

            if ($env == 'production') {

                Mail::send('email.activated', ['cc' => "test", 'reciptant' => $reciptant], function ($message) use ($reciptant) {
                    $message->to($reciptant, 'DJ')->subject('SpinStatz - CONGRATULATIONS Your DJ account has been Verified!');
                });
            }

            return array("response" => "success");
        }


        return array("response" => "failed");

    }


    public function editDj(Dj $dj)
    {

        $managerId = Auth::id();


        if ($dj->invited_by == $managerId) {
            $city = $dj->city()->first();
            if ($city != null) {
                $state = $city->state()->first();
                $country = $state->country()->first();
            } else {
                $state = new State();
                $country = $state;
                $city = $country;
            }

            //$currentUser = User::find($dj->user_id);
            return view('dj.editbymanager', compact('dj', 'country', 'state', 'city'));
        }
        return redirect('/djmanager');
    }

    public function updateDj(Dj $dj)
    {

        $managerId = Auth::Id();
        //return [$managerId, $dj->invited_by];

        if ($dj->invited_by == $managerId) {
            $user = User::find($dj->user_id);
            return $user;
        }

        return redirect('/djmanager');

    }


    /*public function sendMessage(Request $request)
      {

        $data=array(
          'sender_id' =>Auth::user()->id,
          'receiver_id' => $request->recever_id,
          'message' =>$request->message,
          'status' =>0,
          );

        DB::table('chat_history')->insert($data);
        $sender=DB::table('users')
              ->select('users.email','djs.dj_name')
              ->join('djs','djs.user_id','=','users.id')
              ->where('djs.id',$request->recever_id)->first();

  $result = Mail::send('email.message', ['name' => $sender->dj_name, 'body' => $request->message], function ($message) use ($sender) {
                $message->to($sender->email, 'DJ')->subject('SpinStatz DJ Message');
            });
        return redirect()->route('djmanager.message')->with('message', "Message successfully Sent");
      }

      public function message()
      {

        $inbox=DB::table('chat_history')
        ->select('djs.dj_name','chat_history.*')
        ->join('djs','djs.id','=','chat_history.receiver_id')
        ->whereSender_id(Auth::user()->id)->get();

        return view('DjManager.inbox',compact('inbox'));
      }
*/

    public function trends()
    {
        return view('DjManager.trends');

    }

    public function dailyTrends(Dj $dj)
    {

        return $dj;

    }

    public function weeklyTrends(Dj $dj)
    {

        return $dj;

    }

    public function monthlyTrends(Dj $dj)
    {

        return $dj;

    }

    public function yearlyTrends(Dj $dj)
    {

        return $dj;

    }

    public function compose()
    {
        $currentUser = auth()->user();
        $djs = $currentUser->djs;

        $user = DB::table('users')
            ->select('users.username', 'users.email','users.blocked','djs.*', 'cities.name as c_name')
            ->join('djs', 'djs.user_id', '=', 'users.id')
            ->leftJoin('cities', 'cities.id', '=', 'djs.city')
            ->where('users.role', 'dj')
            ->where('djs.invited_by', Auth::user()->id)
            ->get();
        $genrs = DB::table('dj__musics')
            ->select('music_types.name as genrs', 'dj__musics.dj_id')
            ->leftJoin('music_types', 'music_types.id', '=', 'dj__musics.music_type')
            ->get();


        return view('DjManager.message_compose', compact('currentUser', 'user', 'genrs'));
    }

    public function sendMessage(Request $request)
    {

        if ($request->djs !== "" && isset($request->djs)) {
       //dd('hii');
            foreach (json_decode($request->djs) as $value) {
                $chat_data = array(
                    'sender_id' => Auth::user()->id,
                    'receiver_id' => $value,
                    'message' => $request->message,
                    'status' => 0,
                    'created_at' => date('Y-m-d h:i:s'),
                    'updated_at' => date('Y-m-d h:i:s')
                );

                $receiver=User::find($value);

                if($receiver!=null) {
                    if ($receiver->token != null) {
                        $responseObj = [
                            'userId' => $receiver->id,
                            'source'=>'message'

//                    'manager' => $manager->id
                        ];

                        $message=[

                            'html'=>'<li><a class="dropdown-menu-notifications-item" href="/djmanagers/messages/inbox" data-id="205161"><span class="dropdown-menu-notifications-item-content"><span class="fa fa-credit-card-alt"></span> <span><p>Message</p><p>New Message added on Your Inbox</p></span></span><span class="dropdown-menu-notifications-item-ago"></span></a></li>'
                        ];

                        $data=['user_id' =>Auth::id(), 'reference_id' => $receiver->id,'subject' => 'Message','message'=> $request->message,'href'   => '','seen' => 0,'is_shown' => 0, 'type' => 'admin',"created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s'),
                        ];

                        \App\Helpers\Notification::send(2,$data,$message);

                    }
                }

                DB::table('chat_history')->insert($chat_data);
                $sender = DB::table('users')
                    ->select('users.email', 'djs.dj_name')
                    ->join('djs', 'djs.user_id', '=', 'users.id')
                    ->where('djs.id', $value)->first();
                $result = Mail::send('email.message', ['name' => $sender->dj_name, 'body' => $request->message], function ($message) use ($sender) {
                    $message->to($sender->email, 'DJ')->subject('SpinStatz DJ Message');
                });
            }


        } else {
            $data = array(
                'sender_id' => Auth::user()->id,
                'receiver_id' => $request->recever_id,
                'message' => $request->message,
                'status' => 0,
            );

            $receiver= Dj::find($request->recever_id);
            $receiver_data= User::find($receiver->user_id);
            //dd($receiver);
            if($receiver_data!=null) {
            //dd($receiver_data);

                if ($receiver_data->token != null) {
                // dd('hhhh');
                    $responseObj = [
                        'userId' => $receiver_data->id,
                        'source'=>'message'

//                    'manager' => $manager->id
                    ];

                    $user_Id = $responseObj['userId'];

                        $message=[

                            'html'=>'<li><a class="dropdown-menu-notifications-item" href="/djmanagers/messages/inbox" data-id="205161"><span class="dropdown-menu-notifications-item-content"><span class="fa fa-credit-card-alt"></span> <span><p>Message</p><p>New Message added on Your Inbox</p></span></span><span class="dropdown-menu-notifications-item-ago"></span></a></li>'
                        ];

                        $data1 = array('reference_id' => $receiver_data->id,"is_shown"=>"0",'user_id'=>Auth::user()->id, 'subject'=>'Message','message' => 'New Message added on Your Inbox', 'href' => '', 'type' => 'new-message', 'seen' => 0);

                        \App\Helpers\Notification::send(2,$data1,$message);


                }
               //dd('kkkk');
            }

            DB::table('chat_history')->insert($data);
            $sender = DB::table('users')
                ->select('users.email', 'djs.dj_name')
                ->join('djs', 'djs.user_id', '=', 'users.id')
                ->where('djs.id', $request->recever_id)->first();
                $result = Mail::send('email.message', ['name' => $sender->dj_name, 'body' => $request->message], function ($message) use ($sender) {
                $message->to($sender->email, 'DJ')->subject('SpinStatz DJ Message');
            });
        }


        return redirect()->route('djmanager.message')->with('message', "Message successfully Sent");
    }


    public function message()
    {
        $sent = DB::table('chat_history')
            ->select('djs.dj_name', 'chat_history.*')
            ->leftjoin('djs', 'djs.id', '=', 'chat_history.receiver_id')
            ->whereSender_id(Auth::user()->id)->get();

        $inbox = DB::table('chat_history')
            ->select('djs.dj_name', 'chat_history.*')
            ->leftjoin('djs', 'djs.id', '=', 'chat_history.sender_id')
            ->whereReceiver_id(Auth::user()->id)
            ->get();

        return view('DjManager.inbox', compact('inbox', 'sent'));
    }

    public function removeMessage(Request $request)
    {
        if (!empty($request->messageIds)) {
            DB::table('chat_history')->whereIn('id', $request->messageIds)->delete();
            return redirect()->route('djmanager.message')->with('message', "Message successfully Deleted");
        } else {
            return redirect()->route('djmanager.message')->with('message', "Please Select The message");
        }


    }

    public function manageActions()
    {
        $user = auth()->user();
        //$manager = $user->manager()->first();

        //return $user;

        $djs = \App\Dj::where('invited_by', $user->id)
            ->where('djs.type', 'mobile')
            ->orderBy('dj_name', 'asc')
            ->get();

        $events  = \App\DjEvents::join('djs','djs.id','dj_events.dj_id')
                    ->where('djs.invited_by',$user->id)
                    ->select('dj_events.dj_id','dj_events.name as event', 'djs.dj_name','dj_events.start_time','dj_events.end_time','dj_events.status')
                    ->where('djs.type', 'mobile')
                    ->get();

        //return $events;

        return view('DjManager.action', compact('djs','events'));

    }

    public function allCampaigns(Request $request)
    {
        $currentUser = auth()->user();
        $id = Auth::Id();
        $manager = DjManager::where('user_id',$id)->first();


        $campaigns = $this->campaigns
                        ->join('music_campaign_audios','music_campaign_audios.campaign_id','music_campaigns.id')
                        ->orderBy('music_campaigns.id', 'desc')
                        ->paginate(15);

        if ($request->ajax()) {
            return view('djdashboard.lay', ['campaigns' => $campaigns])->render();
        }

        $genres = MusicType::select('id as music_type','name')->get();

        return view('DjManager.campaigns', compact('campaigns','genres'));
    }

    public function alphabet(Request $request)
    {

        $id = Auth::Id();
        $dj = Dj::where('user_id',$id)->first();
        //$dj->id = 6;
        $genres = Dj_Music::where('dj_id', $dj->id)->select('music_type')
                    ->get();
        $genre_ids = array();



        for($i = 0; $i< count($genres); $i++){
            $genre_ids[] =   $genres[$i]['music_type'];
        }

        $campaigns = $this->campaigns
                    ->orderBy('campaign_name')
                    ->join('music_campaign_audios','music_campaign_audios.campaign_id','music_campaigns.id')
                    ->where(function($query) use ($genre_ids) {
                            for($i = 0; $i<sizeof($genre_ids); $i++ ){
                                 $query->orWhereRaw('JSON_CONTAINS(music_campaign_audios.genre, \'['.$genre_ids[$i].']\')');
                            }

                        })
                    ->paginate(15);
        if ($request->ajax()) {
            return view('djdashboard.lay', ['campaigns' => $campaigns])->render();
        }
        return view('djdashboard.posts', compact('campaigns','dj', 'accepted','genres'));
    }

    public function rate(Request $request)
    {
        $id = Auth::Id();
        $dj = Dj::where('user_id',$id)->first();
        //$dj->id = 6;
        $genres = Dj_Music::where('dj_id', $dj->id)
                ->select('music_type')
                ->get();
        $genre_ids = array();



        for($i = 0; $i< count($genres); $i++){
            $genre_ids[] =   $genres[$i]['music_type'];
        }

        $campaigns = $this->campaigns
                    ->orderBy('spin_rate','desc')
                    ->join('music_campaign_audios','music_campaign_audios.campaign_id','music_campaigns.id')
                    ->where(function($query) use ($genre_ids) {
                            for($i = 0; $i<sizeof($genre_ids); $i++ ){
                                 $query->orWhereRaw('JSON_CONTAINS(music_campaign_audios.genre, \'['.$genre_ids[$i].']\')');
                            }

                        })
                    ->paginate(15);
        if ($request->ajax()) {
            return view('djdashboard.lay', ['campaigns' => $campaigns])->render();
        }
        return view('djdashboard.posts', compact('campaigns','dj', 'accepted'));
    }


     public function like(Request $request)
    {
        $id = Auth::Id();
        $dj = Dj::where('user_id',$id)->first();
        //$dj->id = 6;
        $genres = Dj_Music::where('dj_id', $dj->id)
                ->select('music_type')
                ->get();
        $genre_ids = array();

        for($i = 0; $i< count($genres); $i++){
            $genre_ids[] =   $genres[$i]['music_type'];
        }

        $campaigns = $this->campaigns
                    ->orderBy('likes','desc')
                    ->join('music_campaign_audios','music_campaign_audios.campaign_id','music_campaigns.id')
                    ->where(function($query) use ($genre_ids) {
                            for($i = 0; $i<sizeof($genre_ids); $i++ ){
                                 $query->orWhereRaw('JSON_CONTAINS(music_campaign_audios.genre, \'['.$genre_ids[$i].']\')');
                            }

                        })
                    ->paginate(15);
        if ($request->ajax()) {
            return view('djdashboard.lay', ['campaigns' => $campaigns])->render();
        }

        $now = \Carbon\Carbon::now();
        $m = ($now->subMonth())->format('F');
        $month = $now->month;
        $m = ($now->subMonth())->format('F');

        $emonth = $month-1 == 0?12:$month-1;
        $currentUser = auth()->user();


        $lm =  \App\IdentifiedMusic::whereMonth('created_at', '=', $emonth)
                ->where('dj_id',$currentUser->id)
                ->count();
        $tm =  \App\IdentifiedMusic::whereMonth('created_at', '=', $month)
                ->where('dj_id',$currentUser->id)
                ->count();
        $diff = $tm-$lm;

        return view('djdashboard.posts', compact('campaigns','dj', 'accepted','lm','m','diff'));
    }

    public function genres(MusicTYpe $genre, Request $request)
    {

        $id = Auth::Id();
        $dj = Dj::where('user_id',$id)->first();
        $genre_ids[] =  $genre->id;


        $campaigns = $this->campaigns
                    ->join('music_campaign_audios','music_campaign_audios.campaign_id','music_campaigns.id')
                    ->where(function($query) use ($genre_ids) {
                            for($i = 0; $i<sizeof($genre_ids); $i++ ){
                                 $query->orWhereRaw('JSON_CONTAINS(music_campaign_audios.genre, \'['.$genre_ids[$i].']\')');
                            }

                        })
                    ->paginate(15);
        if ($request->ajax()) {
            return view('djdashboard.lay', ['campaigns' => $campaigns])->render();
        }else{
            return $campaigns;
        }

    }

    public function getNotificationv1(Request $request){
        $user_id = Auth::id();

    }
}


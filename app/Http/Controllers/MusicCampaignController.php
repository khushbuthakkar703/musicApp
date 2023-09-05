<?php

namespace App\Http\Controllers;

//use App\MusicCampaign;

use App\AdditionalCampaignMusic;
use App\Helpers\PushNotification;
use App\Helpers\UserHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\MusicCampaign;
use App\DjManager;
use File;
use DB;
use App\User;
use App\MusicCampaignAudio;
use Auth;
use App\AcceptedCampaign;
use App\IdentifiedMusic;
use Carbon\Carbon;
use App\Dj;
use App\City;
use App\MusicType;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Mail;

use PayPal\Rest\ApiContext;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Payout;
use PayPal\Api\PayoutSenderBatchHeader;
use PayPal\Api\PayoutItem;
use PayPal\Api\Currency;
use Session;
use App\Deposit;
use App\Advertisement;
use App\Helpers\notification_app;
use Tymon\JWTAuth\Facades\JWTAuth;

class MusicCampaignController extends Controller
{

    private $_api_context;

    public function __construct()
    {
        // setup PayPal api context
        $paypal_conf = config('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if (Session::has('new_campaign_id')) {
            $campaignId = Session::get('new_campaign_id');
            $musicCampaign = MusicCampaign::find($campaignId);
        } else {
            $musicCampaign = MusicCampaign::where('user_id', Auth::Id())
                //->orderBy('campaign_balance','desc')
                ->join('music_campaign_audios','campaign_id','music_campaigns.id')
                ->select('music_campaigns.*')
                ->orderBy('id','desc')
                ->first();


            if($musicCampaign != null)
                Session::put('new_campaign_id', $musicCampaign->id);

        }

        if (isset($musicCampaign->id)) {
            $mca = MusicCampaignAudio::where('campaign_id', $musicCampaign->id);
        }

        if (!isset($mca) || $mca->count() == 0) {
            return redirect()->route('campaignaudio');
        } else {
            //Advertisement
            $date = date('Y-m-d');

            $getAds = Advertisement::where('start_date','<=',$date)
                ->where('end_date','>=',$date)
                ->where('status', Advertisement::STATUS_APPROVE)
                ->first();

            $instrumental = AdditionalCampaignMusic::where('campaign_id', '=', $musicCampaign->id)->where('music_type', '=', 'instrumental')->first();
            $radio = AdditionalCampaignMusic::where('campaign_id', '=', $musicCampaign->id)->where('music_type', '=', 'radioversion')->first();
            $acappella = AdditionalCampaignMusic::where('campaign_id', '=', $musicCampaign->id)->where('music_type', '=', 'acappella')->first();

            $musicCampaignAudio = $mca->first();

            $currentCampaignGenre = [];
            if($musicCampaignAudio->genre != NULL && strtolower($musicCampaignAudio->genre) != 'null') {
                $currentCampaignGenre = DB::table('music_types')
                    ->whereIn('id',json_decode($musicCampaignAudio->genre))
                    ->get();
            }
            $musicCampaignAudio->genre = "";
            if(count($currentCampaignGenre) > 0){
                foreach($currentCampaignGenre as $singleGenere){
                    if($musicCampaignAudio->genre==""){
                        $musicCampaignAudio->genre = $singleGenere->name;    
                    }else{
                        $musicCampaignAudio->genre .=', '. $singleGenere->name;    
                    }
                }
            }

            //return ;
            $manager = \App\DjManager::orderBy('company_name')->get();
            //$isspecial = in_array(13, json_decode($musicCampaignAudio->genre)) || in_array(6, json_decode($musicCampaignAudio->genre));

            $campaignLists = MusicCampaign::where('user_id', Auth::id())->get();
            $totalSpent = \App\Deposit::where('campaign_uid',Auth::id())->sum("amount");
            return view('campaign.index', compact('musicCampaign', 'musicCampaignAudio',
                'manager', 'instrumental', 'radio', 'acappella','getAds', 'campaignLists','totalSpent'));
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //$value = $request->session()->all();
        //return view('campaign.create');

        // get package query parameter
        $package = $request->get('package');

        // music campaign packages
        $packages = ['standard', 'starter', 'career_boost'];

        // redirect to homepage if package is not selected
//        if (!in_array($package, $packages))
//            return redirect('https://spinstatz.com/');

        // save the package seleted in session for retrieval on dashboard page
        session(['new_campaign_package' => $package]);

        $referid = $request->refer;

        /* Create 1 blade call */
        return view('campaign.create1',compact('referid', 'package'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //
        //return dd($request->hasFile('audio'));
        $this->validate(request(), [
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email|confirmed|unique:users,email',
            'campaignname' => 'required',
            'city' => 'required',
//            'username' => 'required',
            'password' => 'required',
            'street' => 'required',
            'zipcode' => 'required',
            'phone' => 'required',
        ]);

        $userCampaign = $request->all();

        $cc = str_random(30);
        $reciptant = $userCampaign['email'];
        $id = User::create([
            // 'username' => $userCampaign['email'],
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


        Mail::send('email.verification', ['link' => '/register/verify/' . $cc,
            'username' => $request->email
        ], function ($message) use ($reciptant) {
            $message->to($reciptant, '')->subject('Confirm Campaign Registration- SpinStatz.net');
        });


        Auth::logout();
        // $request->session()->put('musiccampaign_id', $musicCampaign->id);
        return redirect()->route('login')->with('message', "Campaign Successfully created! Please check your email to verify");


    }

    public function test_for_email()
    {

        $cc = str_random(30);
        $reciptant = "thumarravi77@gmail.com";
        Mail::send('email.test', ['link' => '/register/verify/' . $cc,
            'username' => "thumarravi77@gmail.com"
        ], function ($message) use ($reciptant) {
            $message->to($reciptant, '')->subject('Confirm Campaign Registration- SpinStatz.net');
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\musicCampaign $musicCampaign
     * @return \Illuminate\Http\Response
     */
    public function show(MusicCampaign $musicCampaign)
    {
        //

        $dj = auth()->user()->dj()->first();
        $musicCampaignAudio = MusicCampaignAudio::where('campaign_id', $musicCampaign->id)->first();
        $hasJoined = AcceptedCampaign::where('campaign_id', $musicCampaign->id)
                ->where('dj_id', $dj->id)
                ->count() > 0;
        $isEligible = $musicCampaign->isEligible($dj->id);
        if (!$hasJoined) {
            $canleave = False;
        } else {

            $canleave = IdentifiedMusic::where('music_id', $musicCampaignAudio->id)
                    ->where('dj_id', auth()->id())->count() >= 2 || $musicCampaign->campaign_balance < $musicCampaign->spin_rate || $musicCampaign->campaign_balance == 0;

        }
        $reaction=null;

        if($musicCampaignAudio!=null) {
            $reaction = \App\Reaction::where('dj_id', $dj->id)
                ->where('campaign_id', $musicCampaignAudio->id)
                ->first();
        }
        if ($reaction != null) {
            $reaction = $reaction->reaction;
        } else {
            $reaction = -1;
        }
        $instrumental = AdditionalCampaignMusic::where('campaign_id', '=', $musicCampaign->id)->where('music_type', '=', 'instrumental')->first();
        $radio = AdditionalCampaignMusic::where('campaign_id', '=', $musicCampaign->id)->where('music_type', '=', 'radioversion')->first();
        $acappella = AdditionalCampaignMusic::where('campaign_id', '=', $musicCampaign->id)->where('music_type', '=', 'acappella')->first();


        return view('campaign.show', compact('musicCampaign', 'musicCampaignAudio', 'hasJoined', 'dj', 'isEligible', 'canleave', 'reaction', 'instrumental', 'radio', 'acappella'));
    }


    public function view(MusicCampaign $musicCampaign)
    {
        //
        $musicCampaignAudio = MusicCampaignAudio::where('campaign_id', $musicCampaign->id)->first();

        $instrumental = AdditionalCampaignMusic::where('campaign_id', '=', $musicCampaign->id)->where('music_type', '=', 'instrumental')->first();
        $radio = AdditionalCampaignMusic::where('campaign_id', '=', $musicCampaign->id)->where('music_type', '=', 'radioversion')->first();
        $acappella = AdditionalCampaignMusic::where('campaign_id', '=', $musicCampaign->id)->where('music_type', '=', 'acappella')->first();


        return view('campaign.view', compact('musicCampaign', 'musicCampaignAudio', 'instrumental', 'radio', 'acappella'));
    }

    public function getDownload()
    {
        //PDF file is stored under project/public/download/info.pdf
        $file = public_path() . "/musicfile/Sleep Away.mp3";

        $headers = [
            'Content-Type: application/mp3',
        ];

        return Response::download($file, 'filename.pdf', $headers);
    }

    public function uploadImage(Request $request)
    {
        $user = Auth::user();
        $this->validate(request(), [
            'file' => 'mimes:jpeg,jpg,png,gif|required|max:10000']);
        if ($request->hasFile('file')) {
            $file = request('file');

            $ppName = time() . $file->getClientOriginalName();
            $dir = 'campaignUserProfile';
            $message = $file->move($dir, $ppName);
            $user->profile_picture = $dir . '/' . $ppName;
            $user->save();
        }
        return redirect()->back();
    }


    public function uploadAdditionalMusic(Request $request)
    {
//        Log::info($request);

        if (Session::has('new_campaign_id')) {
            $campaignId = Session::get('new_campaign_id');
            $musicCampaign = MusicCampaign::find($campaignId);
        } else {
            $musicCampaign = MusicCampaign::where('user_id', Auth::Id())->first();
        }

        $musicType = $request->musicType;
        Log::info(request());
        $this->validate(request(), [
            'audio' => 'required|max:18000']);
        if ($request->hasFile('audio')) {
            if ($musicCampaign != null) {

                $previous = AdditionalCampaignMusic::where('campaign_id', '=', $musicCampaign->id)->where('music_type', '=', $musicType)->first();
                if ($previous != null) {
                    if(file_exists(public_path() . '/' . $previous->song_path)) {
                        try {
                            unlink(public_path() . '/' . $previous->song_path);
                            $previous->delete();
                        } catch (Exception $e) {
                            $message_text = 'error';
                        }
                    }
                }
                $additionMusicAudio = new AdditionalCampaignMusic();
                $file = request('audio');
                $ppName = time() . $file->getClientOriginalName();
                $dir = 'audio';
                $message = $file->move($dir, $ppName);
                $additionMusicAudio->song_path = $dir . '/' . $ppName;
                $additionMusicAudio->music_type = $musicType;
                $additionMusicAudio->campaign_id = $musicCampaign->id;
                $additionMusicAudio->save();
            }
        }
        //return 'success';
        if($musicType == 'acappella') {
            return AdditionalCampaignMusic::where('campaign_id', '=', $musicCampaign->id)->where('music_type', '=', 'acappella')->first();
        } 
        elseif($musicType == 'radioversion') {
            return AdditionalCampaignMusic::where('campaign_id', '=', $musicCampaign->id)->where('music_type', '=', 'radioversion')->first();
        }
        else {
            return AdditionalCampaignMusic::where('campaign_id', '=', $musicCampaign->id)->where('music_type', '=', 'instrumental')->first();
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\musicCampaign $musicCampaign
     * @return \Illuminate\Http\Response
     */
    public function edit(MusicCampaign $musicCampaign)
    {
        //
        $user = Auth::user();
        $id = Auth::Id();

        if (Session::has('new_campaign_id')) {
            $campaignId = Session::get('new_campaign_id');
            $campaign = MusicCampaign::find($campaignId);
        } else {
            $campaign = MusicCampaign::where('user_id', $id)->first();
        }

        //return $campaign;

        return view('campaign.edit', compact('campaign'));

    }

    public function editprofile(MusicCampaign $musicCampaign)
    {
        //
        $user = Auth::user();
        $id = Auth::Id();

        if (Session::has('new_campaign_id')) {
            $campaignId = Session::get('new_campaign_id');
            $campaign = MusicCampaign::find($campaignId);
        } else {
            $campaign = MusicCampaign::where('user_id', $id)->first();
        }

        $city = City::find($campaign->city);

        $state = isset($city) ? $city->state()->first() : null;
        $country = isset($state) ? $state->country()->first() : null;
        $musictypes = MusicType::all();
        $campaignaudio = $campaign->musicCampaignAudio()->first();
        //return $campaignaudio;
        return view('campaign.editprofile', compact('campaign', 'user', 'country', 'state', 'musictypes', 'campaignaudio'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\musicCampaign $musicCampaign
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $this->validate(request(), [
            'spinrate' => 'required'
        ]);
        $user = Auth::user();
        $id = Auth::Id();
        if (Session::has('new_campaign_id')) {
            $campaignId = Session::get('new_campaign_id');
            $campaign = MusicCampaign::find($campaignId);
        } else {
            $campaign = MusicCampaign::where('user_id', $id)->first();
        }

        if ($campaign->spin_rate == 0) {
            $campaign->spin_rate = $request->spinrate;
            $campaign->save();
        }
        return redirect('/campaign/dashboard');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\musicCampaign $musicCampaign
     * @return \Illuminate\Http\Response
     */
    public function destroy(MusicCampaign $musicCampaign)
    {
        //
    }

    public function getSpinTable(Request $request)
    {
        $weekCnt = $request->week;
        $id = Auth::Id();
        Carbon::setWeekStartsAt(Carbon::SUNDAY);
        Carbon::setWeekEndsAt(Carbon::SATURDAY);
        $sunday = Carbon::now()->startOfWeek()->subWeeks($weekCnt);
        $saturday = Carbon::now()->endOfWeek()->subWeeks($weekCnt);

        if (Session::has('new_campaign_id')) {
            $campaignId = Session::get('new_campaign_id');
            $campaign = MusicCampaign::find($campaignId);
        } else {
            $campaign = MusicCampaign::where('user_id', $id)->first();
        }


        $campaign_audio = MusicCampaignAudio::where('campaign_id', $campaign->id)->first();

        $djs = AcceptedCampaign::where('accepted_campaigns.campaign_id', $campaign->id)
            ->join('djs', 'djs.id', 'accepted_campaigns.dj_id')
            ->select('djs.id as dj_id', 'djs.dj_name', 'city', 'club_name', 'accepted_campaigns.downloaded', 'user_id', 'invited_by')
            ->get();
        //return $djs;

        $data =  array();
        foreach ($djs as $dj) {
            $djsSpin = IdentifiedMusic::where('music_id', $campaign_audio->id)
                ->where('dj_id', $dj->user_id)
                ->whereBetween('played_timestamp', [$sunday, $saturday]);

            if($djsSpin->count() == 0){
                continue;
            }

            $djdata['dj_id'] = $dj->dj_id;
            $djdata['dj_name'] = $dj->dj_name;
            $city = City::find($dj->city);
            $djdata['city'] = $city->name;
            $djdata['country'] = $city->state()->first()->country()->first()->name;
            if ($dj->club_name == 'deleteThisfield') {
                $club = \App\Club::where('dj_id', $dj->dj_id)->first();
                if ($club == null) {
                    $djdata['club'] = 'Club not set';
                    $djdata['capacity'] = 'N/A';
                } else {
                    $djdata['club'] = $club->name;
                    $djdata['capacity'] = $club->capacity;
                }

            } else {
                $djdata['club'] = $dj->club_name;
                $djdata['capacity'] = 'N/A';
            }

            $thisweek = IdentifiedMusic::where('music_id', $campaign_audio->id)
                ->where('dj_id', $dj->user_id)
                ->whereBetween('played_timestamp', [$sunday, $saturday])
                ->get()
                ->groupBy(function($date) {
                    return Carbon::parse($date->created_at)->format('D');
                });


            $djdata['downloaded'] = $dj->downloaded;
            $Djmanager = \App\User::find($dj->invited_by);
            if($Djmanager == null){
                $djdata['manager'] = "";
            }else {
                $DJmanager = \App\DjManager::where('user_id', $Djmanager->id)->first();
                $djdata['manager'] = $DJmanager->first_name . " " . $DJmanager->last_name;
            }

            $djdata['tws'] = $thisweek;

            $data[] = $djdata;
        }




        return view('campaign.history', compact('data','campaign_audio','sunday','saturday','weekCnt'));
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSpinTableNew(Request $request)
    {
        $weekCnt = $request->week;
        $id = Auth::Id();
        if($id==null){
            $token=JWTAuth::getToken();
            $user=JWTAuth::toUser($token);
            $id=$user->id;
        }
        Carbon::setWeekStartsAt(Carbon::SUNDAY);
        Carbon::setWeekEndsAt(Carbon::SATURDAY);
        $sunday = Carbon::now()->startOfWeek()->subWeeks($weekCnt);
        $saturday = Carbon::now()->endOfWeek()->subWeeks($weekCnt);

        if ($request->campaignId!=null) {
            $campaignId = $request->campaignId;
            $campaign = MusicCampaign::find($campaignId);
        }else {
            $campaign = MusicCampaign::where('user_id', $id)->first();
        }


        $campaign_audio = MusicCampaignAudio::where('campaign_id', $campaign->id)->first();
        if($campaign_audio==null)
        {
            return response()->json(['message'=>'no_audio',
                'status'=>400]);

        }

        $djs = AcceptedCampaign::where('accepted_campaigns.campaign_id', $campaign->id)
            ->join('djs', 'djs.id', 'accepted_campaigns.dj_id')
            ->select('djs.id as dj_id', 'djs.dj_name', 'city', 'club_name', 'accepted_campaigns.downloaded', 'user_id', 'invited_by')
            ->get();
        //return $djs;

        $data =  array();
        foreach ($djs as $dj) {
            $djsSpin = IdentifiedMusic::where('music_id', $campaign_audio->id)
                ->where('dj_id', $dj->user_id)
                ->whereBetween('played_timestamp', [$sunday, $saturday]);

            if($djsSpin->count() == 0){
                continue;
            }

            $djdata['dj_id'] = $dj->dj_id;
            $djdata['dj_name'] = $dj->dj_name;
            $city = City::find($dj->city);
            $djdata['city'] = $city->name;
            $djdata['country'] = $city->state()->first()->country()->first()->name;
            if ($dj->club_name == 'deleteThisfield') {
                $club = \App\Club::where('dj_id', $dj->dj_id)->first();
                if ($club == null) {
                    $djdata['club'] = 'Club not set';
                    $djdata['capacity'] = 'N/A';
                } else {
                    $djdata['club'] = $club->name;
                    $djdata['capacity'] = $club->capacity;
                }

            } else {
                $djdata['club'] = $dj->club_name;
                $djdata['capacity'] = 'N/A';
            }

            $thisweek = IdentifiedMusic::where('music_id', $campaign_audio->id)
                ->where('dj_id', $dj->user_id)
                ->whereBetween('played_timestamp', [$sunday, $saturday])
                ->get()
                ->groupBy(function($date) {
                    return Carbon::parse($date->created_at)->format('D');
                });


            $djdata['downloaded'] = $dj->downloaded;
            $Djmanager = User::find($dj->invited_by);
            $DJmanager = DjManager::where('user_id', $Djmanager->id)->first();
            $djdata['manager'] = $DJmanager->first_name . " " . $DJmanager->last_name;
            $djdata['tws'] = $thisweek;

            $data[] = $djdata;
        }

        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => $data,
            'campaign_audio'=> $campaign_audio,
            'sunday'=> $sunday,
            'saturday'=> $saturday,
            'weekCnt'=> $weekCnt,


        ]);


    }


    public function getSpinHistory(Request $request)
    {
        $user = Auth::user();
        //return $request->cid;

        if ($user != null && $user->role == 'campaign') {
            if (Session::has('new_campaign_id')) {
                $campaignId = Session::get('new_campaign_id');
                $campaign = MusicCampaign::find($campaignId);
            } else {
                $campaign = MusicCampaign::where('user_id', $user->id)->first();
            }

        } else {
            $campaign = MusicCampaign::find($request->cid);
        }
        $campaign_audio = MusicCampaignAudio::where('campaign_id', $campaign->id)->first();

        $startDate = Carbon::now()->startOfMonth()->subMonths(6);
        $endDate = Carbon::now();


        $identifiedMusics = IdentifiedMusic::where('music_id', $campaign_audio->id)
            ->where('played_timestamp', '>=', $startDate)
            ->where('played_timestamp', '<=', $endDate)
            ->get()
            ->groupBy(function ($val) {
                return Carbon::parse($val->played_timestamp)->format('M');
            })->map(function ($count) {
                return $count->count();
            });

        return $identifiedMusics;
    }

    public function filterTarget(Request $request)
    {
        //       return [$request->country, $request->state, $request->city, $request->coalition];
        $id = Auth::id();
        $totalSpent = \App\Deposit::where('campaign_uid',Auth::id())->sum("amount");
        if($totalSpent < 1000){
            return;
        }
        if (Session::has('new_campaign_id')) {
            $campaignId = Session::get('new_campaign_id');
            $campaign = MusicCampaign::find($campaignId);
        } else {
            $campaign = MusicCampaign::where('user_id', $id)->first();
        }


        //return $request->country;
        $campaign->target_country = sizeof($request->country) > 0 ? '[' . $request->country . ']' : '[' . 0 . ']';
        $campaign->target_state = sizeof($request->state) > 0 ? '[' . $request->state . ']' : '[' . 0 . ']';
        $campaign->target_city = sizeof($request->city) > 0 ? '[' . $request->city . ']' : '[' . 0 . ']';
        $campaign->target_colition = sizeof($request->coalition) > 0 ? '[' . $request->coalition . ']' : '[' . 0 . ']';
        $campaign->save();
        return redirect('/campaign/dashboard');
    }

    public function estimation(Request $request)
    {
        $country = $request->country;
        $state = $request->state;
        $city = $request->city;
        $coalition = $request->coalition;
        //return [$country, $state, $city, $coalition];
        $cityCount = '--';
        $stateCount = '--';
        $countryCount = '--';
        $coalitionCount = '--';
        $total = '--';

        if ($coalition != 'undefined' && $coalition != "") {
            $manager_uid = \App\DjManager::find($coalition)->user_id;
            $coalitionCount = Dj::where('invited_by', $manager_uid)->count();
            $total = $coalitionCount;
        }

        if ($country != 'undefined' && $country != "") {

            $country = DJ::join('cities', 'djs.city', 'cities.id')
                ->join('states', 'states.id', 'cities.state_id')
                ->where('states.country_id', $country)
                ->distinct('djs.id');

            $countryCount = $country->count();

            if ($coalition != 'undefined' && $coalition != "") {
                $total = $country->where('djs.invited_by', $manager_uid)->count();
                //$total = $countryCount;
            } else {
                $total = $countryCount;
            }

        }

        if ($state != 'undefined' && $state != "") {
            $state = DJ::join('cities', 'djs.city', 'cities.id')
                ->where('cities.state_id', $state)
                ->distinct('djs.id');
            $stateCount = $state->count();

            if ($coalition != 'undefined' && $coalition != "") {
                $total = $state->where('djs.invited_by', $manager_uid)->count();
                //$total = $countryCount;
            } else {
                $total = $stateCount;
            }


        }
        if ($city != 'undefined' && $city != "") {
            $city = Dj::where('city', $city);
            $cityCount = $city->count();

            if ($coalition != 'undefined' && $coalition != "") {
                //$total = $countryCount;
                $total = $city->where('djs.invited_by', $manager_uid)->count();
            } else {
                $total = $cityCount;
            }

        }

        return [$countryCount, $stateCount, $cityCount, $coalitionCount, $total];
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

        return [$countryTotal, $stateTotal, $cityTotal, $coilationTotal, $allTotal];
    }


    public function thisweek(MusicCampaign $campaign)
    {
        Carbon::setWeekStartsAt(Carbon::SUNDAY);
        Carbon::setWeekEndsAt(Carbon::SATURDAY);
        $sunday = Carbon::now()->startOfWeek();
        $saturday = Carbon::now()->endOfWeek();

        $thisweekRecords = IdentifiedMusic::whereBetween('played_timestamp', [$sunday, $saturday])->where('music_id', '=', $campaign->musicCampaignAudio()->first()->id)->count();
        return $thisweekRecords;
    }

    public function checkmail($mail)
    {
        return \App\User::where('email', $mail)->count();
        //return array( 'valid' => true );
        return array('valid' => false, 'message' => 'This username is already taken!');
    }

    public function checkusername($username)
    {
        return \App\User::where('username', $username)->count();
    }

    public function checkdjname($djname)
    {
        return \App\Dj::where('dj_name', $djname)->count();
    }

    /**
     * Function used to user campaign payment status
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function userCampaignPaymentStatus(Request $request)
    {

        // Get the payment ID before session clear
        $userCampaign = Session::get('paypal_user_campaign');
        \Log::info('User Campaign Payment: ');
        \Log::info($userCampaign);
        // clear the session payment ID
        Session::forget('paypal_user_campaign');

        if (empty($request->input('PayerID')) || empty($request->input('token'))) {
            Session::flash('alert', 'Payment failed');
            Session::flash('alertClass', 'danger no-auto-close');
            return redirect('/user/campaign/create');
        }

        $payment_id = $userCampaign['paypal_payment_id'];

        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId($request->input('PayerID'));

        //Execute the payment
        $result = $payment->execute($execution, $this->_api_context);

        \Log::info('User Campaign Payment Result: ');
        \Log::info($result);

        if ($result->getState() == 'approved') {
            //Add any logic here after payment is success
            Session::flash('alert', 'User campaign payment is complete');
            //Session::flash('alertClass', 'success');
            $data = $result->transactions[0]->amount;


            $id = User::create([
                'username' => $userCampaign['email'],
                'email' => $userCampaign['email'],
                'password' => bcrypt($userCampaign['password']),
                'role' => 'campaign',
                'blocked' => 'no',
                'confirmation_code' => 123,
                'confirmed' => 0,

            ])->id;

            $data = $result->transactions[0]->amount;
            $deposit = new Deposit();

            $musicCampaign = new MusicCampaign();

            $musicCampaign->campaign_name = $userCampaign['campaignname'];
            $musicCampaign->user_id = $id;
            $musicCampaign->first_name = $userCampaign['fname'];
            $musicCampaign->last_name = $userCampaign['lname'];
            $musicCampaign->email = $userCampaign['email'];
            $musicCampaign->company_name = $userCampaign['company_name'];
            $musicCampaign->country = $userCampaign['country'];
            $musicCampaign->state = $userCampaign['state'];
            $musicCampaign->city = $userCampaign['city'];
            $musicCampaign->street = $userCampaign['street'];
            $musicCampaign->zipcode = $userCampaign['zipcode'];
            $musicCampaign->phone = $userCampaign['phone'];
            $musicCampaign->campaign_balance += $data->total / 2;
            $musicCampaign->target_country = '[]';
            $musicCampaign->target_state = '[]';
            $musicCampaign->target_city = '[]';
            $musicCampaign->target_colition = '[]';


            $musicCampaign->save();


            $deposit->campaign_uid = $musicCampaign->id;
            $deposit->transaction_id = $payment_id;
            $deposit->currency_code = "aa";
            $deposit->payment_status = $result->payer->status;
            $deposit->amount = $data->total;
            $deposit->save();

            $request->session()->put('musiccampaign_id', $musicCampaign->id);
            return redirect()->route('login')->with('message', "Campaign Successfully created");
        }

        Session::flash('alert', 'Unexpected error occurred & payment has been failed.');
        Session::flash('alertClass', 'danger no-auto-close');
        return redirect('/user/campaign/create');

    }


    /**
     * @return \Illuminate\Database\Eloquent\Model|null|static
     */
    public function userBalance()
    {

        $musicCampaign = MusicCampaign::where('user_id', Auth::Id())->first();
        if (Session::has('new_campaign_id')) {
            $campaignId = Session::get('new_campaign_id');
            $musicCampaign = MusicCampaign::find($campaignId);
        }
        return $musicCampaign;
    }


    public function updateprofile(Request $request)
    {
        $uid = Auth::id();

        if (Session::has('new_campaign_id')) {
            $campaignId = Session::get('new_campaign_id');
            $musiccampaign = MusicCampaign::find($campaignId);
        } else {
            $musiccampaign = MusicCampaign::where('user_id', $uid)->first();
        }

        $musicCampaignAudio = $musiccampaign->musicCampaignAudio()->first();


        $musiccampaign->campaign_name = $request->campaignname;
        $musiccampaign->first_name = $request->fname;
        $musiccampaign->last_name = $request->lname;
        $musiccampaign->city = $request->city;
        $musiccampaign->street = $request->street;
        $musiccampaign->zipcode = $request->zipcode;
        $musiccampaign->phone = $request->phone;
        $musiccampaign->bio = $request->bio;

        $musicCampaignAudio->company_name = $request->company_name;
        $musicCampaignAudio->song_title = $request->song_title;
        $musicCampaignAudio->artist_website = $request->artist_website;
        $musicCampaignAudio->release_date = $request->release_date;
        $musicCampaignAudio->isrc = $request->isrc;
        $musicCampaignAudio->upc = $request->upc;
        $musicCampaignAudio->artist_name = $request->artist_name;
        $musicCampaignAudio->genre = json_encode($request->musictype, JSON_NUMERIC_CHECK);

        $musiccampaign->save();
        $musicCampaignAudio->save();

        return redirect()->route('campaign.edit')->withMessage('Successfully Updated');
    }

    public function verify($token, Request $request)
    {
        $user = User::where('confirmation_code', $token)->first();
        if ($user === null) {
            $request->session()->flash('error', 'Invalid URL!');
        } elseif ($user->role == 'campaign') {
            $user->verified();
            $request->session()->flash('message', 'Your email has been successfully verified! Please Log in.');
        } elseif ($user->role == 'advertiser'){
            $user->verified();
            $request->session()->flash('message', 'Your email has been successfully verified! Please Log in.');
        }
        return redirect('/');
    }

    public function filterAdvanced()
    {
        return view('campaign.advancedfilter');
    }

    public function filterTargetAdvanced(Request $request)
    {
        return response()->json(['message' => 'need to purchase addson'], 200);
        $id = Auth::id();
        $totalSpent = \App\Deposit::where('campaign_uid',Auth::id())->sum("amount");
        if($totalSpent < 1000){
            return;
        }

        if (Session::has('new_campaign_id')) {
            $campaignId = Session::get('new_campaign_id');
            $campaign = MusicCampaign::find($campaignId);
        } else {
            $campaign = MusicCampaign::where('user_id', $id)->first();
        }


        Log::info($request->country);

        $campaign->target_country = '[' . implode(",", json_decode($request->country)) . ']';
        $campaign->target_state = '[' . implode(",", json_decode($request->state)) . ']';
        $campaign->target_city = '[' . implode(",", json_decode($request->city)) . ']';
        $campaign->target_colition = '[' . implode(",", json_decode($request->collation)) . ']';

        /* Notification Added */
        /*
        $notification_arr=array();
        $notification=new notification_app();
        $message_array=$notification->adminReceivedMesssages;


        if($request->collation != '[0]') {
            foreach (json_decode($request->collation) as $collation) {
            $manager=DjManager::where('id', $collation)->first();

            $notification_arr=['user_id' =>Auth::id(), 'reference_id' => $manager['user_id'],
             'subject' => $message_array['campign_music_request']['subject'],'message' => $message_array['campign_music_request']['message'],
             'href'   => '','seen' => 0,
             'is_shown' => 0, 'type' => 'campaign',
             "created_at" => date('Y-m-d H:i:s'),
             "updated_at" => date('Y-m-d H:i:s'),
            ];
            $notification->onlynotification($notification_arr);
            }
        } */

        $campaign->save();
        return response()->json(['success' => 'success'], 200);
    }

    public function spinVideos(Request $request)
    {
        $user = Auth::user();
        $id = $user->id;
        if ($user->role == 'campaign') {
            $campaign = $user->musicCampaign()->first();
            $campaignaudio = $campaign->musicCampaignAudio()->first();
            $spins = \App\DesktopVideoInfo::where('songId', $campaignaudio->id)
                ->paginate(9);

            //return $spins[0]->dj();
            return view('campaign.spinvideo', compact('spins'));
        }
    }


    public function spinVideosV2(Request$request){
        $user = Auth::user();
        $id = $user->id;
        if($user->role == 'campaign'){

            if (Session::has('new_campaign_id')) {
                $campaignId = Session::get('new_campaign_id');
                $campaign = MusicCampaign::find($campaignId);
            } else {
                $campaign = MusicCampaign::where('user_id', Auth::id())->first();
            }

            //$campaign = $user->musicCampaign()->first();
            //todo: multiple campaign implementation



            $campaignaudio = $campaign->musicCampaignAudio()->first();
            $now =  Carbon::now();
            $amonth = $now->subDays(40);
            //return $amonth;
            $spins = \App\IdentifiedMusic::where('videos','!=', 'null')
                ->where('music_id',$campaignaudio->id)
                ->where('created_at','>=',$amonth)
                ->paginate(9);
            //->get();

            return view('campaign.spinvideosv2',compact('spins'));
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function newCampaignView()
    {
        $region = "global";
        $musictypes = MusicType::all();
        $newCampaignSelectedPackage = Session::get('new_campaign_package');
        return \view::make('campaign.new_campaign', compact('musictypes','newCampaignSelectedPackage', 'region'));
    }

    /**
     * Function used to store new campaign
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function newCampaignStore(Request $request)
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
        $receiver_id=DB::table('users')
            ->select('users.id')
            ->where('users.role','admin')->first();


        $notification_arr=array();
        $notification=new notification_app();
        $message_array=$notification->adminReceivedMesssages;



        unset($firstCampaign->id);
        $newCampaign = $campaign->create($firstCampaign->toArray());
        $newCampaign->target_country = '[]';
        $newCampaign->target_state = '[]';
        $newCampaign->target_city = '[]';
        $newCampaign->target_colition = '[]';
        $newCampaign->save();


        $campaignId = $newCampaign->id;
        Session::put('new_campaign_id', $campaignId);

        $uerr=User::find($receiver_id->id);
        $datas =array();
        if($uerr!=null) {
            if ($uerr->token != null) {
                $responseObj = [
                    'userId' => $uerr->id,
                    'source'=> 'campaign_created'

//                    'manager' => $manager->id
                ];

                $message=[

                  'html'=>'<li><a class="dropdown-menu-notifications-item" href="/campaign/new/create" data-id="205161"><span class="dropdown-menu-notifications-item-content"><span class="fa fa-credit-card-alt"></span> <span><p>Campaign</p><p>A new campaign jas been created</p></span></span><span class="dropdown-menu-notifications-item-ago"></span></a></li>'
                ];

                $data=['user_id' =>Auth::id(), 'reference_id' => $receiver_id->id,'subject' => $message_array['campign_added']['subject'],'message' =>$message_array['campign_added']['message'],'href'   => ''.$newCampaign->id,'seen' => 0,'is_shown' => 0, 'type' => 'campaign',"created_at" => date('Y-m-d H:i:s'),"updated_at" => date('Y-m-d H:i:s'),
                ];
                $datas[] = $data;

//                \App\Helpers\Notification::send(2,$data,$message);


            }
            \App\Notification::insert($datas);
        }
        return redirect()->route('campaignaudio')->with('message', "Campaign Successfully created");
    }


    /**
     * Function used to campaign list
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function campaignList()
    {

        $userId = Auth::id();

        $campaignLists = MusicCampaign::where('user_id', $userId)->get();

        return view('campaign.campaign_list', compact('campaignLists'));
    }


    /**
     * Function used to put campaign id in session
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function campaignUse($id)
    {
        $campaign = new MusicCampaign();

        $userId = Auth::id();

        $campaigns = $campaign->where('id', $id)->where('user_id', $userId)->first();
        if (!$campaigns) {
            Session::flash('alert', 'Campaign not found.');
            Session::flash('alertClass', 'danger no-auto-close');
            return redirect()->route('campaign.list');
        }

        Session::put('new_campaign_id', $id);

        if(request()->ajax()){
            request()->session()->flash('message', 'Campaign successfully changed.');
            return response()->json([
                'status' => true
            ]);
        }

        return redirect()->route('campaign.dashboard')->with('message', 'Campaign successfully changed.');
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function campaignEdit($id)
    {

        $campaign = new MusicCampaign();

        $userId = Auth::id();

        $campaigns = $campaign->where('id', $id)->where('user_id', $userId)->first();
        if (!$campaigns) {
            Session::flash('alert', 'Campaign not found.');
            Session::flash('alertClass', 'danger no-auto-close');
            return redirect()->route('campaign.list');
        }
        return view('campaign.campaign_edit', compact('campaigns'));
    }

    /**
     * Function used to store new campaign
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function campaignUpdate(Request $request, $id)
    {


        $this->validate(request(), [
            'campaign_name' => 'required',
        ]);
        $input = $request->all();

        $userId = Auth::id();
        $campaign = new MusicCampaign();
        $campaignById = $campaign->where('id', $id)->where('user_id', $userId)->first();

        if (!$campaignById) {

            Session::flash('alert', 'Campaign not found.');
            Session::flash('alertClass', 'danger no-auto-close');
            return redirect()->route('campaign.list');
        }

        $campaignById->campaign_name = $input['campaign_name'];
        $campaignById->save();

        return redirect()->route('campaign.list')->with('message', "Campaign successfully updated.");
    }

    public function getSpinTableAPI(Request $request)
    {
        $weekCnt = $request->week;
        $id = Auth::Id();
        if($id==null){
            $token=JWTAuth::getToken();
            $user=JWTAuth::toUser($token);
            $id=$user->id;
        }
        Carbon::setWeekStartsAt(Carbon::SUNDAY);
        Carbon::setWeekEndsAt(Carbon::SATURDAY);
        $sunday = Carbon::now()->startOfWeek()->subWeeks(0);
        $saturday = Carbon::now()->endOfWeek()->subWeeks(0);

        $lsunday = Carbon::now()->startOfWeek()->subWeeks(1);
        $lsaturday = Carbon::now()->endOfWeek()->subWeeks(1);

        if ($request->campaignId!=null) {
            $campaignId = $request->campaignId;
            $campaign = MusicCampaign::find($campaignId);
        } else {
            $campaign = MusicCampaign::where('user_id', $id)->first();
        }


        $campaign_audio = MusicCampaignAudio::where('campaign_id', $campaign->id)->first();

        if($campaign_audio==null)
        {
            return response()->json(['message'=>'no_audio',
                'status'=>400]);

        }

        $searchDJ = $request->txtSearch;
        if($searchDJ != '') {
            $djs = AcceptedCampaign::where('accepted_campaigns.campaign_id', $campaign->id)
                ->where("djs.dj_name", "like", "%" . $searchDJ . "%")
                ->join('djs', 'djs.id', 'accepted_campaigns.dj_id')
                ->select('djs.id as dj_id', 'djs.dj_name', 'city', 'club_name', 'accepted_campaigns.downloaded', 'user_id', 'invited_by')
                ->get();
        }
        else {
            $djs = AcceptedCampaign::where('accepted_campaigns.campaign_id', $campaign->id)
                ->join('djs', 'djs.id', 'accepted_campaigns.dj_id')
                ->select('djs.id as dj_id', 'djs.dj_name', 'city', 'club_name', 'accepted_campaigns.downloaded', 'user_id', 'invited_by')
                ->get();
        }
        //return $djs;
        $data = array();

        foreach ($djs as $dj) {
            $city = City::find($dj->city);
            $djObj = (new \App\Dj)->find($dj->dj_id);




            $accCampaignCount = AcceptedCampaign::where('dj_id',$djObj->id)->count();
            $completedCampaignCount = IdentifiedMusic::where('dj_id',$djObj->user_id)
                ->join('music_campaign_audios','music_campaign_audios.id','music_id')
                ->distinct('music_campaign_audios.id')->count('music_campaign_audios.id');

            $djdata['dj_id'] = $dj->dj_id;
            $djdata['dj_name'] = $dj->dj_name;
            $city = City::find($dj->city);
            $djdata['city'] = $city->name;
            $djdata['country'] = $city->state()->first()->country()->first()->name;
            if ($dj->club_name == 'deleteThisfield') {
                $club = \App\Club::where('dj_id', $dj->dj_id)->first();
                if ($club == null) {
                    $djdata['club'] = 'Club not set';
                    $djdata['capacity'] = 'N/A';
                } else {
                    $djdata['club'] = $club->name;
                    $djdata['capacity'] = $club->capacity;
                }

            } else {
                $djdata['club'] = $dj->club_name;
                $djdata['capacity'] = 'N/A';
            }



            $thisweek1 = IdentifiedMusic::where('music_id', $campaign_audio->id)
                ->where('dj_id', $dj->user_id)
                ->whereBetween('played_timestamp', [$sunday, $saturday])
                ->get();

            $lastWeek = IdentifiedMusic::where('music_id', $campaign_audio->id)
                ->where('dj_id', $dj->user_id)
                ->whereBetween('played_timestamp', [$lsunday, $lsaturday])
                ->get();
            $totalSpin = IdentifiedMusic::where('music_id', $campaign_audio->id)
                ->where('dj_id', $dj->user_id)
                ->get();
            $djdata['downloaded'] = $dj->downloaded;
            $Djmanager = \App\User::find($dj->invited_by);
            $DJmanager = \App\DjManager::where('user_id', $Djmanager->id)->first();
            $djdata['manager'] = $DJmanager->first_name . " " . $DJmanager->last_name;

            $djdata['tw'] = $thisweek1->count();
            $djdata['lw'] = $lastWeek->count();
            $djdata['total'] = $totalSpin->count() == 0 ? '' : $totalSpin->count();
            $djdata['accCampaignCount']=$accCampaignCount;
            $djdata['completedCampaignCount']=$completedCampaignCount;
            $djdata['profile_picture']=$djObj->user()->first()->profile_picture;
            if($djObj->id > 123)
            {
                if($djObj->clubs()->first()!=null) {
                    $djObj->club_name = $djObj->clubs()->first()->name;
                }
            }

            $djdata['dj_infos']=$djObj;
            $data[] = $djdata;
        }

        return $data;



    }

    public function showall(){
        $campaigns = MusicCampaign::join('music_campaign_audios','music_campaigns.id','music_campaign_audios.campaign_id')
            //->join('users','users.id','music_campaigns.user_id')
            ->select('music_campaigns.id','first_name','last_name','email','song_title','campaign_balance','phone')
            ->get();
        return view('admin.showallcampaign', compact('campaigns'));

    }

    public function resetlowBalanceModal(Request $request){
        $musicCampaign = MusicCampaign::where('user_id', Auth::Id())->first();
        Session::put('new_campaign_id', $musicCampaign->id);
        return redirect()->route('campaign.dashboard');
    }

    public function getcampaignApi(Request $request, MusicCampaign $musicCampaign){
        $musicCampaign->musicCampaignAudios =  $musicCampaign->musicCampaignAudio()->get();
        $currentUser = UserHelper::get_current_user();
        if($currentUser->role == "dj"){
            $dj = $currentUser->dj()->first();
            $dj_id = $dj->id;
            $musicCampaign->liked = Dj::find($dj_id)->hasLiked($musicCampaign);
            $musicCampaign->spin_rate = \App\Helpers\Settings::get_dj_spin_rate($dj->star, $musicCampaign->spin_rate) * 2;
        }
        return response()->json(['message'=>$musicCampaign],400);
    }

    public function getMyCampaign(){
        $token=JWTAuth::getToken();
        $user=JWTAuth::toUser($token);
        return response()->json(['message'=>MusicCampaign::where('user_id',$user->id)
            ->select('id','campaign_name','company_name')
            ->get()]);
    }

    public function songprofile($slug){
        $musicCampaign = MusicCampaign::where('slug', $slug)->first();
        if ($musicCampaign == null){
            $musicCampaign = MusicCampaign::find($slug);
        }

        if(auth()->user() && auth()->user()->role == "dj"){
            return $this->show($musicCampaign);
        }

        $musicCampaignAudio = MusicCampaignAudio::where('campaign_id', $musicCampaign->id)->first();
        $instrumental = AdditionalCampaignMusic::where('campaign_id', '=', $musicCampaign->id)->where('music_type', '=', 'instrumental')->first();
        $radio = AdditionalCampaignMusic::where('campaign_id', '=', $musicCampaign->id)->where('music_type', '=', 'radioversion')->first();
        $acappella = AdditionalCampaignMusic::where('campaign_id', '=', $musicCampaign->id)->where('music_type', '=', 'acappella')->first();

        return view('v3.campaign.profile', compact('musicCampaign', 'musicCampaignAudio', 'instrumental', 'radio', 'acappella'));
    }

    public function complete_profile(Request $request){
        return view('v3.layouts.campaigncomplete');
    }

    public function updateartwork(Request $request, MusicCampaign $campaign){
        $user = UserHelper::get_current_user();
        $mca = $campaign->musicCampaignAudio()->first();
        if($campaign->user_id != $user->id){
            return response()->json(['message'=>'Permision Denied'],403);
        }

        if ($request->hasFile('image')) {
            $file = request('image');
            $imageName = time() . $file->getClientOriginalName();
            $dir = 'artwork';
            try{
                $message = $file->move($dir, $imageName);
            }catch (\Exception $exception){
                return response()->json(['message'=>'upload error'],406);
            }
            $imagePath = $dir . '/' . $imageName;
            Log::error($message);

            $mca->artwork = $imagePath;
            $mca->save();

            return response()->json(['message'=>'success', 'image'=>env('APP_URL').$imagePath]);
        }

        return response()->json(['message'=>'file not passed'],406);
    }

    public function updateaudio(Request $request, MusicCampaign $campaign){
        $user = UserHelper::get_current_user();
        $mca = $campaign->musicCampaignAudio()->first();
        if($campaign->user_id != $user->id){
            return response()->json(['message'=>'Permision Denied'],403);
        }

        if($mca->audio != null){
            return response()->json(['message'=>'Audio already uploaded'],403);
        }

        if ($request->hasFile('audio')) {
            $file = request('audio');
            $fileExt = $file->getClientOriginalExtension();

            if (!in_array($fileExt, ["mp3","MP3"])) {
                return response()->json(['message'=>'The audio must be a file of type: mp3, MP3.'], 403);
            }


            $audioName = time() . str_replace(" ","", $request->song_title);
            $audio_path = 'spin'.$audioName.'.'.$fileExt;
            try {
                $message = $file->move('audio', $audio_path);
            }catch (\Exception $exception){
                return response()->json(['message'=>'upload error'],406);
            }


            $mca->audio = $audio_path;
            $mca->save();
            return response()->json(['message'=>'success', 'image'=>env('APP_URL').'audio/'.$audio_path]);
        }

        return response()->json(['message'=>'file not passed'],406);
    }

    public function campaignstorev1(Request $request){
        $validator = Validator::make($request->all(), [
            'campaign_name'=>'required',
            'song_title'=>'required',
            'release_date'=>'required',
            'artist_website'=>'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }


        $user = UserHelper::get_current_user();
        $campaign = $user->get_unset_campaign();
        $campaign->campaign_name = $request->campaign_name;
        $campaign->save();

        $audio = new MusicCampaignAudio();
        $audio->campaign_id = $campaign->id;
        $audio->artist_website = $request->artist_website;
        $audio->artist_name = $request->artist_name;
        $audio->song_title =$request->song_title;
        $audio->release_date = $request->release_date;
        $audio->isrc = $request->isrc;
        $audio->upc = $request->upc;
        $audio->save();

        return response()->json([
            'message'=>'success',
            'campaign'=> $campaign],200
        );
    }

    public function update_profile(Request $request){
        $validator = Validator::make($request->all(), [
            'company_name'=>'required',
            'city'=>'required',
            'address'=>'required',
            'zipcode'=>'required',
        ]);

        if ($validator->fails()) {
            if(request()->segment(1) == "api"){
                return response()->json($validator->errors(), 400);
            }else{
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        $user = UserHelper::get_current_user();
        if($user->musicCampaign != null){
           $musicCampaign = $user->musicCampaign;
        }else{
            $musicCampaign = new MusicCampaign();
        }

        \DB::beginTransaction();
        $user->instagram = $request->instagram;
        $user->twitter = $request->twitter;
        $user->facebook = $request->facebook;
        $user->save();

        $musicCampaign->user_id = $user->id;
        $musicCampaign->city = $request->city;
        $musicCampaign->street = $request->address;
        $musicCampaign->zipcode = $request->zipcode;
        $musicCampaign->save();
        \DB::commit();

        return response()->json([
            'message'=>'success',
            'campaign'=> $musicCampaign->makeHidden(['djmanager','accepted','user_id'])->toArray()
        ]);
    }
}

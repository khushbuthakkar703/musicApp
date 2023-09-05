<?php

namespace App\Http\Controllers;

use App\Advertiser;
use Illuminate\Http\Request;
use App\User;
use Mail;
use Auth;
use App\MusicCampaign;
use App\Deposit;
use App\City;
use App\State;


class AdvertiserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $advertisers =  Advertiser::get();
        return view('admin.advertiser.index', compact('advertisers'));
    }

    public function home(){
        $invitees = MusicCampaign::where('referid',Auth::Id())->join('cities', 'cities.id', 'city')
                    ->leftJoin('deposits','deposits.campaign_uid','music_campaigns.user_id')
                    ->groupBy('deposits.campaign_uid')
                    ->get();

        $datas= array();
        $advertiser = Advertiser::where('user_id',Auth::id())->first();
        foreach($invitees as $invitee){
            $temp['invitee'] = $invitee;
            $temp['transactions'] = Deposit::where('campaign_uid', $invitee->user_id)->get();
            $datas[] = $temp;

        }

        //return $datas;
        return view('advertiser.home',compact('datas','advertiser','invitees'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $user = new User();
        $advertiser  = new Advertiser();
        $advertiser->name = $request->name;

        $user->email = $request->email;
        $user->username = $request->username;
        $user->role = "advertiser";

        $cc = mt_rand(10000000, 99999999);
        $user->password = bcrypt($cc);
        $user->confirmation_code = $cc;
        $user->blocked = "no";
        $user->save();
        $advertiser->user_id = $user->id;
        $advertiser->save();

        Mail::send('email.verification_advertiser', ['link' => '/register/verify/' . $cc,
            'username' => $request->username, 'cc' => $cc
        ], function ($message) use ($user) {
            $message->to($user->email, 'Advertiser')->subject('Confirm Advertiser Registration- SpinStatz.net');
        });

        return redirect()->route('advertisers')->with('message','Advertiser Account Created');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Advertiser  $advertiser
     * @return \Illuminate\Http\Response
     */
    public function show(Advertiser $advertiser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Advertiser  $advertiser
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
        $user = Auth::user();
        $advertiser = Advertiser::where('user_id', $user->id)->first();
        $city = City::find($advertiser->city_id);

        if($city != null){
            $state = $city->state()->first();
            $country = $state->country()->first();
        }else{
            $state = new State();
            $country = $state;
            $city = $country;
        }

        //return $country;

        return view('advertiser.editprofile',compact('user','advertiser','city','state','country'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Advertiser  $advertiser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $advertiser = Advertiser::find($request->id);
        if($advertiser->invited_by != Auth::id() && Auth::user()->role != "admin"){
            return redirect()->back()->withMessage("Permission Denied");
        }

        $message = "Rate for ". $advertiser->name . " updated from ". $advertiser->reward_percentage." to " . $request->reward_percentage;
        $advertiser->reward_percentage = $request->reward_percentage;
        $advertiser->save();
        return redirect()->back()->withMessage($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Advertiser  $advertiser
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advertiser $advertiser)
    {
        //
    }

    public function updateProfile(Request $request){
        $this->validate(request(), [

            'name'=>'required',
            'city'=>'required',

        ]);

        $advertiser = Advertiser::where('user_id',Auth::id())->first();
        $advertiser->name = $request->name;

        //$dj->phone_number = $request->phone;
        //$dj->software = $request->software;
        //$dj->address = $request->address;
        $advertiser->city_id = $request->city;
        //$dj->zipcode = $request->zipcode;
        $advertiser->paypal_email = $request->paypal_email;



        $advertiser->save();

        if($request->password != null){
            $this->validate(request(), [
                'password' => 'required|min:8',
            ]);

            $user = Auth::user();
            $user->password = bcrypt($request->password);
            $user->save();
        }
        return redirect()->route('advertiser')->with('message', "Successfully Updated");
    }

    public function employees(){
        $me = Advertiser::where('user_id', Auth::id())->first();
        if($me->invited_by == null){
            $employees = Advertiser::where('invited_by',Auth::id())->get();
            //return $employees;
            return view('advertiser.employees',compact('employees'));
        }
    }

    public function createemployee(Request $request){
        $user = new User();
        $employee  = new Advertiser();
        $employee->name = $request->name;
        $employee->invited_by = Auth::id();

        $user->email = $request->email;
        $user->username = $request->username;
        $user->role = "advertiser";

        $cc = mt_rand(10000000, 99999999);
        $user->password = bcrypt($cc);
        $user->confirmation_code = $cc;
        $user->save();
        $employee->user_id = $user->id;
        $employee->save();

//        Mail::send('email.verification_advertiser', ['link' => '/register/verify/' . $cc,
//            'username' => $request->username, 'cc' => $cc
//        ], function ($message) use ($user) {
//            $message->to($user->email, '')->subject('Confirm Advertiser Registration- SpinStatz.net');
//        });

        return redirect()->route('employees')->with('message','Employee\'s Account Created');
    }

    public function view(Request $request, Advertiser $advertiser){
        $invitedCampaigns = MusicCampaign::where('referid',$advertiser->user_id)
                            ->leftJoin('deposits','deposits.campaign_uid','music_campaigns.user_id')
                            ->groupBy('deposits.campaign_uid')
                            ->get();

        return view('advertiser.profile', compact('advertiser','invitedCampaigns'));

    }

    public function viewEmployee(Request $request, Advertiser $advertiser){
        $invitedCampaigns = MusicCampaign::where('referid',$advertiser->user_id)
                                ->leftJoin('deposits','deposits.campaign_uid','music_campaigns.user_id')
                                ->groupBy('deposits.campaign_uid')
                                ->get();
        //return $invitedCampaigns;

        return view('advertiser.employeeProfile', compact('advertiser','invitedCampaigns'));
    }

    public function disableEmployee(Request $request, Advertiser $advertiser){

        if($advertiser->invited_by == Auth::id() || auth()->user()->role == 'admin') {

            $user = $advertiser->user;
            $user->blocked = "yes";
            $user->save();

            return redirect()->back()->with('message', $advertiser->name . ' blocked');
        }else{
            return redirect()->back()->with('error', auth()->user()->role);
        }
    }

    public function enableEmployee(Request $request, Advertiser $advertiser){
        if($advertiser->invited_by == Auth::id() || auth()->user()->role == 'admin') {
            $user = $advertiser->user;
            $user->blocked = "no";
            $user->save();

            return redirect()->back()->with('message',$advertiser->name. ' unblocked');
        }else{
            return redirect()->back()->with('error', auth()->user()->role);
        }
    }
}

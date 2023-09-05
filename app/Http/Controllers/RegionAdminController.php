<?php

namespace App\Http\Controllers;

use App\Deposit;
use App\RegionAdmin;
use Illuminate\Http\Request;
use Session;

class RegionAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(\App\User $region)
    {

        $countries = Session::get('region-country');
        return view('v2.regionadmin.index');


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = $request->name;
        $password = bcrypt($request->password);
        $email = $request->email;
        $phone = $request->phone;
        $username = $request->username;

        $regionAdmin = new RegionAdmin();
        $regionAdmin->name = $name;

        $regionAdmin->phone = $phone;

        $user = new \App\User();
        $user->email = $email;
        $user->password = $password;
        $user->username = $username;
        $user->role = "regionadmin";
        $user->blocked = "no";
        $user->confirmed = 1;

        $user->save();
        $regionAdmin->user_id = $user->id;
        $regionAdmin->save();


        return redirect()->back()->withMessage('Region Admin added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RegionAdmin  $regionAdmin
     * @return \Illuminate\Http\Response
     */
    public function show(RegionAdmin $regionAdmin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RegionAdmin  $regionAdmin
     * @return \Illuminate\Http\Response
     */
    public function edit(RegionAdmin $regionAdmin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RegionAdmin  $regionAdmin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RegionAdmin $regionAdmin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RegionAdmin  $regionAdmin
     * @return \Illuminate\Http\Response
     */
    public function destroy(RegionAdmin $regionAdmin)
    {
        //
    }

    public function seePayments(){
        $countries = Session::get('region-country');

        $deposits = Deposit::join('users','users.id','deposits.campaign_uid')
                    ->join('music_campaigns','users.id','music_campaigns.user_id')
                    ->join('cities','music_campaigns.city','cities.id')
                    ->join('states','cities.state_id','states.id')
                    ->whereIn('states.country_id',$countries)
                    //->join('countries','states.country_id','countries.id')
                    ->select('deposits.*')
                    ->get();

        return view('payment.campaign',compact('deposits'));
    }

    public function actions(Request $request){
        $countries = Session::get('region-country');
        $djs = \App\Dj::join('cities','djs.city','cities.id')
            ->join('states','cities.state_id','states.id')
            ->whereIn('states.country_id',$countries)
            ->orderBy('dj_name','asc')->get();
        $managers = \App\DjManager::join('cities','dj_managers.city','cities.id')
            ->join('states','cities.state_id','states.id')
            ->whereIn('states.country_id',$countries)
            ->get();
        $genres = \App\MusicType::all();
        return view('admin.actions',compact('djs','managers','genres'));

    }
}

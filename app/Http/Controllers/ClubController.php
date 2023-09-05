<?php

namespace App\Http\Controllers;

use App\Club;
use App\Dj;
use App\Helpers\UserHelper;
use Illuminate\Http\Request;

class ClubController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $clubs = Club::all();

        return view('club.index',compact('clubs'));

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Club  $club
     * @return \Illuminate\Http\Response
     */
    public function show(Club $club)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Club  $club
     * @return \Illuminate\Http\Response
     */
    public function edit(Club $club)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Club  $club
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Club $club)
    {
        $user = UserHelper::get_current_user();
        $dj = Dj::where('user_id', $user->id)->first();
        $club->name = $request->clubname;
        $club->dj_id = $dj->id;
        $club->prime_time = $request->prime_time;
        $club->address = $request->address;
        $club->city = $request->city;
        $club->capacity = $request->capacity;
        $club->contact = $request->contact;
        $club->phone_no = $request->phone_no;
        $club->save();
        return response()->json(["status"=>"success"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Club  $club
     * @return \Illuminate\Http\Response
     */
    public function destroy(Club $club)
    {
        //
        $user = UserHelper::get_current_user();
        $dj = Dj::where('user_id', $user->id)->first();

        if($club->dj_id == $dj->id){
            $club->delete();
            return response()->json(["status"=>"success"]);
        }
        return response()->json(["status"=>"failed"]);
    }
}

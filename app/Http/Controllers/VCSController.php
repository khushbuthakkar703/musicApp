<?php

namespace App\Http\Controllers;

use App\VCS;
use Illuminate\Http\Request;

class VCSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\VCS  $vCS
     * @return \Illuminate\Http\Response
     */
    public function show(VCS $vCS)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\VCS  $vCS
     * @return \Illuminate\Http\Response
     */
    public function edit(VCS $vCS)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\VCS  $vCS
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VCS $vCS)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\VCS  $vCS
     * @return \Illuminate\Http\Response
     */
    public function destroy(VCS $vCS)
    {
        //
    }

    public function forceupdate(Request $request){
        \Illuminate\Support\Facades\Log::error($request->all());
        if($request->platform == null){
            return response()->json(["force_update"=>true]);
        }
        $should_update = VCS::should_update($request->app_type, $request->current_version, $request->platform);
        return response()->json(["force_update"=>$should_update]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Dj;
use App\IdentifiedMusicAll;
use App\MusicCampaignAudio;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IdentifiedMusicAllController extends Controller
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
     * @param  \App\IdentifiedMusicAll  $identifiedMusicAll
     * @return \Illuminate\Http\Response
     */
    public function show(IdentifiedMusicAll $identifiedMusicAll)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\IdentifiedMusicAll  $identifiedMusicAll
     * @return \Illuminate\Http\Response
     */
    public function edit(IdentifiedMusicAll $identifiedMusicAll)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\IdentifiedMusicAll  $identifiedMusicAll
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IdentifiedMusicAll $identifiedMusicAll)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\IdentifiedMusicAll  $identifiedMusicAll
     * @return \Illuminate\Http\Response
     */
    public function destroy(IdentifiedMusicAll $identifiedMusicAll)
    {
        //
    }

    public function matchRecords()
    {
//        $datas = new Collection();

        $jsonrecords=collect([]);
        $user =  Auth::user();
        $dateBeforeFive=Carbon::now()->subDays(5);

        if($user==null)
        {
            return redirect('/');
        }

        if($user->role=="admin")
        {

                $records=IdentifiedMusicAll::where('played_timestamp', '>',$dateBeforeFive)->orderBy('id','DESC')->get();

                foreach ($records as $record)
                {
                    if($record->music_id != 0){
                        $music=MusicCampaignAudio::find($record->music_id);
                    }else{
                        $music = "Not recognized";
                    }

                    if($record->dj_id){
                        $dj=Dj::where('user_id','=',$record->dj_id)->first();
                    }else{
                        $dj=new Dj();
                        $dj->name = "Not found";
                    }
                    $date=Carbon::createFromFormat('Y-m-d H:i:s', $record->played_timestamp);
                    $singleRec=array('playedByDj'=>$dj->dj_name,'played_time'=>$date->toDayDateTimeString(),'music'=>$music, 'message'=>$record->message,'video'=>$record->video);
                    $jsonrecords->push($singleRec);


           }
            }
        return view('admin.viewMatches',compact('jsonrecords'));
    }
}

<?php

namespace App\Http\Controllers;

use App\ManualMusicIdentification;
use App\MusicCampaignAudio;
use Illuminate\Http\Request;
use DB;

class ManualMusicIdentificationController extends ApiAuthController
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
     * @param  \App\ManualMusicIdentification  $manualMusicIdentification
     * @return \Illuminate\Http\Response
     */
    public function show(ManualMusicIdentification $manualMusicIdentification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ManualMusicIdentification  $manualMusicIdentification
     * @return \Illuminate\Http\Response
     */
    public function edit(ManualMusicIdentification $manualMusicIdentification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ManualMusicIdentification  $manualMusicIdentification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ManualMusicIdentification $manualMusicIdentification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ManualMusicIdentification  $manualMusicIdentification
     * @return \Illuminate\Http\Response
     */
    public function destroy(ManualMusicIdentification $manualMusicIdentification)
    {
        //
    }

    public function getMusicForManualIdentification(Request $request) {
        //$dj_user_id = $request->userId;
        $dj_name = $request->djName;
        $date_after = $request->dateAfter;
        $date_before = $request->dateBefore;

        $dj_user_id = null;

         if($dj_name != null && $dj_name != ""){
            $dj = \App\Dj::where("dj_name",$dj_name)->first();

            if($dj != null){
                $dj_user_id = $dj->user_id;
            }else {
                $dj_user_id = -1;
            }
        }

        if($request->djId != null){
            $dj_user_id = (int)$request->djId;
        }

        //return view('manualidentification.index',compact('spin','musics'));
        if(auth()->user()->role != "keyer" ){
            $djs = array();
            $dj_user_id = -1;
        }else{
            $djs = \App\KafkaMessage::getDjs();
            //$dj_user_id = -1;
        }

        $spin = \App\KafkaMessage::getUnmatched($dj_user_id, $date_after, $date_before);
        if($request->ajax()){
            return $spin;
        }

        $musics = \App\MusicCampaignAudio::select('music_campaign_audios.id','song_title')->get();
        return view('v2.keyer.index',compact('spin','musics','djs'));
    }

    public function updatematch(Request $request){
        $message_id = $request->messageId;
        $song_id = $request->songId;
        $keyer_id = \Auth::id();

        //return [$message_id, $song_id, $keyer_id];


        if($message_id != null && $song_id != null && $keyer_id != null){
            $KafkaMessage = \App\KafkaMessage::find($message_id);
            $MusicCampaignAudio = \App\MusicCampaignAudio::find($song_id);
            $user = \App\User::find($keyer_id);

            if($KafkaMessage != null && $MusicCampaignAudio != null && $user != null){
                if($user->role == "admin" || $user->role == "keyer") {
                    $payload = json_decode($KafkaMessage->message)->payload;

                    $response = $this->responseMatch(
                        $song_id,
                        $payload->user_id,
                        $payload->video_link,
                        $payload->video_link,
                        $payload->played_timestamp,
                        $payload->club_id,
                        $payload->timezone_offset,
                        $payload->latitude,
                        $payload->longitude
                    );
                    $response = $this->strHeaders2Hash($response);
                    $query = 'update kafka_messages SET message = JSON_SET(message, "$.match", ' . $song_id . ') WHERE id = ' . $message_id;
                    DB::update($query);
                }else{
                    if($user->role == "dj"){
                        $payload = json_decode($KafkaMessage->message)->payload;
                        if($keyer_id != $payload->user_id){
                            return;
                        }
                    }
                    $query = 'update kafka_messages SET message = JSON_SET(message, "$.match", ' . $song_id . '), message = JSON_SET(message, "$.pending_verification",true) WHERE id = ' . $message_id;
                    DB::update($query);
                    $response = "Match Pending for review";
                }
                return redirect()->back()->withMessage($response);
            }else if($song_id == 0){
                $query = 'update kafka_messages SET message = JSON_SET(message, "$.match", '.$song_id.') WHERE id = '. $message_id;

                DB::update($query);
                return redirect()->back()->withMessage("Music not in our system");
            }

            return "valid";

        }else{
            return "invalid";
        }
    }

    function strHeaders2Hash($r) {
        $re = '/{.*}/m';
        preg_match_all($re, $r, $matches, PREG_SET_ORDER, 0);
        return $matches[0][0];
    }

    function agreeKeying(){
        $user = auth()->user();
        $user->iskeyer = 1;
        $user->save();
        return redirect()->back()->withMessage("Keying Enabled");

    }

    function disagreeKeying(){
        $user = auth()->user();
        $user->iskeyer = 0;
        $user->save();
        return redirect()->back()->withMessage("Keying Disabled");
    }

    function review(Request $request){
        if(auth()->user()->role != "keyer"){
            return "invalid";
        }

        $message_id = $request->id;
        $result = $request->result;

        if($message_id != null && $result != null){
            $KafkaMessage = \App\KafkaMessage::find($message_id);

            if($KafkaMessage != null && $result == "yes"){

                $payload = json_decode($KafkaMessage->message)->payload;

                $response = $this->responseMatch(
                    json_decode($KafkaMessage->message, true)["match"],
                    $payload->user_id,
                    $payload->video_link,
                    $payload->video_link,
                    $payload->played_timestamp,
                    $payload->club_id,
                    $payload->timezone_offset,
                    $payload->latitude,
                    $payload->longitude
                );
                $response = $this->strHeaders2Hash($response);
                \Session::flash('message',$response);

            }else{
                \Session::flash('message',"Invalid");
            }


            $query = 'update kafka_messages SET message = JSON_SET(message, "$.pending_verification",false) WHERE id = ' . $message_id;
           DB::update($query);

        }

        $spin = \App\KafkaMessage::getMatchesToReview();
        if($spin != null){
            $message = json_decode($spin->message, true);
            $mca = MusicCampaignAudio::find($message['match']);
            return view('v2.keyer.verify',compact('spin', 'message', 'mca'));
        }

    }
}

<?php

namespace App\Http\Controllers;

use App\Reaction;
use Illuminate\Http\Request;
use App\MusicCampaignAudio;
use App\MusicCampaign;

class ReactionController extends Controller
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
        //$campaign=$request->id; 
        //$react=0;
        $campaignId=$request->id;
        $react=$request->reaction;
        $dj = auth()->user()->dj()->first();
        //$musicCampaign = $campaign->musicCampaign()->first();
         $musicCampaign = MusicCampaign::where('id',$campaignId)->first();


        $reaction = Reaction::where('dj_id',$dj->id)
                            ->where('campaign_id',$campaignId)
                            ->first();



        if($reaction == null){
            $reaction = new Reaction();
            $reaction->dj_id = $dj->id;
            $reaction->campaign_id = $campaignId;
            $reaction->reaction = $react;
            if($react == 0){
                $musicCampaign->dislikes+=1;
            }else{
                $musicCampaign->likes+=1;
            }
        }else if($reaction->reaction != $react){

            if($react == 0){
                $musicCampaign->dislikes+=1;
                $musicCampaign->likes-=1;
            }else{
                $musicCampaign->likes+=1;
                $musicCampaign->dislikes-=1;
            }
            $reaction->reaction = $react;

        }
        $reaction->save();
        $musicCampaign->save();

        $arr = array();
        $arr['likes'] = $musicCampaign->likes;
        $arr['dislikes'] = $musicCampaign->dislikes;
        event(new \App\Events\CampaignReaction($campaignId, json_encode($arr)));
       
        return $musicCampaign;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reaction  $reaction
     * @return \Illuminate\Http\Response
     */
    public function show(Reaction $reaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reaction  $reaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Reaction $reaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reaction  $reaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reaction $reaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reaction  $reaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reaction $reaction)
    {
        //
    }
}

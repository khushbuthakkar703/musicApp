<?php

namespace App\Http\Controllers;


use App\AcceptedCampaign;
use App\HuddleManager;
use App\MusicCampaign;
use App\MusicCampaignAudio;
use Illuminate\Http\Request;
use Symfony\Component\Console\Output\ConsoleOutput;

class HuddleManagerController extends Controller
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
        $this->output = new ConsoleOutput();

    }

    public function index(Request $request)
    {
        $campaigns = $this->campaigns
            ->join('music_campaign_audios','music_campaign_audios.campaign_id','music_campaigns.id')
            ->orderBy('music_campaigns.updated_at', 'desc')
            ->where('music_campaign_audios.song_title','LIKE', '%'. $request->searchKeyword .'%')
            ->orwhere('music_campaign_audios.artist_name','LIKE', '%'. $request->searchKeyword .'%')
            ->paginate(15);

        if ($request->ajax()) {
            return view('huddlemanager.musics', ['campaigns' => $campaigns])->render();
        }


        return view('huddlemanager.index', compact('campaigns'));
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
     * @param  \App\HuddleManager  $huddleManager
     * @return \Illuminate\Http\Response
     */
    public function show(HuddleManager $huddleManager)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HuddleManager  $huddleManager
     * @return \Illuminate\Http\Response
     */
    public function edit(HuddleManager $huddleManager)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HuddleManager  $huddleManager
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HuddleManager $huddleManager)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HuddleManager  $huddleManager
     * @return \Illuminate\Http\Response
     */
    public function destroy(HuddleManager $huddleManager)
    {
        //
    }

    public function result(MusicCampaign $musicCampaign){
        $musicCampaignAudio = MusicCampaignAudio::where('campaign_id', $musicCampaign->id)->first();
        $acceptedCount = AcceptedCampaign::where('accepted_campaigns.campaign_id', $musicCampaign->id)
            ->join('djs', 'djs.id', 'accepted_campaigns.dj_id')
            //->select('djs.id as dj_id', 'djs.dj_name', 'city', 'club_name', 'accepted_campaigns.downloaded', 'user_id', 'invited_by')
            ->count();

        return view('huddlemanager.result2',compact('musicCampaignAudio','musicCampaign','acceptedCount'));

    }
}

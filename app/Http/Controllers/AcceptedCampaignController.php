<?php

namespace App\Http\Controllers;

use App\AcceptedCampaign;
use App\Helpers\Notification;
use App\Helpers\PushNotification;
use App\Dj_Music;
use Auth;
use App\MusicCampaign;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class AcceptedCampaignController extends Controller
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
     * @param  \App\AcceptedCampaign  $acceptedCampaign
     * @return \Illuminate\Http\Response
     */
    public function show(AcceptedCampaign $acceptedCampaign)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AcceptedCampaign  $acceptedCampaign
     * @return \Illuminate\Http\Response
     */
    public function edit(AcceptedCampaign $acceptedCampaign)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AcceptedCampaign  $acceptedCampaign
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AcceptedCampaign $acceptedCampaign)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AcceptedCampaign  $acceptedCampaign
     * @return \Illuminate\Http\Response
     */
    public function destroy(AcceptedCampaign $acceptedCampaign)
    {
        //
    }


    public function accept(MusicCampaign $campaign){
        $currentUser = auth()->user();
        $dj = $currentUser->dj->first();

        if(AcceptedCampaign::where('campaign_id',$campaign->id)->where('dj_id',$dj->id)->count()==0){
            $acceptedCampaign = new AcceptedCampaign();
            $acceptedCampaign->campaign_id = $campaign->id;
            $acceptedCampaign->dj_id = $dj->id;
            $acceptedCampaign->save();

            $acceptedCount = AcceptedCampaign::where('accepted_campaigns.campaign_id', $campaign->id)
                ->join('djs', 'djs.id', 'accepted_campaigns.dj_id')
                ->count();
          event(new \App\Events\GenericEvent("campaign-action", $campaign->id,'{"count":'.$acceptedCount.'}'));

            error_log("published");

            $campaignUser=User::find($campaign->user_id);

            if($campaignUser!=null) {
                if ($campaignUser->token != null) {
                    $responseObj = [
                        'userId' => $campaignUser->id,
                        'dj' => $dj->id,
                        'source'=> 'dj_joined_campaign'
                        ];

                    $message=[

                        'html'=>'<li><a class="dropdown-menu-notifications-item" href="/dj/campaign/accept" data-id="205161"><span class="dropdown-menu-notifications-item-content"><span class="fa fa-credit-card-alt"></span> <span><p>Campaign</p><p>Dj Has Left Your Campaign</p></span></span><span class="dropdown-menu-notifications-item-ago"></span></a></li>'
                    ];

                    $data=['user_id' =>Auth::id(), 'reference_id' => $dj->id,'subject' =>'Campaign','message'=>'"DJ named".$dj->dj_name."has joined your campaign"','href'   => '','seen' => 0,'is_shown' => 0, 'type' => 'admin',"created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s'),
                        ];

                    \App\Helpers\Notification::send(2,$data,$message);

                }
            }

            Notification::publishMessage(
                "api",
                "campaign_accepted",
                ["push"],
                $campaign->user_id,
                "Your Campaign has been acceped",
                "",
                "/img/user-1-profile.jpg",
                array("type"=> "campaign_accepted")
            );

            return response()->json(['message'=>'Campaign Joined', 'status'=>200]);

//            return redirect()->back()->withMessage('Campaign Joined');
        }else{
            return response()->json(['message'=>'Campaign Already Joined', 'status'=>300]);
//            return redirect()->back()->withError('Campaign Already Joined');
        }

    }

    public function leave(MusicCampaign $campaign){
        $currentUser = auth()->user();
        $dj = $currentUser->dj->first();
        $musicCampaignAudio=$campaign->musicCampaignAudio()->first();

        $canleave = \App\IdentifiedMusic::where('music_id',$musicCampaignAudio->id)
                        ->where('dj_id',auth()->id())->count()>=2 || $campaign->campaign_balance < $campaign->spin_rate || $campaign->campaign_balance == 0;

        if($canleave){
            AcceptedCampaign::where('campaign_id',$campaign->id)->where('dj_id',$dj->id)->delete();
            $acceptedCount = AcceptedCampaign::where('accepted_campaigns.campaign_id', $campaign->id)
                ->join('djs', 'djs.id', 'accepted_campaigns.dj_id')
                ->count();
            event(new \App\Events\GenericEvent("campaign-action", $campaign->id,'{"count":'.$acceptedCount.'}'));


            $campaignUser=User::find($campaign->user_id);

            if($campaignUser!=null) {
                if ($campaignUser->token != null) {
                    $responseObj = [
                        'userId' => $campaignUser->id,
                        'dj' => $dj->id,
                        'source'=> 'dj_left_campaign'

                    ];

                    $message=[

                        'html'=>'<li><a class="dropdown-menu-notifications-item" href="/dj/campaign/leave" data-id="205161"><span class="dropdown-menu-notifications-item-content"><span class="fa fa-credit-card-alt"></span> <span><p>Campaign</p><p>Dj Has Left Your Campaign</p></span></span><span class="dropdown-menu-notifications-item-ago"></span></a></li>'
                    ];

                    $data=['user_id' =>Auth::id(), 'reference_id' => $dj->id,'subject' =>'Campaign','message'=>'"DJ named".$dj->dj_name."has left your campaign"','href'   => '','seen' => 0,'is_shown' => 0, 'type' => 'admin',"created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s'),
                        ];

                    \App\Helpers\Notification::send(2,$data,$message);

                }
            }

            return response()->json(['message'=>'Campaign Leaved', 'status'=>200]);
//            return redirect()->back()->withMessage('Campaign Leaved');
        }

        return response()->json(['message' =>'Must spin atleat twice before leaving', 'status'=>300]);
//        return redirect()->back()->withError('Must spin atleat twice before leaving');

    }

    public function accepted(){
        $currentUser = auth()->user();
        $dj = $currentUser->dj->first();

        $id = Auth::Id();

        $genres = Dj_Music::where('dj_id', $id)
        ->join('music_types', 'music_types.id', 'music_type')
        ->select('music_type', 'music_types.name')
        ->get();


        $orderByKey = 'music_campaigns.created_at';
        $orderByValue = 'DESC';
        if(isset($_REQUEST['filterBy'])){
            if($_REQUEST['filterBy']=='likes'){
                $orderByKey = 'music_campaigns.likes';
                $orderByValue = 'DESC';
            }
            if($_REQUEST['filterBy']=='mostPlayed'){
                $orderByKey = 'music_campaigns.total_spin';
                $orderByValue = 'DESC';
            }
            if($_REQUEST['filterBy']=='rate'){
                $orderByKey = 'music_campaigns.spin_rate';
                $orderByValue = 'DESC';
            }
            if($_REQUEST['filterBy']=='bpm'){
                $orderByKey = 'music_campaigns.bpm';
                $orderByValue = 'DESC';
            }
        }

        $searchKeyword = 'music_campaign_audios.song_title';
        $opr = '!=';
        $searchValue = '';
        if(isset($_REQUEST['searchBy']) && $_REQUEST['searchBy']!=""){
            $searchKeyword = 'music_campaigns.campaign_name';
            $opr = 'LIKE';
            $searchValue = '%' . $_REQUEST['searchBy'] . '%';
        }
        // ->where('music_campaign_audios.song_title', 'LIKE', '%' . $request->searchKeyword . '%')

        if(isset($_REQUEST['genereBy'])){
            $accepted =  AcceptedCampaign::where('dj_id',$dj->id)
                        ->where(function ($query){
                            $query->orWhereRaw('JSON_CONTAINS(music_campaign_audios.genre, \'[' . $_REQUEST['genereBy'] . ']\')');
                        })
                        ->join('music_campaigns','music_campaigns.id','campaign_id')
                        ->join('music_campaign_audios','music_campaign_audios.campaign_id','music_campaigns.id')
                        ->orderBy($orderByKey,$orderByValue)
                        ->get();
        }else{
            $accepted =  AcceptedCampaign::where('dj_id',$dj->id)
                        ->where($searchKeyword,$opr,$searchValue)
                        ->join('music_campaigns','music_campaigns.id','campaign_id')
                        ->join('music_campaign_audios','music_campaign_audios.campaign_id','music_campaigns.id')
                        ->orderBy($orderByKey,$orderByValue)
                        ->get();
        }
        return view('campaign.accepted',compact('accepted','dj','genres'));
    }
}

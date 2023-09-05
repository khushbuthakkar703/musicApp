<?php
namespace App\Http\Controllers\api;

use App\Helpers\Notification;
use App\Helpers\PushNotification;
use App\Http\Controllers\Controller;
use App\AcceptedCampaign;
use App\MusicCampaign;
use App\MusicType;
use App\User;
use Illuminate\Http\Request;
use Auth;
use App\Dj;

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
        $currentUser = Auth::user();
        $dj = $currentUser->dj->first();

        if(AcceptedCampaign::where('campaign_id',$campaign->id)->where('dj_id',$dj->id)->count()==0){
            $acceptedCampaign = new AcceptedCampaign();
            $acceptedCampaign->campaign_id = $campaign->id;
            $acceptedCampaign->dj_id = $dj->id;
            $acceptedCampaign->save();
            $data['status']=true;
            $data['accepted_campaigns'] = $dj->campaigns()->pluck('campaign_id');
            $data['message']="Campaign Joined";


            $campaignUser=User::find($campaign->user_id);

            if($campaignUser!=null) {
                if ($campaignUser->token != null) {
                    $responseObj = [
                        'userId' => $campaignUser->id,
                        'dj' => $dj->id,
                        'source'=> 'dj_joined_campaign'

                    ];

                    $message = "DJ named ".$dj->dj_name.' has joined your campaign';
//                    PushNotification::sendToAUser($campaignUser->token, $responseObj, $message);
                    Notification::publishMessage("api", "campaign_joined", ["push"], $campaignUser, $message, "", "/img/user-1-profile.jpg",$responseObj);

                }
            }

        }else{
            $data['status']=false;
            $data['accepted_campaigns'] = $dj->campaigns()->pluck('campaign_id');
            $data['message']="Campaign Already Joined";
        }

        return response()->json($data,200);

    }

    public function leave(MusicCampaign $campaign){
        $currentUser = auth()->user();
        $dj = $currentUser->dj->first();
        $musicCampaignAudio=$campaign->musicCampaignAudio()->first();

        if($musicCampaignAudio == null){
            $canleave = true;
        }else {
            $canleave = \App\IdentifiedMusic::where('music_id', $musicCampaignAudio->id)
                    ->where('dj_id', auth()->id())->count() >= 2 || $campaign->campaign_balance < $campaign->spin_rate || $campaign->campaign_balance == 0;
        }
         if($canleave){
            AcceptedCampaign::where('campaign_id',$campaign->id)->where('dj_id',$dj->id)->delete();
            $data['status']=true;
            $data['message']="Campaign Leaved";
            $data['accepted_campaigns'] = $dj->campaigns()->pluck('campaign_id');

            $campaignUser=User::find($campaign->user_id);

            if($campaignUser!=null) {
                if ($campaignUser->token != null) {
                    $responseObj = [
                        'userId' => $campaignUser->id,
                        'dj' => $dj->id,
                        'source'=> 'dj_left_campaign'
                    ];

                    $message = "DJ named ".$dj->dj_name.' has left your campaign';
                    PushNotification::sendToAUser($campaignUser->token, $responseObj, $message);
                }
            }
             return response()->json($data,200);
        }


        $data['status']=false;
        $data['message']="Must spin atleat twice before leaving";
        $data['accepted_campaigns'] = $dj->campaigns()->pluck('campaign_id');
        return response()->json($data,200);
    }

    public function accepted(){
        $currentUser = Auth::user();
        $id = Auth::Id();

        $dj = Dj::where('user_id',$id)->first();

        $accepted =  AcceptedCampaign::where('dj_id',$dj->id)
                                    ->join('music_campaigns','music_campaigns.id','campaign_id')
                                    ->join('music_campaign_audios','music_campaign_audios.campaign_id','music_campaigns.id')
                                    ->select('*','music_campaign_audios.id as audio_id')
                                    ->paginate(10);
         $i=0;
        $camp = array();
        foreach ($accepted as $value) {
                $genre_ids = json_decode($value->genre);
            $genre_names = array();
                $camp['data'][$i]=$value;
                $url=explode('/',$value->artwork);
                $camp['data'][$i]['artwork']=$url[0].'/'.$new = str_replace(' ', '%20', $url[1]);
                $camp['data'][$i]['audio']=env('APP_URL')."/audio/".str_replace(' ', '%20', $value->audio);

                for($j = 0; $j< sizeof($genre_ids); $j++){

                    $genre_names[$j] = MusicType::find($genre_ids[$j])->name;
                }
                $camp['data'][$i]['genre'] = $genre_names;

                $i++;
            }
        $data['status']=true;
        $data['campaigns']=$camp;;
        return response()->json($data,200);
    }
}

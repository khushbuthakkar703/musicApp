<?php

namespace App\Http\Controllers;

use App\ArtistManager;
use Illuminate\Http\Request;

class ArtistManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $artistmanager = \Auth::user()->artistmanager();        
        $users = $artistmanager->getMyCampaignUsers();
        //return $users;

        for($i = 0; $i<count($users); $i++) {
            $users[$i]->campaign =  \App\MusicCampaign::where('user_id',$users[$i]->id)
                                    ->join('music_campaign_audios','music_campaign_audios.campaign_id','music_campaigns.id')
                                    ->get();
            
        }

        //return $users;

        return view('v2.artistmanager.index',compact('users'));
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
        
        $name = $request->name;
        $password = bcrypt($request->password);
        $email = $request->email;
        $phone = $request->phone;
        $username = $request->username;

        $artistmanager = new ArtistManager();
        $artistmanager->name = $name;
        $artistmanager->campaign_ids = '[]';
        $artistmanager->phone_number = $phone;

        $user = new \App\User();
        $user->email = $email;
        $user->password = $password;
        $user->username = $username;
        $user->role = "artistmanager";
        $user->blocked = "no";
        $user->confirmed = 1;

        $user->save();
        $artistmanager->user_id = $user->id;
        $artistmanager->save();


        return redirect()->back()->withMessage('Artist Manager added');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ArtistManager  $artistManager
     * @return \Illuminate\Http\Response
     */
    public function show(ArtistManager $artistManager)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ArtistManager  $artistManager
     * @return \Illuminate\Http\Response
     */
    public function edit(ArtistManager $artistManager)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ArtistManager  $artistManager
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ArtistManager $artistManager)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ArtistManager  $artistManager
     * @return \Illuminate\Http\Response
     */
    public function destroy(ArtistManager $artistManager)
    {
        //
    }

    public function loginas(Request $request){
        $artistmanager = \Auth::user()->artistmanager();

        if(in_array($request->userId, json_decode($artistmanager->campaign_ids))){
            \Auth::loginUsingId($request->userId, true);

            return redirect('/');
        }

    }

    public function list(Request $request){
        $artistmanagers = ArtistManager::join('users','users.id','artist_managers.user_id')
                                        ->select('name','email','artist_managers.id','campaign_ids')
                                        ->get();
        //return $artistmanagers;
        $campaigns = \App\MusicCampaign::groupBy('user_id')
                        ->join('users','users.id','user_id')
                        ->join('music_campaign_audios','music_campaign_audios.campaign_id','music_campaigns.id')
                        ->select('artist_name','song_title','campaign_balance','users.email','users.username','users.id')

                        ->paginate(10);
        //return $campaigns;                       
        return view('v2.admin.index',compact('campaigns','artistmanagers'));
    }

    public function updateCampaignManager(Request $request) {
        $campaign =  (int) $request->campaign;
        $artistmanager = (int) $request->artistmanager;
        $this->removeFromAllManager($campaign);
        
        if($request->artistmanager == 0){
            return redirect()->back()->withMessage('Changed to none');

        }else {

            $am = ArtistManager::find($artistmanager);
            $newCampaigns = json_decode($am->campaign_ids);

            if(in_array($campaign, $newCampaigns)){
                return [$campaign, $artistmanager, $newCampaigns];
                return redirect()->back()->withMessage('No change happened 2');
            }
            $newCampaigns[] =  $campaign;
            $am->campaign_ids = json_encode($newCampaigns);
            $am->save();
            return redirect()->back()->withMessage('Changed to some from none');
        }    
        
    }

    public function removeFromAllManager($campaign){
        $ams = ArtistManager::whereRaw('JSON_CONTAINS(campaign_ids, \'['.$campaign.']\')')->get();
            foreach($ams as $am){
                if($am == null){
                    return redirect()->back()->withMessage('No change happened');   
                }
                $campaigns = json_decode($am->campaign_ids);

                //return $campaigns;
                $newCampaigns = array();
                foreach ($campaigns as $camp) {
                    if($campaign != $camp){
                        $newCampaigns[] = $camp; 
                    }
                }
                
                $am->campaign_ids = json_encode($newCampaigns);
                $am->save();
            }
        return;        
    }
}

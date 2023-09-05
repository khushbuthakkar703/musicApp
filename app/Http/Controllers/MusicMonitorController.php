<?php

namespace App\Http\Controllers;

use App\MusicMonitor;
use App\User;
use App\MusicCampaign;
use App\Dj;
use App\MusicCampaignAudio;
use App\MusicType;
use DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\IdentifiedMusic;
class MusicMonitorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Carbon::setWeekStartsAt(Carbon::SUNDAY);
        Carbon::setWeekEndsAt(Carbon::SATURDAY);
        $sunday = Carbon::now()->startOfWeek();
        $saturday = Carbon::now()->endOfWeek();


        $topSongs = MusicCampaignAudio::join('identified_musics as im','im.music_id','music_campaign_audios.id')
            ->join('music_campaigns','music_campaigns.id','music_campaign_audios.campaign_id')
            ->whereBetween('im.created_at',[$sunday, $saturday])
            ->groupBy('im.music_id')
            ->select('music_campaign_audios.*',DB::raw('count(*) as total'),'music_campaigns.total_spin')
            ->orderBy('total', 'desc')
            ->take(10)
            ->get();

        $lastWeektopSongs = MusicCampaignAudio::join('identified_musics as im','im.music_id','music_campaign_audios.id')
            ->join('music_campaigns','music_campaigns.id','music_campaign_audios.campaign_id')
            ->whereBetween('im.created_at',[Carbon::now()->startOfWeek()->subDays(7), Carbon::now()->endOfWeek()->subDays(7)])->groupBy('im.music_id')
            ->select('music_campaign_audios.id',DB::raw('count(*) as total'))
            ->orderBy('total', 'desc')
            ->get();


        for($i = 0; $i< sizeof($topSongs); $i++){
            $topSong =  $topSongs[$i];

            $topSong->lasweekRank = INF;
            $topSong->lastCount = 0;
            for($j = 0; $j < sizeof($lastWeektopSongs); $j++){
                if($topSong->id == $lastWeektopSongs[$j]->id){
                    $topSong->lasweekRank = $j+1;
                    $topSong->lastCount = $lastWeektopSongs[$j]->total;
                    break;
                }
            }

            $topSongs[$i] = $topSong;
        }

        //return $topSongs;
        $genres=MusicType::all();

        $campaign = MusicCampaign::join('music_campaign_audios','music_campaign_audios.campaign_id','music_campaigns.id')
        ->orderBy('music_campaigns.total_spin','desc')
        ->take(10)
        ->get();

        return view('monitor.index',compact('topSongs','genres','campaign'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view ('musicmonito r.create');
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
     * @param  \App\MusicMonitor  $musicMonitor
     * @return \Illuminate\Http\Response
     */
    public function show($id,$tag)
    {
        Carbon::setWeekStartsAt(Carbon::SUNDAY);
        Carbon::setWeekEndsAt(Carbon::SATURDAY);
        // echo "<pre>";
        // print_r(get_class_methods(Carbon::now()));exit;
        if($tag=0)
        {
            $sunday = Carbon::now()->startOfWeek();
            $saturday = Carbon::now()->endOfWeek();

        }
        else
        {
            $sunday=Carbon::now()->startOfWeek()->subDays(7);
            $saturday=Carbon::now()->endOfWeek()->subDays(7);

        }

        $djs=IdentifiedMusic::select('identified_musics.*','djs.dj_name','cities.name as city','states.name as state','countries.sortname as country')
                              // ->join('users','users.id','identified_musics.dj_id')
                              ->join('djs','djs.user_id','identified_musics.dj_id')
                              ->where('identified_musics.music_id',$id)
                              ->when($tag==0,function($q) use($sunday,$saturday){
                                $q->whereBetween('identified_musics.played_timestamp', [$sunday, $saturday]);
                              })
                              ->when($tag==1,function($q) use($sunday,$saturday){
                                $q->whereBetween('played_timestamp',[$start,$end]);
                              })
                              ->groupBy('identified_musics.dj_id')
                              ->leftJoin('cities','cities.id','djs.city')
                              ->leftJoin('states','states.id','cities.state_id')
                              ->leftJoin('countries','countries.id','states.country_id')
                              ->get();
        $jsonrecords = collect([]);
        foreach ($djs as $dj) {

            $row= DB::select('SELECT dj_id, 
                    if(DAYNAME(`played_timestamp`)="Sunday",DATE_FORMAT(played_timestamp, "%h:%i %p"),NULL) as Sunday,
                    if(DAYNAME(`played_timestamp`)="Monday",DATE_FORMAT(played_timestamp, "%h:%i %p"),NULL) as Monday,
                    if(DAYNAME(`played_timestamp`)="Tuesday",DATE_FORMAT(played_timestamp, "%h:%i %p"),NULL) as Tuesday,
                    if(DAYNAME(`played_timestamp`)="Wednesday",DATE_FORMAT(played_timestamp, "%h:%i %p"),NULL) as Wednesday,
                    if(DAYNAME(`played_timestamp`)="Thursday",DATE_FORMAT(played_timestamp, "%h:%i %p"),NULL) as Thursday,
                    if(DAYNAME(`played_timestamp`)="Friday",DATE_FORMAT(played_timestamp, "%h:%i %p"),NULL) as Friday,
                    if(DAYNAME(`played_timestamp`)="Saturday",DATE_FORMAT(played_timestamp, "%h:%i %p"),NULL) as Saturday
                FROM `identified_musics` where played_timestamp BETWEEN "'.$sunday.'" and "'.$saturday.'" and music_id='.$dj->music_id);
            $singleRec = array('dj'=>$dj,'time_array'=>$row);
            $jsonrecords->push($singleRec);
        }

        $sunday_date=Carbon::parse($sunday);
        $saturday_date=Carbon::parse($saturday);

        $music=MusicCampaignAudio::whereId($id)->first();
        return view('monitor.detail',compact('music','jsonrecords','sunday_date','saturday_date'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MusicMonitor  $musicMonitor
     * @return \Illuminate\Http\Response
     */
    public function edit(MusicMonitor $musicMonitor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MusicMonitor  $musicMonitor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MusicMonitor $musicMonitor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MusicMonitor  $musicMonitor
     * @return \Illuminate\Http\Response
     */
    public function destroy(MusicMonitor $musicMonitor)
    {
        //
    }

    public function
    api(Request $request){
        Carbon::setWeekStartsAt(Carbon::SUNDAY);
        Carbon::setWeekEndsAt(Carbon::SATURDAY);

        if($request->subWeek == NULL){
            $subWeek = 0;
        }else{
            $subWeek = $request->subWeek;
        }

        $sunday = Carbon::now()->startOfWeek()->subWeek($subWeek);
        $saturday = Carbon::now()->endOfWeek()->subWeek($subWeek);
        $genre = $request->genre;


        $topSongs = MusicCampaignAudio::join('identified_musics as im','im.music_id','music_campaign_audios.id')
            ->join('music_campaigns','music_campaigns.id','music_campaign_audios.campaign_id')
            ->whereBetween('im.created_at',[$sunday, $saturday])
            ->when($request->genre != NULL, function ($query) use ($request) {
                return $query->whereRaw('JSON_CONTAINS(music_campaign_audios.genre, \'['.$request->genre.']\')');
            })
            ->when($request->dj != NULL, function ($query) use ($request) {
                return $query->where('im.dj_id', $request->dj);
            })
            ->when($request->city != NULL, function ($query) use ($request) {
                return $query->join('cities','cities.id','music_campaigns.city')
                    ->where('cities.name', $request->city);
            })
            ->when($request->state != NULL, function ($query) use ($request) {
                return $query->join('cities','cities.id','music_campaigns.city')
                             ->join('states','states.id','cities.state_id')
                             ->where('states.name',$request->state);
            })
            ->when($request->country != NULL, function ($query) use ($request) {
                return $query->join('cities','cities.id','music_campaigns.city')
                            ->join('states','states.id','cities.state_id')
                            ->join('countries','countries.id','states.country_id')
                             ->where('countries.name',$request->country);
            })
            ->groupBy('im.music_id')
            ->select('music_campaign_audios.*',DB::raw('count(*) as total'),'music_campaigns.total_spin')
            ->orderBy('total', 'desc')
            ->take(10)
            ->get();

        return $topSongs;
    }

    public function showTop(Request $request)
    {
        $nthPreviousWeek = 1;
        if($request->week != null){
            $nthPreviousWeek = $request->week;
        }

       Carbon::setWeekStartsAt(Carbon::SUNDAY);
        Carbon::setWeekEndsAt(Carbon::SATURDAY);
        $sunday = Carbon::now()->startOfWeek()->subWeek($nthPreviousWeek)->tz('CST');
        $saturday = Carbon::now()->endOfWeek()->subWeek($nthPreviousWeek)->tz('CST');

      $topDjs =User::join('identified_music_alls as im','im.dj_id','users.id')
                ->select('djs.*','cities.name as city_name','users.profile_picture',DB::raw('count(im.id) as total'))
                ->whereBetween('im.played_timestamp',[$sunday, $saturday])
                ->where('djs.id','!=',121)
                ->join('djs','djs.user_id','users.id')
                ->leftJoin('cities','cities.id','djs.city')
                ->groupBy('im.dj_id')
                ->orderBy('total', 'desc')
                ->take(5)
                ->get();

      $topSongs = MusicCampaignAudio::join('identified_musics as im','im.music_id','music_campaign_audios.id')
            ->join('music_campaigns','music_campaigns.id','music_campaign_audios.campaign_id')
            ->whereBetween('im.created_at',[$sunday, $saturday])
            ->groupBy('im.music_id')
            ->select('music_campaigns.campaign_name','music_campaign_audios.*',DB::raw('count(*) as total'),'music_campaigns.total_spin')
            ->orderBy('total', 'desc')
            ->take(10)
            ->get();
           return view('top',compact('topDjs','topSongs'));
    }
}

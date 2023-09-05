<?php

namespace App\Http\Controllers;

use App\Dj;
use App\IdentifiedMusic;
use App\MusicCampaignAudio;
use App\MusicCampaign;
use Carbon\Carbon;
use App\Club;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Dj_Music;
use App\DjManager;

class IdentifiedMusicController extends Controller
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\IdentifiedMusic $identifiedMusic
     * @return \Illuminate\Http\Response
     */
    public function show(IdentifiedMusic $identifiedMusic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\IdentifiedMusic $identifiedMusic
     * @return \Illuminate\Http\Response
     */
    public function edit(IdentifiedMusic $identifiedMusic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\IdentifiedMusic $identifiedMusic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IdentifiedMusic $identifiedMusic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\IdentifiedMusic $identifiedMusic
     * @return \Illuminate\Http\Response
     */
    public function destroy(IdentifiedMusic $identifiedMusic)
    {
        //
    }

    public function matchResultDJ(Dj $djid)
    {
        Carbon::setWeekStartsAt(Carbon::SUNDAY);
        Carbon::setWeekEndsAt(Carbon::SATURDAY);
        $currentUser =  Auth::user();
        $managerUser = User::find($djid->invited_by);
        $manager = DjManager::where('user_id',$managerUser->id)->first();
        
        $sunday = Carbon::now()->startOfWeek();
        $saturday = Carbon::now()->endOfWeek();
        $jsonrecords = collect([]);
        //::distinct()->select('user_id')->where('weeknum', '=', 1)->groupBy('user_id')->get();
        $records = IdentifiedMusic::distinct()->select('music_id')->where('dj_id', '=', $djid->user_id)->groupBy('music_id')->get();
        // $records=$records->groupBy('music_id')->get();

        $totalspins = 0;
//            return sizeof($records);
        foreach ($records as $record) {
            $thisweekRecords = IdentifiedMusic::whereBetween('played_timestamp', [$sunday, $saturday])->where('dj_id', '=', $djid->user_id)->where('music_id', '=', $record->music_id)->get();
            $lastweekRecords = IdentifiedMusic::whereBetween('played_timestamp', [Carbon::now()->startOfWeek()->subDays(7), Carbon::now()->endOfWeek()->subDays(7)])->where('dj_id', '=', $djid->user_id)->where('music_id', '=', $record->music_id)->get();
//            return $sunday.$saturday;
            $music = MusicCampaignAudio::find($record->music_id);
            $countrec = IdentifiedMusic::select('music_id')->where([['dj_id', '=', $djid->user_id], ['music_id', '=', $record->music_id]])->get();
            //  $date=Carbon::createFromFormat('Y-m-d H:i:s', $record->played_timestamp);
            // $singleRec=array('playedByDj'=>$djid->dj_name,'played_time'=>$date->toDayDateTimeString(),'music'=>$music);
            $campaign = MusicCampaign::find($record->music_id);

            if(!isset($music->company_name)){
                $company_name = 'Not Set';
                //return $record->music_id;
            }else{
                $company_name = $music->company_name;
            }

            $singleRec = array('playedByDj' => $djid->dj_name, 'label'=>$company_name, 'played_count' => sizeof($countrec), 'music' => $music, 'weektotal' => sizeof($thisweekRecords), 'last_week_total' => sizeof($lastweekRecords));
            $totalspins = $totalspins + sizeof($countrec);
            $jsonrecords->push($singleRec);
        }
        //return $jsonrecords;
        $djuser = User::find($djid->user_id);
        $genres = Dj_Music::where('dj_id', $djuser->id)
                    ->join('music_types','music_types.id','=','music_type')
                    ->select('name')
                    ->get();

        //return $jsonrecords;
        //return [$jsonrecords, $totalspins,$currentUser,$djid,$djuser,$genres,$manager];
        $clubs = $djid->clubs()
                    ->join('cities','cities.id','clubs.city')
                    ->join('states','states.id','cities.state_id')
                    ->join('countries','countries.id','states.country_id')
                    ->select('cities.name as city','states.name as state','countries.name as country','clubs.name','clubs.address','clubs.prime_time','clubs.capacity','clubs.phone_no','clubs.contact')
                    ->get();        
    

        return view('DjManager.dj_spin_report', compact('jsonrecords', 'totalspins','currentUser','djid','djuser','genres','manager','clubs'));
    }



    public function matchResult()
    {
        $datas = new Collection();

        $jsonrecords=collect([]);
        $user =  Auth::user();

        if($user==null)
        {
            return redirect('/');
        }

        if($user->role=="dj")
        {
            $records=IdentifiedMusic::where('dj_id', '=',$user->id)->orderBy('id','DESC')->get();


//            return sizeof($records);
            foreach ($records as $record)
            {

                $music=MusicCampaignAudio::find($record->music_id);
                $dj=Dj::find($record->dj_id);
                $date=Carbon::createFromFormat('Y-m-d H:i:s', $record->played_timestamp);
                $singleRec=array('playedByDj'=>$dj->dj_name,'played_time'=>$date->toDayDateTimeString(),'music'=>$music);

                $datas->push([
                    'playedByDj'         => $user->username,
                    'played_time'       => $date->diffForHumans(),
                    'song_name'      => $music->song_title,
                    'company_name' => $music->company_name,
                ]);
                $jsonrecords->push($singleRec);
            }
        }
        if($user->role=="djmanager")
        {
            $djs=Dj::where('invited_by','=',$user->id)->get();

            foreach ($djs as $dj)
            {
//                return $dj;
                $records=IdentifiedMusic::where('dj_id', '=',$dj->user_id)->orderBy('id','DESC')->get();
                foreach ($records as $record)
                {
                    $music=MusicCampaignAudio::find($record->music_id);
                    $dj=Dj::find($record->dj_id);
                    $date=Carbon::createFromFormat('Y-m-d H:i:s', $record->played_timestamp);
                    $singleRec=array('playedByDj'=>$dj->dj_name,'played_time'=>$date->toDayDateTimeString(),'music'=>$music);
                    $jsonrecords->push($singleRec);

                    $datas->push([
                        'playedByDj'         => $user->username,
                        'played_time'       => $date->diffForHumans(),
                        'song_name'      => $music->song_title,
                        'company_name' => $music->company_name,
                    ]);
                }
            }
        }

        if($user->role=="admin")
        {
            $djs=Dj::all();
            foreach ($djs as $dj)
            {

                $records=IdentifiedMusic::where('dj_id', '=',$dj->user_id)->orderBy('id','DESC')->get();

                foreach ($records as $record)
                {
                    $music=MusicCampaignAudio::find($record->music_id);
                    $dj=Dj::find($record->dj_id);
                    $date=Carbon::createFromFormat('Y-m-d H:i:s', $record->played_timestamp);
                    $singleRec=array('playedByDj'=>$dj->dj_name,'played_time'=>$date->toDayDateTimeString(),'music'=>$music);
                    $jsonrecords->push($singleRec);


                    $datas->push([
                        'playedByDj'         => $user->username,
                        'played_time'       =>  $date->diffForHumans(),
                        'song_name'      => $music->song_title,
                        'company_name' => $music->company_name,
                    ]);
                }
            }
        }
      //  return response()->json($jsonrecords);
//      return Datatables::of($jsonrecords);
//        return $datas;
        return view('DjManager.dj_spin_report',compact('jsonrecords'));



    }

    public function viewResults()
    {
        return view('dj.viewresult');

    }

    public function weeklyreport($dj, $week)
    {
        $currentUser =  Auth::user();


        if($week < 0){
            return 0;
        }

        Carbon::setWeekStartsAt(Carbon::SUNDAY);
        Carbon::setWeekEndsAt(Carbon::SATURDAY);

        $startDate = Carbon::now()->startOfWeek()->subWeeks($week);
        $endDate = Carbon::now()->endOfWeek()->subWeeks($week);
        
        //return [$startDate, $endDate];

        
         $identifiedMusics = IdentifiedMusic::where('dj_id', $dj)
            //->join('music_campaign_audios','music_campaign_audios.id','music_id')
            ->where('played_timestamp','>=',$startDate)
            ->where('played_timestamp','<=',$endDate)
            ->get()
            ->groupBy('music_id')
            ->map(function (Collection $music) {
            return $music->groupBy(function($date) {
                return Carbon::parse($date->played_timestamp)->format('l'); // grouping by day
              })->map(function (Collection $count) {
                      //return $count->count();
                      return $count;
                });
          });

        //return Dj::find($dj);
         return view('DjManager.daily',compact('identifiedMusics','startDate','endDate','week','dj'));
       
    }

    public function update_payment_status(Request $request, $status){
        $im = IdentifiedMusic::find($request->ids);
        error_log($im);
        $pr =  $im->payments_records;
        $pr['status'] = (int) $status;
        $im->payments_records = $pr;
        $im->save();
        error_log($im);
        return response()->json(['success'=>"success"]);
    }
}

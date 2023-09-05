<?php

namespace App\Http\Controllers;

use App\MusicCampaign;
use Auth;
use App\Dj_Music;
use App\Dj;
use App\AcceptedCampaign;
use App\MusicType;
use DB;
use Illuminate\Http\Request;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Output\NullOutput;
use App\Advertisement;

class DjDashboardController extends Controller
{
    protected $campaigns;
    public $output;

    public function __construct(MusicCampaign $campaigns)
    {
        $this->campaigns = $campaigns;
        $this->output = new ConsoleOutput();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $currentUser = auth()->user();

        if ($currentUser->blocked == "yes") {
            //return view('djdashboard.successfulregistration');
            //return redirect('/djlogin/success')->withError('YOUR ACCOUNT IS NOT VERIFIED, PLEASE ENTER A VALID CLUB SO WE CAN BEGIN THE VERIFICATION PROCESS');
        }

        $id = Auth::Id();
        $dj = Dj::where('user_id', $id)->first();

        $genres = Dj_Music::where('dj_id', $id)
            ->join('music_types', 'music_types.id', 'music_type')
            ->select('music_type', 'music_types.name')
            ->get();



        $genre_ids = array();

        for ($i = 0; $i < count($genres); $i++) {
            $genre_ids[] =   $genres[$i]['music_type'];
        }

        $campaigns = $this->campaigns
            ->join('music_campaign_audios', 'music_campaign_audios.campaign_id', 'music_campaigns.id')
            ->select('music_campaign_audios.id as audio_id', 'music_campaign_audios.*', 'music_campaigns.*')
            ->where(function ($query) use ($genre_ids) {
                for ($i = 0; $i < sizeof($genre_ids); $i++) {
                    $query->orWhereRaw('JSON_CONTAINS(music_campaign_audios.genre, \'[' . $genre_ids[$i] . ']\')');
                }
            })
            ->orderBy('music_campaigns.updated_at', 'desc')
            ->paginate(15);
        $maxPage = $campaigns->lastPage();

        if ($request->ajax()) {
            return view('djdashboard.lay_next', ['campaigns' => $campaigns, 'maxPage' => $maxPage, 'dj'=>$dj])->render();
        }



        if ($dj->type == 'normal' && ($dj->clubs()->count() == 0 || $currentUser->blocked == 'yes')) {

//            return redirect('/djlogin/success')->withError('Add Your Club or Streaming Station details below. This Step is Mandatory for Verification');
        }
        //return $dj;
        $djEvents = \App\DjEvents::where('dj_id', $dj->id)->take(2)->get();

        $accepted =  AcceptedCampaign::where('dj_id', $dj->id)
            ->join('music_campaigns', 'music_campaigns.id', 'accepted_campaigns.campaign_id')
            ->join('music_campaign_audios', 'music_campaign_audios.campaign_id', 'music_campaigns.id')
            ->select('music_campaign_audios.company_name', 'music_campaigns.id', 'music_campaign_audios.id as audio_id', 'artist_name', 'campaign_name', 'earning', 'last_deposit', 'spin_rate', 'campaign_balance')
            ->get();


        $now = \Carbon\Carbon::now();
        $month = $now->month;
        $m = ($now->subMonth())->format('F');

        $emonth = $month - 1 == 0 ? 12 : $month - 1;

        $tm =  \App\IdentifiedMusic::whereMonth('created_at', '=', $month)
            ->where('dj_id', $currentUser->id)
            ->count();

        $lm =  \App\IdentifiedMusic::whereMonth('created_at', '=', $emonth)
            ->where('dj_id', $currentUser->id)
            ->count();


        $diff = $tm - $lm;
        if ($diff > 0) {
            $diff = '+' . $diff;
        }

        //Advertisement
        $date = date('Y-m-d');

        $getAds = Advertisement::where('start_date', '<=', $date)
            ->where('end_date', '>=', $date)
            ->where('status', Advertisement::STATUS_APPROVE)
            ->first();

        return view('djdashboard.posts', compact('campaigns', 'maxPage', 'dj', 'accepted', 'genres', 'lm', 'diff', 'm', 'diff', 'djEvents', 'getAds'));
    }

    public function crate(Request $request)
    {

        $currentUser = auth()->user();

        if ($currentUser->blocked == "yes") {
            //return view('djdashboard.successfulregistration');
            return redirect('/djlogin/success')->withError('YOUR ACCOUNT IS NOT VERIFIED, PLEASE ENTER A VALID CLUB SO WE CAN BEGIN THE VERIFICATION PROCESS');
        }

        $id = Auth::Id();
        $dj = Dj::where('user_id', $id)->first();

        $genres = Dj_Music::where('dj_id', $id)
            ->join('music_types', 'music_types.id', 'music_type')
            ->select('music_type', 'music_types.name')
            ->get();



        $genre_ids = array();

        for ($i = 0; $i < count($genres); $i++) {
            $genre_ids[] =   $genres[$i]['music_type'];
        }


        $campaigns = $this->campaigns
            ->join('music_campaign_audios', 'music_campaign_audios.campaign_id', 'music_campaigns.id')
            ->select('music_campaign_audios.id as audio_id', 'music_campaign_audios.*', 'music_campaigns.*')
            ->where(function ($query) use ($genre_ids) {
                for ($i = 0; $i < sizeof($genre_ids); $i++) {
                    $query->orWhereRaw('JSON_CONTAINS(music_campaign_audios.genre, \'[' . $genre_ids[$i] . ']\')');
                }
            })->orderBy('music_campaigns.updated_at', 'desc')
            ->paginate(15);
        //$this->output->writeln($request->ip);
        //return $campaigns;

        if ($request->ajax()) {
            return view('dj.crate_list', ['campaigns' => $campaigns, 'dj'=>$dj])->render();
        }



        if ($dj->type == 'normal' && ($dj->clubs()->count() == 0 || $currentUser->blocked == 'yes')) {

            return redirect('/djlogin/success')->withError('Add Your Club or Streaming Station details below. This Step is Mandatory for Verification');
        }
        //return $dj;
        $djEvents = \App\DjEvents::where('dj_id', $dj->id)->take(2)->get();

        $accepted =  AcceptedCampaign::where('dj_id', $dj->id)
            ->join('music_campaigns', 'music_campaigns.id', 'accepted_campaigns.campaign_id')
            ->join('music_campaign_audios', 'music_campaign_audios.campaign_id', 'music_campaigns.id')
            ->select('music_campaign_audios.company_name', 'music_campaigns.id', 'artist_name', 'campaign_name', 'earning', 'last_deposit', 'spin_rate', 'campaign_balance')
            ->get();


        $now = \Carbon\Carbon::now();
        $month = $now->month;
        $m = ($now->subMonth())->format('F');

        $emonth = $month - 1 == 0 ? 12 : $month - 1;

        $tm =  \App\IdentifiedMusic::whereMonth('created_at', '=', $month)
            ->where('dj_id', $currentUser->id)
            ->count();

        $lm =  \App\IdentifiedMusic::whereMonth('created_at', '=', $emonth)
            ->where('dj_id', $currentUser->id)
            ->count();


        $diff = $tm - $lm;
        if ($diff > 0) {
            $diff = '+' . $diff;
        }

        //Advertisement
        $date = date('Y-m-d');

        $getAds = Advertisement::where('start_date', '<=', $date)
            ->where('end_date', '>=', $date)
            ->where('status', Advertisement::STATUS_APPROVE)
            ->first();

        return view('dj.crate', compact('campaigns', 'dj', 'accepted', 'genres', 'lm', 'diff', 'm', 'diff', 'djEvents', 'getAds'));
    }

    public function alphabet(Request $request)
    {
        $user = Auth::user();

        if ($user->role = 'manager') {
            $campaigns = $this->campaigns
                ->orderBy('music_campaign_audios.song_title', 'desc')
                ->join('music_campaign_audios', 'music_campaign_audios.campaign_id', 'music_campaigns.id')
                ->paginate(15);

            return view('djdashboard.lay', ['campaigns' => $campaigns])->render();
        }

        $id = Auth::Id();
        $dj = Dj::where('user_id', $id)->first();
        //$dj->id = 6;
        $genres = Dj_Music::where('dj_id', $dj->id)->select('music_type')
            ->get();
        $genre_ids = array();



        for ($i = 0; $i < count($genres); $i++) {
            $genre_ids[] =   $genres[$i]['music_type'];
        }

        $campaigns = $this->campaigns
            ->orderBy('campaign_name')
            ->join('music_campaign_audios', 'music_campaign_audios.campaign_id', 'music_campaigns.id')
            ->where(function ($query) use ($genre_ids) {
                for ($i = 0; $i < sizeof($genre_ids); $i++) {
                    $query->orWhereRaw('JSON_CONTAINS(music_campaign_audios.genre, \'[' . $genre_ids[$i] . ']\')');
                }
            })
            ->paginate(15);
        if ($request->ajax()) {
            return view('djdashboard.lay', ['campaigns' => $campaigns, 'dj'=>$dj])->render();
        }
        return view('djdashboard.posts', compact('campaigns', 'dj', 'accepted', 'genres'));
    }

    public function rate(Request $request)
    {
        $user = Auth::user();
        if ($user->role == 'manager') {
            $campaigns = $this->campaigns
                ->orderBy('spin_rate', 'desc')
                ->join('music_campaign_audios', 'music_campaign_audios.campaign_id', 'music_campaigns.id')
                ->select('music_campaign_audios.id as audio_id', 'music_campaign_audios.*', 'music_campaigns.*')
                ->paginate(15);

            return view('djdashboard.lay', ['campaigns' => $campaigns])->render();
        }

        $id = Auth::Id();
        $dj = Dj::where('user_id', $id)->first();
        //$dj->id = 6;
        $genres = Dj_Music::where('dj_id', $dj->id)
            ->select('music_type')
            ->get();
        $genre_ids = array();



        for ($i = 0; $i < count($genres); $i++) {
            $genre_ids[] =   $genres[$i]['music_type'];
        }

        $campaigns = $this->campaigns
            ->orderBy('spin_rate', 'desc')
            ->join('music_campaign_audios', 'music_campaign_audios.campaign_id', 'music_campaigns.id')
            ->select('music_campaign_audios.id as audio_id', 'music_campaign_audios.*', 'music_campaigns.*')
            ->where(function ($query) use ($genre_ids) {
                for ($i = 0; $i < sizeof($genre_ids); $i++) {
                    $query->orWhereRaw('JSON_CONTAINS(music_campaign_audios.genre, \'[' . $genre_ids[$i] . ']\')');
                }
            })
            ->paginate(15);
        $maxPage = $campaigns->lastPage();
        if ($request->ajax()) {
            if($request->page == 0){
                return view('djdashboard.lay', ['campaigns' => $campaigns, 'maxPage' => $maxPage, 'dj'=>$dj])->render();
            }
            return view('djdashboard.lay_next', ['campaigns' => $campaigns, 'maxPage' => $maxPage, 'dj'=>$dj])->render();
        }
        return view('djdashboard.posts', compact('campaigns', 'dj', 'accepted'));
    }


    public function bpm(Request $request)
    {
        $user = Auth::user();
        if ($user->blocked == "yes") {
            return redirect('/djlogin/success')->withError('YOUR ACCOUNT IS NOT VERIFIED, PLEASE ENTER A VALID CLUB SO WE CAN BEGIN THE VERIFICATION PROCESS');
        }

        if ($user->role == 'manager') {
            $campaigns = $this->campaigns
                ->orderBy('music_campaigns.bpm', 'desc')
                ->join('music_campaign_audios', 'music_campaign_audios.campaign_id', 'music_campaigns.id')
                ->select('music_campaign_audios.id as audio_id', 'music_campaign_audios.*', 'music_campaigns.*')
                ->paginate(15);

            return view('djdashboard.lay', ['campaigns' => $campaigns])->render();
        }

        $id = Auth::Id();
        $dj = Dj::where('user_id', $id)->first();
        //$dj->id = 6;
        $genres = Dj_Music::where('dj_id', $dj->id)
            ->select('music_type')
            ->get();
        $genre_ids = array();



        for ($i = 0; $i < count($genres); $i++) {
            $genre_ids[] =   $genres[$i]['music_type'];
        }

        $campaigns = $this->campaigns
            ->orderBy('music_campaigns.bpm', 'desc')
            ->join('music_campaign_audios', 'music_campaign_audios.campaign_id', 'music_campaigns.id')
            ->select('music_campaign_audios.id as audio_id', 'music_campaign_audios.*', 'music_campaigns.*')
            ->where(function ($query) use ($genre_ids) {
                for ($i = 0; $i < sizeof($genre_ids); $i++) {
                    $query->orWhereRaw('JSON_CONTAINS(music_campaign_audios.genre, \'[' . $genre_ids[$i] . ']\')');
                }
            })
            ->paginate(15);
        $maxPage = $campaigns->lastPage();
        if ($request->ajax()) {
            if($request->page == 0){
                return view('djdashboard.lay', ['campaigns' => $campaigns, 'maxPage' => $maxPage, 'dj'=>$dj])->render();
            }
            return view('djdashboard.lay_next', ['campaigns' => $campaigns, 'maxPage' => $maxPage, 'dj'=>$dj])->render();
        }
        if ($dj->type == 'normal' && ($dj->clubs()->count() == 0 || $user->blocked == 'yes')) {

            return redirect('/djlogin/success')->withError('Add Your Club or Streaming Station details below. This Step is Mandatory for Verification');
        }
        //return $dj;
        $djEvents = \App\DjEvents::where('dj_id', $dj->id)->take(2)->get();

        $accepted =  AcceptedCampaign::where('dj_id', $dj->id)
            ->join('music_campaigns', 'music_campaigns.id', 'accepted_campaigns.campaign_id')
            ->join('music_campaign_audios', 'music_campaign_audios.campaign_id', 'music_campaigns.id')
            ->select('music_campaign_audios.company_name', 'music_campaigns.id', 'music_campaign_audios.id as audio_id', 'artist_name', 'campaign_name', 'earning', 'last_deposit', 'spin_rate', 'campaign_balance')
            ->get();


        $now = \Carbon\Carbon::now();
        $month = $now->month;
        $m = ($now->subMonth())->format('F');

        $emonth = $month - 1 == 0 ? 12 : $month - 1;

        $tm =  \App\IdentifiedMusic::whereMonth('created_at', '=', $month)
            ->where('dj_id', $user->id)
            ->count();

        $lm =  \App\IdentifiedMusic::whereMonth('created_at', '=', $emonth)
            ->where('dj_id', $user->id)
            ->count();


        $diff = $tm - $lm;
        if ($diff > 0) {
            $diff = '+' . $diff;
        }

        //Advertisement
        $date = date('Y-m-d');

        $getAds = Advertisement::where('start_date', '<=', $date)
            ->where('end_date', '>=', $date)
            ->where('status', Advertisement::STATUS_APPROVE)
            ->first();

        return view('djdashboard.posts', compact('campaigns', 'maxPage', 'dj', 'accepted', 'genres', 'lm', 'diff', 'm', 'diff', 'djEvents', 'getAds'));
    }


    public function total_spin(Request $request)
    {
        $user = Auth::user();
        if ($user->role == 'manager') {
            $campaigns = $this->campaigns
                ->orderBy('music_campaigns.total_spin', 'desc')
                ->join('music_campaign_audios', 'music_campaign_audios.campaign_id', 'music_campaigns.id')
                ->select('music_campaign_audios.id as audio_id', 'music_campaign_audios.*', 'music_campaigns.*')
                ->paginate(15);

            return view('djdashboard.lay', ['campaigns' => $campaigns])->render();
        }

        $id = Auth::Id();
        $dj = Dj::where('user_id', $id)->first();
        //$dj->id = 6;
        $genres = Dj_Music::where('dj_id', $dj->id)
            ->select('music_type')
            ->get();
        $genre_ids = array();



        for ($i = 0; $i < count($genres); $i++) {
            $genre_ids[] =   $genres[$i]['music_type'];
        }

        $campaigns = $this->campaigns
            ->orderBy('music_campaigns.total_spin', 'desc')
            ->join('music_campaign_audios', 'music_campaign_audios.campaign_id', 'music_campaigns.id')
            ->select('music_campaign_audios.id as audio_id', 'music_campaign_audios.*', 'music_campaigns.*')
            ->where(function ($query) use ($genre_ids) {
                for ($i = 0; $i < sizeof($genre_ids); $i++) {
                    $query->orWhereRaw('JSON_CONTAINS(music_campaign_audios.genre, \'[' . $genre_ids[$i] . ']\')');
                }
            })
            ->paginate(15);
        $maxPage = $campaigns->lastPage();
        if ($request->ajax()) {
            if($request->page == 0){
                return view('djdashboard.lay', ['campaigns' => $campaigns, 'maxPage' => $maxPage, 'dj'=>$dj])->render();
            }
            return view('djdashboard.lay_next', ['campaigns' => $campaigns, 'maxPage' => $maxPage, 'dj'=>$dj])->render();
        }
        return view('djdashboard.posts', compact('campaigns', 'dj', 'accepted'));
    }


    public function like(Request $request)
    {

        $user = Auth::user();
        if ($user->role == 'manager') {
            $campaigns = $this->campaigns
                ->orderBy('music_campaigns.likes', 'desc')
                ->join('music_campaign_audios', 'music_campaign_audios.campaign_id', 'music_campaigns.id')
                ->select('music_campaign_audios.id as audio_id', 'music_campaign_audios.*', 'music_campaigns.*')
                ->paginate(15);

            return view('djdashboard.lay', ['campaigns' => $campaigns])->render();
        }


        $id = Auth::Id();
        $dj = Dj::where('user_id', $id)->first();
        //$dj->id = 6;
        $genres = Dj_Music::where('dj_id', $dj->id)
            ->select('music_type')
            ->get();
        $genre_ids = array();

        for ($i = 0; $i < count($genres); $i++) {
            $genre_ids[] =   $genres[$i]['music_type'];
        }

        $campaigns = $this->campaigns
            ->orderBy('likes', 'desc')
            ->join('music_campaign_audios', 'music_campaign_audios.campaign_id', 'music_campaigns.id')
            ->where(function ($query) use ($genre_ids) {
                for ($i = 0; $i < sizeof($genre_ids); $i++) {
                    $query->orWhereRaw('JSON_CONTAINS(music_campaign_audios.genre, \'[' . $genre_ids[$i] . ']\')');
                }
            })
            ->select('music_campaign_audios.id as audio_id', 'music_campaign_audios.*', 'music_campaigns.*')
            ->paginate(15);
        $maxPage = $campaigns->lastPage();
        if ($request->ajax()) {
            if($request->page == 0){
                return view('djdashboard.lay', ['campaigns' => $campaigns, 'maxPage' => $maxPage])->render();
            }
            return view('djdashboard.lay_next', ['campaigns' => $campaigns, 'maxPage' => $maxPage])->render();
        }

        $now = \Carbon\Carbon::now();
        $m = ($now->subMonth())->format('F');
        $month = $now->month;
        $m = ($now->subMonth())->format('F');

        $emonth = $month - 1 == 0 ? 12 : $month - 1;
        $currentUser = auth()->user();


        $lm =  \App\IdentifiedMusic::whereMonth('created_at', '=', $emonth)
            ->where('dj_id', $currentUser->id)
            ->count();
        $tm =  \App\IdentifiedMusic::whereMonth('created_at', '=', $month)
            ->where('dj_id', $currentUser->id)
            ->count();
        $diff = $tm - $lm;

        return view('djdashboard.posts', compact('campaigns', 'dj', 'accepted', 'lm', 'm', 'diff'));
    }

    public function genres(MusicTYpe $genre, Request $request)
    {

        $user = Auth::user();
        if ($user->role == 'manager') {
            $campaigns = $this->campaigns
                ->join('music_campaign_audios', 'music_campaign_audios.campaign_id', 'music_campaigns.id')
                ->orWhereRaw('JSON_CONTAINS(music_campaign_audios.genre, \'[' . $genre->id . ']\')')
                ->paginate(15);

            return view('djdashboard.lay', ['campaigns' => $campaigns])->render();
        }

        $id = Auth::Id();
        $dj = Dj::where('user_id', $id)->first();
        $genre_ids[] =  $genre->id;


        $campaigns = $this->campaigns
            ->join('music_campaign_audios', 'music_campaign_audios.campaign_id', 'music_campaigns.id')
            ->where(function ($query) use ($genre_ids) {
                for ($i = 0; $i < sizeof($genre_ids); $i++) {
                    $query->orWhereRaw('JSON_CONTAINS(music_campaign_audios.genre, \'[' . $genre_ids[$i] . ']\')');
                }
            })
            ->select('music_campaign_audios.id as audio_id', 'music_campaign_audios.*', 'music_campaigns.*')
            ->paginate(15);
        $maxPage = $campaigns->lastPage();
        if ($request->ajax()) {
            if($request->page == 0){
                return view('djdashboard.lay', ['campaigns' => $campaigns, 'maxPage' => $maxPage, 'dj'=>$dj])->render();
            }
            return view('djdashboard.lay', ['campaigns' => $campaigns, 'dj'=>$dj])->render();
        } else {
            return $campaigns;
        }
    }
    public function inbox()
    {
        $id = Auth::Id();
        $dj = Dj::where('user_id', $id)->first();

        $inbox = DB::table('chat_history')
            ->select('users.username as dj_name', 'chat_history.*')
            ->join('users', 'users.id', '=', 'chat_history.sender_id')
            ->whereReceiver_id($dj->id)->get();


        return view('djdashboard.inbox', compact('inbox', 'dj'));
    }


    public function removeMessage(Request $request)
    {
        if (!empty($request->messageIds)) {
            DB::table('chat_history')->whereIn('id', $request->messageIds)->delete();
            return redirect()->route('dj.inbox')->with('message', "Message successfully Deleted");
        } else {
            return redirect()->route('dj.inbox')->with('message', "Please Select The message");
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model|null|static
     */
    public function djUserBalance()
    {

        $id = Auth::Id();
        $dj = Dj::where('user_id', $id)->first();

        return $dj;
    }


    public function get_widget_search(Request $request)
    {

        $currentUser = auth()->user();
        $id = Auth::Id();
        $dj = Dj::where('user_id', $id)->first();

        $genres = Dj_Music::where('dj_id', $id)
            ->join('music_types', 'music_types.id', 'music_type')
            ->select('music_type', 'music_types.name')
            ->get();

        $genre_ids = array();

        for ($i = 0; $i < count($genres); $i++) {
            $genre_ids[] =   $genres[$i]['music_type'];
        }

        $m_type_ids = array();
        $music_types = DB::table('music_types')->where('name', 'LIKE', '%' . $request->searchKeyword . '%')->get();

        for ($i = 0; $i < count($music_types); $i++) {
            $m_type_ids[] =  $music_types[$i]->id;
        }

        $campaigns = $this->campaigns
            ->join('music_campaign_audios', 'music_campaign_audios.campaign_id', 'music_campaigns.id')
            //->where('music_campaigns.campaign_name','LIKE', '%'. $_GET['searchKeyword'] .'%')
            ->where('music_campaign_audios.song_title', 'LIKE', '%' . $request->searchKeyword . '%')
            ->orwhere('music_campaign_audios.artist_name', 'LIKE', '%' . $request->searchKeyword . '%')
            ->where(function ($query) use ($genre_ids) {
                for ($i = 0; $i < sizeof($genre_ids); $i++) {
                    $query->orWhereRaw('JSON_CONTAINS(music_campaign_audios.genre, \'[' . $genre_ids[$i] . ']\')');
                }
            })->orwhere(function ($query) use ($m_type_ids) {
                for ($i = 0; $i < sizeof($m_type_ids); $i++) {
                    $query->orWhereRaw('JSON_CONTAINS(music_campaign_audios.genre, \'[' . $m_type_ids[$i] . ']\')');
                }
            })->orderBy('music_campaigns.id', 'desc')
            ->select('music_campaign_audios.id as audio_id', 'music_campaign_audios.*', 'music_campaigns.*')
            ->paginate(15);


        if (count($campaigns) != 0) {
            $maxPage = $campaigns->lastPage();
            if (true) {
                if($request->page == 0){
                    return view('djdashboard.lay', ['campaigns' => $campaigns, 'maxPage' => $maxPage])->render();
                }
                return view('djdashboard.lay_next', ['campaigns' => $campaigns, 'maxPage' => $maxPage])->render();
            }
        } else if ($request->ajax() && count($campaigns) == 0) {
            return "<h2 style='margin-bottom:40px;'>Sorry, No results found on your criteria<h2>";
        }
    }

    public static function doRequiredRedirects()
    {
        $user = Auth::user();
        if ($user->blocked == "yes") {
            //return view('djdashboard.successfulregistration');
            return redirect('/hgads')->withError('You do not have permission to view this');
        }
    }
}
<?php

namespace App\Http\Controllers;

use App\AcceptedCampaign;
use App\Helpers\PushNotification;
use App\MusicCampaignAudio;
use App\Helpers\Notification;

use App\MusicType;
use App\User;
use Carbon\Carbon;
use FFMpeg\Format\Audio\Mp3;
use Illuminate\Http\Request;
use GuzzleHttp\Psr7\Request as async;
use Illuminate\Support\Facades\Auth;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\MusicCampaign;
use Illuminate\Support\Facades\Log;
use Session;
use App\Dj;
use FFMpeg\FFMpeg;
use Illuminate\Support\Facades\Redis;
use DB;
use App\Helpers\notification_app;

class MusicCampaignAudioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        //
        $musicCampaigns = MusicCampaignAudio::all();
        return view('MusicCampaignAudio.index', compact('musicCampaigns'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //$value = $request->session()->get('campaignId', 'default');
        if(Session::get('is_flag') == '1') {
            $musictype = explode(',', Session::get('musictype'));
            $company_name = Session::get('company_name');
            $artist_website = Session::get('artist_website');
            $song_title = Session::get('song_title');
            $release_date = Session::get('release_date');
            $isrc = Session::get('isrc');
            $upc = Session::get('upc');
            $artist_name = Session::get('artist_name');
            $image = Session::get('image');
            $imagePath = 'artwork/' . $image;
            $audioName = Session::get('audio');
            $audioPath = Session::get('audioPath');

            $gen = json_encode($musictype, JSON_NUMERIC_CHECK);
            try
            {
                $arr = json_decode($gen);
                $genres='';
                foreach($arr as $item) { //foreach element in $arr
                    $genre=MusicType::find($item);
                    if($genre)
                    {
                        $genres=$genres.$genre->name.', ';
                    }
                }

                $ffmpeg = FFMpeg::create();
                $audio = $ffmpeg->open($audioPath);
                $audio->filters()->addMetadata([
                    "title" => $song_title,
                    "track" => 1,
                    "year" => $release_date,
                    "artist" => $artist_name,
                    "album" => $artist_website,
                    "artwork"=> $imagePath,
                    "description"=>$company_name,
                    "genre"=>$genres

                ]);
                $format = new Mp3();
                $audio->save($format, $audioPathNew);
            }
            catch (\Exception $e)
            {

            }

            $user_id = Auth::id();
            $user = Auth::user();
            if (Session::has('new_campaign_id')) {
                $campaignId = Session::get('new_campaign_id');
                $musicCampaign = MusicCampaign::find($campaignId);
            } else {
                $musicCampaign = MusicCampaign::where('user_id', $user_id)->first();
            }

            if($musicCampaign->campaign_balance < 5){
                return redirect()->back()->with('error','Balance not enough');
            }
            $id = $musicCampaign->id;
            $musicCampaign->slug = str_slug($song_title, "-") . $id;

    //        $musicCampaign->genre = $request->genre;
            $musicCampaign->save();
            if($musicCampaign->campaign_balance < 1) {
                return redirect('/campaign/dashboard');
            }

            $audioInfo = MusicCampaignAudio::create([
                'campaign_id' => $id,
                'audio' => 'spin'.$audioName.'.mp3',
                'company_name' => $company_name,
                'artist_website' => $artist_website,
                'song_title' => $song_title,
                'release_date' => $release_date,
                'isrc' => $isrc,
                'upc' => $upc,
                'genre' => $gen,
                'artist_name' => $artist_name,
                'artwork' => $imagePath,
            ]);
            if(isset($audioInfo)) {
                $djs = Dj::join('dj__musics', 'dj__musics.dj_id', 'djs.id')->select('djs.user_id')->whereIn('music_type', json_decode($gen))->groupBy('djs.user_id')->get();

                $data = [];
                $responseObj = [
                    'campaignAudioId' => $audioInfo->id,
                    'campaignId' => $musicCampaign->id,
                    'source'=>'new_music_added'

                ];

                $nmessage = "A new song has been added";
                PushNotification::sendToTag('dj', $responseObj, $nmessage);
                foreach ($djs as $key => $value) {
                    $id_dj = $value['user_id'];

                    $data = array('reference_id' => $value->user_id,"is_shown"=>"0",'user_id'=>$user->id, 'subject'=>'New Music Uploaded','message' => 'New Music added on Your Genre', 'href' => ''.$audioInfo->id, 'type' => 'campaign-added', 'seen' => 0,'image' => '/'.$audioInfo->artwork, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now());

                    $message=[

                        'html'=>'<li><a class="dropdown-menu-notifications-item" href="/campaignaudio/create" data-id="205161"><span class="dropdown-menu-notifications-item-content"><span><img src="/'.$audioInfo->artwork.'" height = "35px;"></span> <span><p>New Music Uploaded</p><p>New Music added on Your Genre</p></span></span><span class="dropdown-menu-notifications-item-ago"></span></a></li>'
                    ];
                    \App\Helpers\Notification::send(2,$data,$message);

                }

                $payload["user_id"] = $user->id;
                $payload["campaign_id"] = $musicCampaign;
                $payload["audio_link"] = env('APP_URL', 'http://127.0.0.1/') . '/audio' . $audioName;
                $payload["played_timestamp"] = time();

                $data["source_app_id"] = "website";
                $data["created_at"] = date('Y-m-d H:i:s');
                $data["topic"] = "audio_added";
                $data["payload"] = $payload;
                Redis::publish('wave', json_encode(array(['id' => $audioInfo->id])));
                Redis::rpush('queue:audio_add', json_encode(array(['identifier' => $audioInfo->id, 'audio_path'=>$audioPath])));

                // reset session
                Session::forget('new_campaign_package');
                $is_success = true;
            }
            else {
                $is_success = false;
            }
            
            //return redirect('/campaign/dashboard');
            return view('campaign.payment_success', compact('is_success'));
        }
        else {
            $musictypes = MusicType::all();
            if (Session::has('new_campaign_id')) {
                $campaignId = Session::get('new_campaign_id');
                $campaign = MusicCampaign::find($campaignId);
            } else {
                $campaign = MusicCampaign::where('user_id', Auth::id())->first();
            }
            $campaignId = $campaign->id;
            $region = "global";

            $audioCount = MusicCampaignAudio::where('campaign_id', $campaignId)->count();
            $is_modal = false;

            $newCampaignSelectedPackage = Session::get('new_campaign_package');

            if (isset($campaign->campaign_balance) && $campaign->campaign_balance == 0 && $audioCount == 0) {
                //return redirect('/payment/paypal');
                $is_modal = true;
            }
            if ($audioCount == 0) {
                return view('MusicCampaignAudio.create', compact('musictypes', 'is_modal', 'newCampaignSelectedPackage', 'region'));
            } else {
                return redirect('/campaign/dashboard');
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            //'audio' => 'required|mimes:mp3,m4a,wav',
            'audio' => 'required',
            'company_name' => 'required',
            'artist_website' => 'required',
            'song_title' => 'required',
            'release_date' => 'required',
            //'isrc' => 'in_isrc',
            //'upc' => 'required',
            'musictype' => 'required',
            'artist_name' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif,JPEG,JPG,PNG,GIF|required|max:10000',
        ]);
        $imagePathTotal='';
        if ($request->hasFile('image')) {
            $file = request('image');
            $imageName = time() . $file->getClientOriginalName();
            $dir = 'artwork';
            $message = $file->move($dir, $imageName);
            $imagePath = $dir . '/' . $imageName;
            Log::error($message);
            $imagePathTotal=public_path().'/artwork/'.$imagePath;
        } else {
            return "Artwork not uploaded";
        }
        
        $audioPath='';
        $audioPathNew='';
        if ($request->hasFile('audio')) {
            $file = request('audio');

            $fileExt = $file->getClientOriginalExtension();

            if (!in_array($fileExt, ["mp3","MP3"])) {
                return redirect()->back()->with('audio.error', 'The audio must be a file of type: mp3, MP3.');
            }

            $audioName = time() . str_replace(" ","", $request->song_title);
            $message = $file->move('audio', $audioName.'.'.$fileExt);
            $audioPath=public_path().'/audio/'.$audioName.'.'.$fileExt;
            $audioPathNew=public_path().'/audio/spin'.$audioName.'.'.$fileExt;
            Log::error($message);

        } else {

            return "audio not uploaded";
        }

        $gen = json_encode($request->musictype, JSON_NUMERIC_CHECK);

        try{
            $arr = json_decode($gen);
            $genres='';
            foreach($arr as $item) { //foreach element in $arr
                $genre=MusicType::find($item);
                if($genre)
                {
                    $genres=$genres.$genre->name.', ';
                }
            }

            $ffmpeg = FFMpeg::create();
            $audio = $ffmpeg->open($audioPath);
            $audio->filters()->addMetadata([
                "title" => $request->song_title,
                "track" => 1,
                "year" => $request->release_date,
                "artist" => $request->artist_name,
                "album" => $request->artist_website,
                "artwork"=> $imagePath,
                "description"=>$request->company_name,
                "genre"=>$genres

            ]);

            $format = new Mp3();


            $audio->save($format, $audioPathNew);



        }
        catch (\Exception $e)
        {
        }

        $user_id = Auth::id();
        $user = Auth::user();


        if (Session::has('new_campaign_id')) {
            $campaignId = Session::get('new_campaign_id');
            $musicCampaign = MusicCampaign::find($campaignId);
        } else {
            $musicCampaign = MusicCampaign::where('user_id', $user_id)->first();
        }
        if($musicCampaign->campaign_balance < 5){
            return redirect()->back()->with('error','Balance not enough');
        }
        $id = $musicCampaign->id;
        $musicCampaign->slug = str_slug($request->song_title, "-") . $id;

//        $musicCampaign->genre = $request->genre;
        $musicCampaign->save();
        
        if($musicCampaign->campaign_balance < 1){


            return redirect('/campaign/dashboard');
        }

        $audioInfo = MusicCampaignAudio::create([
            'campaign_id' => $id,
            'audio' => 'spin'.$audioName.'.mp3',
            'company_name' => $request->company_name,
            'artist_website' => $request->artist_website,
            'song_title' => $request->song_title,
            'release_date' => $request->release_date,
            'isrc' => $request->isrc,
            'upc' => $request->upc,
            'genre' => $gen,
            'artist_name' => $request->artist_name,
            'artwork' => $imagePath,
        ]);
        

        $djs = Dj::join('dj__musics', 'dj__musics.dj_id', 'djs.id')->select('djs.user_id')->whereIn('music_type', json_decode($gen))->groupBy('djs.user_id')->get();


        $data = [];
        $responseObj = [
            'campaignAudioId' => $audioInfo->id,
            'campaignId' => $musicCampaign->id,
            'source'=>'new_music_added'

        ];

        $nmessage = "A new song has been added";
        PushNotification::sendToTag('dj', $responseObj, $nmessage);
        foreach ($djs as $key => $value) {
            $id_dj = $value['user_id'];

            $data = array('reference_id' => $value->user_id,"is_shown"=>"0",'user_id'=>$user->id, 'subject'=>'New Music Uploaded','message' => 'New Music added on Your Genre', 'href' => ''.$audioInfo->id, 'type' => 'campaign-added', 'seen' => 0,'image' => '/'.$audioInfo->artwork, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now());

            $message=[

                'html'=>'<li><a class="dropdown-menu-notifications-item" href="/campaignaudio/create" data-id="205161"><span class="dropdown-menu-notifications-item-content"><span><img src="/'.$audioInfo->artwork.'" height = "35px;"></span> <span><p>New Music Uploaded</p><p>New Music added on Your Genre</p></span></span><span class="dropdown-menu-notifications-item-ago"></span></a></li>'
            ];
            \App\Helpers\Notification::send(2,$data,$message);

        }

        $payload["user_id"] = $user->id;
        $payload["campaign_id"] = $musicCampaign;
        $payload["audio_link"] = env('APP_URL', 'http://127.0.0.1/') . '/audio' . $audioName;
        $payload["played_timestamp"] = time();

        $data["source_app_id"] = "website";
        $data["created_at"] = date('Y-m-d H:i:s');
        $data["topic"] = "audio_added";
        $data["payload"] = $payload;
        Redis::publish('wave', json_encode(array(['id' => $audioInfo->id])));
        Redis::rpush('queue:audio_add', json_encode(array(['identifier' => $audioInfo->id, 'audio_path'=>$audioPath])));


        //\App\KafkaProducer::produce("audio_added", json_encode($data));


        // $client = new Client();
        // //   $request = \Illuminate\Http\Request::create('http://127.0.0.1:5000/insert', 'POST', ['audio' => $file, 'name' => 'newmusic']);
        // $port = env('FLASK_PORT', '8090');
        // $url = "http://127.0.0.1:" . $port . "/insert";

        // $response = $client->request('POST', $url, [
        //     'multipart' => [

        //         [
        //             'name' => 'audio',
        //             'contents' => fopen(public_path() . '/audio/' . $audioName, 'r')
        //         ],
        //         [
        //             'name' => 'name',
        //             'contents' => $audioInfo->id
        //         ],
        //     ]
        // ]);
        // $data = $response->getBody();
        // if (json_decode($data, true)['message'] == 'already_uploaded') {
        //     try {
        //         unlink(public_path() . '/audio/' . $audioName);
        //         $audioInfo->delete();
        //     } catch (\Exception $e) {
        //         return redirect()->back(compact($message));
        //     }
        //     $message = 'The song is already uploaded. Please upload new song';
        //     return redirect()->back()->with('error', $message);
        // } else {
        //     return redirect('/campaign/dashboard');
        // }

        // reset session
        Session::forget('new_campaign_package');

        return redirect('/campaign/dashboard');


        // return view('DjManager.campaign_overview',compact('currentUser'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\musicCampaignAudio $musicCampaignAudio
     * @return \Illuminate\Http\Response
     */
    public function show(MusicCampaignAudio $musicCampaignAudio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\musicCampaignAudio $musicCampaignAudio
     * @return \Illuminate\Http\Response
     */
    public function edit(MusicCampaignAudio $musicCampaignAudio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\musicCampaignAudio $musicCampaignAudio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MusicCampaignAudio $musicCampaignAudio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\musicCampaignAudio $musicCampaignAudio
     * @return \Illuminate\Http\Response
     */
    public function destroy(MusicCampaignAudio $musicCampaignAudio)
    {
        //
        $musicaudio = MusicCampaignAudio::find($musicCampaignAudio)->first();
        if ($musicaudio) {
            $musicaudio->delete();
        }
    }

    public function download(MusicCampaignAudio $mca)
    {
        $user = Auth::user();
        $dj = $user->dj()->first();
        $campaigns = AcceptedCampaign::where('dj_id', $dj->id)
            ->where('campaign_id', $mca->campaign_id)
            ->first();
        $campaigns->downloaded = 1;
        $campaigns->save();

        try {
            $campaign=MusicCampaign::find($mca->campaign_id);
            $campaignUser = User::find($campaign->user_id);

            if ($campaignUser != null) {
                if ($campaignUser->token != null) {
                    $responseObj = [
                        'userId' => $campaignUser->id,
                        'source' => 'song_downloaded',
//                    'manager' => $manager->id
                    ];

                    $message=[

                            'html'=>'<li><a class="dropdown-menu-notifications-item" href="/music/download" data-id="205161"><span class="dropdown-menu-notifications-item-content"><span class="fa fa-credit-card-alt"></span> <span><p>Music</p><p>Downloaded your music titled</p></span></span><span class="dropdown-menu-notifications-item-ago"></span></a></li>'
                        ];

                        $data = array('reference_id' => $campaignUser->id,"is_shown"=>"0",'user_id'=>Auth::user()->id, 'subject'=>'Music','message' => 'Downloaded your music', 'href' => '', 'type' => 'new-message', 'seen' => 0);

                        \App\Helpers\Notification::send(2,$data,$message);

                }
            }
        }
        catch (\Exception $e)
        {
            Log::error($e);
        }

        $path = "audio/" . $mca->audio;
        $headers = ['Content-Type: application/mp3'];
        $fileName = preg_replace("/\/|\\\\/m", " ", $mca->song_title);
        return response()->download($path, $fileName . ".mp3", $headers)->deleteFileAfterSend(false);
    }

    public function updateYoutubeEmbaded(Request $request)
    {
        $user = Auth::user();

        if (Session::has('new_campaign_id')) {
            $campaignId = Session::get('new_campaign_id');
            $campaign = MusicCampaign::find($campaignId);
        } else {
            $campaign = MusicCampaign::where('user_id', $user->id)->first();
        }

        $campaignAudio = $campaign->musicCampaignAudio()->first();

        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $request->youtube, $match);


        if (!isset($match[1])) {
            //return redirect()->back()->withError('Invalid Youtube URL');
            return response()->json(['status' => 'fail', 'msg' => 'Invalid Youtube URL'], 200);
        }

        $campaignAudio->youtube_feature = $request->youtube;
        $campaignAudio->save();
        return response()->json(['status' => 'success', 'youtube_feature' => $request->youtube, 'campaignID' => $campaign->id, 'youtube_url' => $match[1]], 200);
        //return redirect()->back();
    }

    public function updateInstagram(Request $request)
    {
        $user = Auth::user();

        if (Session::has('new_campaign_id')) {
            $campaignId = Session::get('new_campaign_id');
            $campaign = MusicCampaign::find($campaignId);
        } else {
            $campaign = MusicCampaign::where('user_id', $user->id)->first();
        }

        $campaignAudio = $campaign->musicCampaignAudio()->first();

        $campaignAudio->instagram = $request->instagram;
        $campaignAudio->save();
        return redirect()->back();
    }

    public function updateFacebook(Request $request)
    {
        $user = Auth::user();

        if (Session::has('new_campaign_id')) {
            $campaignId = Session::get('new_campaign_id');
            $campaign = MusicCampaign::find($campaignId);
        } else {
            $campaign = MusicCampaign::where('user_id', $user->id)->first();
        }

        $campaignAudio = $campaign->musicCampaignAudio()->first();

        $campaignAudio->facebook = $request->facebook;
        $campaignAudio->save();
        return redirect()->back();
    }

    public function addMusicToFingerprint(MusicCampaignAudio $musicCampaignAudio)
    {
        $client = new Client();
        //   $request = \Illuminate\Http\Request::create('http://127.0.0.1:5000/insert', 'POST', ['audio' => $file, 'name' => 'newmusic']);
        $port = env('FLASK_PORT', '5000');
        $url = "http://localhost:" . $port . "/insert";
	Log::error($url);
	Log::error(public_path() . '/audio/' . $musicCampaignAudio->audio);

        $response = $client->request('POST', $url, [
            'multipart' => [

                [
                    'name' => 'audio',
                    'contents' => fopen(public_path() . '/audio/' . $musicCampaignAudio->audio, 'r')
                ],
                [
                    'name' => 'name',
                    'contents' => $musicCampaignAudio->id
                ],
            ]
        ]);
        $data = $response->getBody();
        return $data;
    }

    public function addMusicToFingerprintForPklz(MusicCampaignAudio $musicCampaignAudio)
    {
        $client = new Client();
        //   $request = \Illuminate\Http\Request::create('http://127.0.0.1:5000/insert', 'POST', ['audio' => $file, 'name' => 'newmusic']);
        $port = '8090';
        $url = "http://127.0.0.1:" . $port . "/insert";

        $response = $client->request('POST', $url, [
            'multipart' => [

                [
                    'name' => 'audio',
                    'contents' => fopen(public_path() . '/audio/' . $musicCampaignAudio->audio, 'r')
                ],
                [
                    'name' => 'name',
                    'contents' => $musicCampaignAudio->id
                ],
            ]
        ]);
        $data = $response->getBody();
        return $data;
    }


    public function createPklz(Request $request)
    {
        $all_audios=MusicCampaignAudio::all();
        $data=array();
        foreach ($all_audios as $audio){
            array_push($data,$this->addMusicToFingerprintForPklz($audio));
            sleep(300);
        }
        return $data;
    }

    public function generatewavform(Request $request){
        $all_audios=MusicCampaignAudio::orderby('id','desc')
            ->select('id', 'audio')
            ->paginate(9);

        foreach($all_audios as $audio){
//            $command = 'ffmpeg -i '.public_path().'/audio/"'.$audio->audio .'" -filter_complex "compand,aformat=channel_layouts=mono,showwavespic=s=380x80:colors=white" -frames:v 1 '.public_path().'/wavs/'.$audio->id.'.png -y';
            $command = '~/buffycode_waveform -i "'.public_path().'/audio/'.$audio->audio .'" -o '.public_path().'/wavs/'.$audio->id.'.json'. ' -e 200 -w 166 -h 100';
            error_log($command);
           shell_exec($command);
        }
        return $all_audios;

    }

    public function deleteSocialLink(Request $request) {
        $campaignId = $request->campaing_id;
        $key = $request->key;
        $campaign = MusicCampaign::find($campaignId);

        $campaignAudio = $campaign->musicCampaignAudio()->first();
        if($request->key == "youtube") {
            $campaignAudio->youtube_feature = '';
        } elseif ($request->key == "instagram") {
            $campaignAudio->instagram = '';
        } else {
            $campaignAudio->facebook = '';
        }
        $campaignAudio->save();
        return response()->json(['success' => 'success'], 200);
    }
}

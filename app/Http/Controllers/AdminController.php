<?php

namespace App\Http\Controllers;

use App\Helpers\PushNotification;
use App\Http\Middleware\RegionAdmin;
use App\IdentifiedMusic;
use App\IdentifiedMusicAll;
use App\Traits\IdentifiedMusicTrait;
use App\User;
use App\WithdrawalRequest;
use Illuminate\Http\Request;
use App\Deposit;
use App\Dj;
use DB;
use Auth;
use App\Dj_Music;
use App\KafkaProducer;
use App\Helpers\notification_app;

class AdminController extends Controller
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


    public function inbox()
    {

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



    public function verifyClubs(){

    }

    public function seePayments(){
        $deposits = Deposit::all();
        // return $deposits;
        return view('payment.campaign',compact('deposits'));
    }

   public  function compose()
  {
      $currentUser = auth()->user();
      $djs = $currentUser->djs;

            $user = DB::table('users')->get();

        $genrs=DB::table('dj__musics')
            ->select('music_types.name as genrs','dj__musics.dj_id')
            ->leftJoin('music_types','music_types.id','=','dj__musics.music_type')
            ->get();


      return view('admin.message_compose', compact('currentUser', 'user','genrs'));
  }
        public function sendMessage(Request $request)
      {


       if($request->djs!=="" && isset($request->djs))
       {


                foreach (json_decode($request->djs) as $value) {
                    $data=array(
                      'sender_id' =>Auth::user()->id,
                      'receiver_id' => $value,
                      'message' =>$request->message,
                      'status' =>0,
                      );

                    DB::table('chat_history')->insert($data);
                    $sender=DB::table('users')
                          ->select('users.email','djs.dj_name')
                          ->join('djs','djs.user_id','=','users.id')
                          ->where('djs.id',$value)->first();

                    $receiver=User::find($value);

                    if($receiver!=null) {
                        if ($receiver->token != null) {
                            $responseObj = [
                                'userId' => $receiver->id,
                                'source'=> 'message'
//                    'manager' => $manager->id
                            ];

                            $message=[

                                'html'=>'<li><a class="dropdown-menu-notifications-item" href="/admin/send/message" data-id="205161"><span class="dropdown-menu-notifications-item-content"><span class="fa fa-credit-card-alt"></span> <span><p>Message</p><p>You Have Received A Message</p></span></span><span class="dropdown-menu-notifications-item-ago"></span></a></li>'
                            ];

                            $data=['user_id' =>Auth::id(), 'reference_id' =>$receiver->id,'subject' =>'Message','message'=>'You have received a message','href'   => '','seen' => 0,'is_shown' => 0, 'type' => 'admin',"created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s'),
                            ];

                            \App\Helpers\Notification::send(2,$data,$message);

                        }
                    }

                //           $result = Mail::send('email.message', ['name' => $sender->dj_name, 'body' => $request->message], function ($message) use ($sender) {
                // $message->to($sender->email, 'DJ')->subject('SpinStatz DJ Message');
            // });
                }


       }
       else
       {

                    $chat_data=array(
                      'sender_id' =>Auth::user()->id,
                      'receiver_id' => $request->recever_id,
                      'message' =>$request->message,
                      'status' =>0,
                      );



           $receiver=User::find($request->recever_id);

           if($receiver!=null) {
               if ($receiver->token != null) {
                   $responseObj = [
                       'userId' => $receiver->id,
                       'source'=>'message'
//                    'manager' => $manager->id
                   ];

                $message=[

                        'html'=>'<li><a class="dropdown-menu-notifications-item" href="/admin/send/message" data-id="205161"><span class="dropdown-menu-notifications-item-content"><span class="fa fa-credit-card-alt"></span> <span><p>Message</p><p>You Have Received A Message</p></span></span><span class="dropdown-menu-notifications-item-ago"></span></a></li>'
                    ];

                  $data=['user_id' =>Auth::id(), 'reference_id' =>$receiver->id,'subject' =>'Message','message'=>'You have received a message','href'   => '','seen' => 0,'is_shown' => 0, 'type' => 'admin',"created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s'),
                            ];

                  \App\Helpers\Notification::send(2,$data,$message);

               }
           }


                    DB::table('chat_history')->insert($chat_data);
                    $sender=DB::table('users')
                          ->select('users.email','djs.dj_name')
                          ->join('djs','djs.user_id','=','users.id')
                          ->where('djs.id',$request->recever_id)->first();
            //     $result = Mail::send('email.message', ['name' => $sender->dj_name, 'body' => $request->message], function ($message) use ($sender) {
            //     $message->to($sender->email, 'DJ')->subject('SpinStatz DJ Message');
            // });
       }



        return redirect()->route('admin.message')->with('message', "Message successfully Sent");
      }


      public function message()
      {



        $inbox=DB::table('chat_history')
        ->select('users.username','chat_history.*')
        ->join('users','users.id','=','chat_history.receiver_id')
        ->whereSender_id(Auth::user()->id)->get();

        return view('admin.inbox',compact('inbox'));
      }
      public function removeMessage(Request $request)
      {
            if(!empty($request->messageIds))
            {
                DB::table('chat_history')->whereIn('id',$request->messageIds)->delete();
                return redirect()->route('admin.message')->with('message', "Message successfully Deleted");
            }
            else
            {
                return redirect()->route('admin.message')->with('message', "Please Select The message");
            }


      }

      public function getdownloadstat(){
        $djs = \App\Dj::orderBy('downloaded','desc')->paginate(30);
        return view('admin.downloadstat',compact('djs'));
      }

      public function actions(Request $request){
        $djs = \App\Dj::orderBy('dj_name','asc')->get();
        $managers = \App\DjManager::all();
        $genres = \App\MusicType::all();
        return view('admin.actions',compact('djs','managers','genres'));

      }

      public function updateManager(Request $request){
         $dj = \App\Dj::find($request->djid);
         $dj->invited_by = $request->manid;
         $dj->save();
         return redirect()->back()->withMessage("changed");
      }

      public function getGenres($dj){
        $genres = Dj_Music::where('dj_id',$dj)
                  ->select('music_type')
                  ->get();
        return $genres;
      }

      public function setGenres(Request $request){
        $dj = $request->dj_update_genre;
        Dj_Music::where('dj_id',$dj)->delete();

        $genres = $request->genre;
        foreach ($genres as $genre) {
          $gen = new Dj_Music();
          $gen->dj_id = $dj;
          $gen->music_type = $genre;
          $gen->save();
        }

        return redirect()->back()->withMessage("updated");
      }

      public function managemissing(Request $request){
        /*
          select distinct * from `music_campaign_audios` LEFT join `identified_musics` on `music_id` = `music_campaign_audios`.`id` WHERE identified_musics.id is null
        */
        if($request->all == "t"){
            $campaignAudios = \App\MusicCampaignAudio::select('music_campaign_audios.id','song_title')
                            ->get();
        }else{

        $campaignAudios = \App\MusicCampaignAudio::leftjoin('identified_musics','music_id','music_campaign_audios.id')
                            ->where('identified_musics.id',null)
                            ->select('music_campaign_audios.id','song_title')
                            ->get();
        }
        //return $campaignAudio;
        return view('admin.managemissing',compact('campaignAudios'));
      }

      public function manageEvents(Request $request){

      }

      public function getEvents(Request $request, Dj $dj){
        return $dj->events()->where('dj_events.status','!=','complete')->get();
      }

      public function showmanualspinindex(){
        return view('admin.actions2');
      }

      public function producespinmessage(Request $request){
        $message = $request->message;
        //$result = json_decode($message);
        $messages = explode("\n", $message);

        foreach($messages as $m){
          if($this->json_validate($m)){
            $data = json_decode($m);
            $topic = $data->topic;
            KafkaProducer::produce($topic,json_encode($data));

          }
        }

          return redirect()->back()->withMessage('produced');
      }

      public function json_validate($string){
    // decode the JSON data
    $result = json_decode($string);

    // switch and check possible JSON errors
    switch (json_last_error()) {
        case JSON_ERROR_NONE:
            return true;

        // case JSON_ERROR_DEPTH:
        //     $error = 'The maximum stack depth has been exceeded.';
        //     break;
        // case JSON_ERROR_STATE_MISMATCH:
        //     $error = 'Invalid or malformed JSON.';
        //     break;
        // case JSON_ERROR_CTRL_CHAR:
        //     $error = 'Control character error, possibly incorrectly encoded.';
        //     break;
        // case JSON_ERROR_SYNTAX:
        //     $error = 'Syntax error, malformed JSON.';
        //     break;
        // // PHP >= 5.3.3
        // case JSON_ERROR_UTF8:
        //     $error = 'Malformed UTF-8 characters, possibly incorrectly encoded.';
        //     break;
        // // PHP >= 5.5.0
        // case JSON_ERROR_RECURSION:
        //     $error = 'One or more recursive references in the value to be encoded.';
        //     break;
        // // PHP >= 5.5.0
        // case JSON_ERROR_INF_OR_NAN:
        //     $error = 'One or more NAN or INF values in the value to be encoded.';
        //     break;
        // case JSON_ERROR_UNSUPPORTED_TYPE:
        //     $error = 'A value of a type that cannot be encoded was given.';
        //     break;
        default:
            $error = 'Unknown JSON error occured.';
            return false;
    }

    return false;

    if ($error !== '') {
        // throw the Exception or exit // or whatever :)
        exit($error);
    }

    // everything is OK
    return $result;
}

function read_notification() {
    $user = Auth::user();
    $count = DB::table('notifications')->where('reference_id', $user->id)
            ->update(['seen' => 1]);
}
function read_signle_notification() {
    $user = Auth::user();
    $id['id']=$_POST['id'];
    $count = DB::table('notifications')->where('id', $id['id'])
            ->update(['is_shown' => 1]);
}

    public function regionAdmin(){
            $regionAdmins = \App\RegionAdmin::all();
            return view('v2.admin.regionadmin',compact('regionAdmins'));
    }

    public function preview(Request $request, $withdrawlid){


        $withdraw_request = WithdrawalRequest::find($withdrawlid);
        $dj = Dj::find($withdraw_request->dj_id);
        $dj_user_id = $dj->user_id;
        $paid_videos = IdentifiedMusic::where("payments_records->wr_id", (int)$withdrawlid)
                                ->where('dj_id', $dj_user_id)
                                ->paginate(30);

//        return $paid_videos;
        $withdraw_request->payable_amount = IdentifiedMusic::where("payments_records->wr_id", (int)$withdrawlid)
            ->where('dj_id', $dj_user_id)
            ->where("payments_records->status", IdentifiedMusic::accepted)
            ->sum('payments_records->dj_earned_points');

        return view('admin.previewvideos', compact('paid_videos', 'withdraw_request', 'dj'));
    }

}

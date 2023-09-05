<?php

namespace App\Http\Controllers;

use App\Helpers\Notification;
use App\Message;
use App\Dj;
use App\Helpers\UserHelper;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Log;
use function foo\func;

class MessageController extends Controller
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

        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);

        $sender = $request->sender;
        $receiver = $request->receiver;
        $text = $request->message;
        $message = new Message();
        $message->receiver_id = $receiver;
        $message->sender_id = $sender;
        $message->text = $text;
        $message->save();

        $message = $message->toArray();
        $sender_user = User::find($sender);
        $message['sender_profile_pic'] = env('APP_URL').$sender_user->profile_picture;
        if($sender_user->role == 'dj'){
            $dj = $sender_user->dj()->first();
            $message["name"] = $dj->dj_name;
        }else if($sender_user->role == 'campaign'){
            $campaign = $user->musicCampaign()->first();
            $message["name"] = $campaign->first_name. " " . $campaign->last_name;
        }
        event(new \App\Events\GenericEvent("message-received", $receiver, $message));
        event(new \App\Events\GenericEvent("message-sent", $sender, $message));
        Notification::publishMessage(
            "api",
            "message_received",
            ["push"],
            $receiver,
            $user->get_aggregrated_un() . ': '. $text,
            "",
            "/img/user-1-profile.jpg",
            array(
                "userid"=> $sender,
		        "refreshFunc"=> "",
		        "type"=> "message_sent",
                "avatar"=> $sender_user->getProfilePicture(),
                "name"=> $sender_user->get_aggregrated_un(),
            )
        );
        return response()->json(['status' => "ok", "message"=>$message], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }

    public function getConversation(Request $request)
    {

        $sender = $request->user_1;
        $receiver = $request->user_2;

        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);


        if ($user->id != $sender) {
            //return "";
        }

        $messages = Message::whereIn('sender_id', [$sender, $receiver])
            ->whereIn('receiver_id', [$sender, $receiver])
            ->where(function ($query) use ($user) {
                $query->where('delete_for', '!=', $user->id)
                    ->orWhereNull('delete_for');
            })->orderBy('id', 'desc')
            ->get();

        $messages->transform(function ($item) {
            $new_item = new \stdClass;
            $new_item_user = new \stdClass;

            $dj = Dj::where('user_id', $item->sender->id)->first();

            $new_item_user->_id = $item->sender->id;
            $new_item_user->name = is_null($dj) ? $item->sender->username : $dj->dj_name;
            $new_item_user->avatar = url($item->sender->profile_picture);


            $new_item->_id = $item->id;
            $new_item->text = $item->text;
            $new_item->createdAt = $item->created_at->toDateTimeString();
            $new_item->user = $new_item_user;

            return $new_item;
        });

        return $messages->paginate(20);
    }

    public function getAllConversation(Request $request)
    {

        $currentUser = $request->user;

        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);

        if ($user->id != $currentUser) {
            return response()->json(['message'=>"no permission"]);
        }

        $a = collect(\DB::select('SELECT * FROM 
            (
                SELECT id, receiver_id as uid, created_at, text FROM `messages` WHERE messages.sender_id = ? and ( messages.delete_for != ? or messages.delete_for is null )
                UNION 
                SELECT id, sender_id as uid, created_at, text FROM `messages` WHERE messages.receiver_id = ? and ( messages.delete_for != ? or messages.delete_for is null )
                order by id DESC 
            ) m group by uid order by created_at desc', [$currentUser, $currentUser, $currentUser, $currentUser]))->paginate(20);


        $a->transform(function ($item) use ($currentUser) {
            $new_item = new \stdClass;
            $new_item_user = new \stdClass;
            $item = Message::find($item->id);

            $primaryUser = $item->sender->id == $currentUser ?  $item->sender : $item->receiver;
            $secondaryUser = $item->sender->id == $currentUser ?  $item->receiver : $item->sender;


            $dj = Dj::where('user_id', $secondaryUser->id)->first();

            $new_item_user->_id = $secondaryUser->id;
            $new_item_user->name = is_null($dj) ? $secondaryUser->username : $dj->dj_name;
            $new_item_user->avatar = url($secondaryUser->profile_picture);


            $new_item->id = $secondaryUser->id;
            $new_item->_id = $primaryUser->id;
            $new_item->text = $item->text;
            $new_item->createdAt = $item->created_at->toDateTimeString();
            $new_item->user = $new_item_user;
            $new_item->unseen_message_cnt = Message::where('sender_id', $secondaryUser->id)
                ->where('receiver_id', $primaryUser->id)
                ->where('seen_by_receiver', 0)
                ->count();
            // $new_item->unseen_message = Message::where('sender_id', $secondaryUser->id)
            //                         ->where('receiver_id', $primaryUser->id)
            //                         ->where('seen_by_receiver', 0)
            //                         ->toSql();
            // $new_item->values = $secondaryUser->id . ":" . $primaryUser->id;
            return $new_item;
        });
        return $a;
    }

    public function deleteMesssage(Message $message)
    {
        $user = UserHelper::get_current_user();

        if ($message->receiver->id == $user->id || $message->sender->id == $user->id) {

            if ($message->delete_for == null) {
                $message->delete_for = $user->id;
                $message->save();
                return response()->json("success", 200);
            } else if ($message->delete_for != $user->id) {
                $message->delete();
                return response()->json("success", 200);
            }
        }
        return response()->json("success", 404);
    }

    public function deleteAllMesssage(User $partner)
    {
        $user = UserHelper::get_current_user();

        $messages = Message::where('sender_id', $user->id)
            ->orWhere('receiver_id', $user->id)->get();


        foreach ($messages as $message) {

            if ($message->receiver->id == $user->id || $message->sender->id == $user->id) {

                if ($message->delete_for == null) {
                    $message->delete_for = $user->id;
                    $message->save();
                } else if ($message->delete_for != $user->id) {
                    $message->delete();
                }
            }
        }
        return response()->json("success", 200);
    }


    public function markasseen(User $sender)
    {
        $receiver = UserHelper::get_current_user();


        $messageTable = (new Message())->getTable();
        \DB::table($messageTable)
            ->where('sender_id', $sender->id)
            ->where('receiver_id', $receiver->id)
            ->update(array('seen_by_receiver' => 1));

        return response()->json(["status" => "success"], 200);
    }

    public function getMyConversations(User $user){
        $me_id = Auth::id();

        $messages = Message::where(function($query) use ($user, $me_id) {
            $query->where('sender_id', $user->id)
                ->where('receiver_id', $me_id);
        })->orWhere(function($query) use ($user, $me_id) {
            $query->where('receiver_id', $user->id)
                ->where('sender_id', $me_id);
        })->where(function($query) use ($user, $me_id) {
            $query->where('delete_for', '!=', $me_id)
                ->orWhere('delete_for', null);
        })->orderBy('id','desc')
            ->paginate(10);

        return response()->json(['message'=>$messages, 'picture'=>array($me_id=>env('APP_URL') .Auth::user()->profile_picture, $user->id=>env('APP_URL') .$user->profile_picture)]);
    }
}

<?php

namespace App\Helpers;

use Pusher;
use Illuminate\Support\Facades\Redis;
use App\User;
use Carbon\Carbon;

class Notification {

	public static function sendNotification($userId,$message)
	    {
			//p([$userId,$message]);
	        $app_id = '1071642';
	        $app_key = '9dcc804a5a7a2192db27';
	        $app_secret = '03fff1f5ce4e70dab310';
	        $app_cluster = 'mt1';
	        $pusher = new Pusher\Pusher( $app_key, $app_secret, $app_id, array('cluster' => $app_cluster) );

	        $pusher->trigger( 'user_'.$userId, 'nofication', $message );

		}

	public static function send($type,$data,$message){
		if($type==1){
			//send email
		}else if($type==2){
			//send push

			self::sendNotification($data['reference_id'],$message);
		}else if($type==3){
			//send email

			//send push
			self::sendNotification($data['reference_id'],$message);
		}
		\App\Notification::insert($data);
	}

	public static function generateMessage($type, $data){
		if($type == "message_sent"){
			$u = User::find($data['sender_id']);

		}
	}

	public static function publishMessage($source_app_id, $type, $destination, $user_id, $message, $route, $image, $data, $emaildata=null){
        Redis::publish('mychannel', json_encode([
                'source_app_id' => $source_app_id,
                'created_at' =>  Carbon::now()->toIso8601String(), #now timestamp
                'type' => $type,  #subject for push, email ....
                'destination' => $destination,
                'user_id'=>$user_id,
                'message'=>$message,
                'href' => $route,

                'reference_id' => $user_id,
                'image' => $image,
                'one_signal_token'=> User::find($user_id)->token,
                'data'=>$data,
				'email_data'=>$emaildata
            ])
        );
    }

}


?>

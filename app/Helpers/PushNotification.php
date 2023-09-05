<?php

namespace App\Helpers;

use phpDocumentor\Reflection\Types\Array_;





/*
 * campaign_balance_low
new_music_added
song_downloaded
message
added_money
payment_withdraw
payment_failed
advertisement_created
advertisement_request
advertisement_request_approved
advertisement_request_rejected
dj_joined_campaign
dj_left_campaign
song_played
campaign_created
dj_payment_request
event_created
payment_rejected*/

class PushNotification {

    public static function sendToAUser($token, $dataObj, $message){
        try {
            \OneSignal::sendNotificationToUser(
                $message,
                $token,
                $url = null,
                $data = $dataObj,
                $buttons = null,
                $schedule = null
            );
        }
        catch (\Exception $e)
        {

        }
    }

    public static function sendToTag($tag, $dataObj, $message){

            \OneSignal::sendNotificationUsingTags(
                $message,
                array(["field"=>"tag","key" => "group", "relation" => "=", "value" => $tag]),
                $url = null,
                $data = $dataObj,
                $buttons = null,
                $schedule = null
            );

    }

    public static function sendToAll($dataObj, $message){
        try{
        \OneSignal::async()->sendNotificationToAll(
            $message,
            $url = null,
            $data = $dataObj

        );   }
        catch (\Exception $e)
        {

        }

    }

    public static function sendToDj($segment, $data){
        try {
            \OneSignal::async()->sendNotificationToSegment("Some Message",
                $segment,
                $url = null,
                $data = null
            );
        }
        catch (\Exception $e)
        {

        }
    }


    public static function editUser($id, $tag){
        try{
        $array=array(
            'id'=>$id,
            'tags'=> array(
                'group'=> $tag
            )
        );

        \OneSignal::editPlayer($array);
        }
        catch (\Exception $e)
        {

        }
    }
}

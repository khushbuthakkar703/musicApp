<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class KafkaMessage extends Model
{
    public static function getUnmatched($dj_id, $date_after, $date_before) {
        $user = Auth::user();
    	$model = KafkaMessage::where("message->match","no_match")
    			->when($dj_id != -1 && $dj_id != null, function($query) use ($dj_id) {
    				return $query->where("message->payload->user_id",$dj_id);
    			})
                ->when($user->role == "djmanager" , function($query) use ($user) {
                    return $query->whereIn("message->payload->user_id",$user->manager->first()->djs()->pluck('user_id')->all());
                })->when($user->role == "dj" , function($query) use ($user) {
                    return $query->where("message->payload->user_id",$user->id);
                 })

    			->when($date_before != null , function($query) use ($date_before) {
    				//return $query->where("message->payload->played_timestamp","<",strtotime($date_before));
    				error_log("db not null");
    				return $query->where("created_at","<=", $date_before);
    			})
    			->when($date_after != null , function($query) use ($date_after) {
    				error_log("da not null");
    				return $query->where("created_at",">=", $date_after);
    			})
    			->first();
    	//dd($model);
    	//dd($user->manager->first()->djs()->pluck('user_id')->all());
    	return $model;

    }

    public static function getDjs(){
        return KafkaMessage::where("message->match","no_match")
            ->join('djs','user_id','kafka_messages.message->payload->user_id')
            ->select('djs.dj_name','djs.user_id')
            ->distinct()
            ->get();

    }

    public static function getMatchesToReview(){
        return KafkaMessage::where("message->pending_verification",true)
            ->where("message->match","!=",0)
            ->orderBy("message->match")
            ->first();
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DesktopVideoInfo extends Model
{
    //
    public function dj(){
    	return $this->belongsTo('App\User','user_id')->first();
    }

    public function manager(){
    	return $this->dj()->dj()->first()->djManager()->first();
	}
}

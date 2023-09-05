<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AcceptedCampaign extends Model
{
    //
    public function campaign(){
    	return $this->belongsTo('App\MusicCampaign');
    }

    public function dj(){
    	return $this->belongsTo('App\Dj');
    }
}

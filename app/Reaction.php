<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    //
    public function dj(){
        return $this->belongsTo('App\Dj');
    }

    public function campaign(){
        return $this->belongsTo('App\MusicCampaign');
    }
}

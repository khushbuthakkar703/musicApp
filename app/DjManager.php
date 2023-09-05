<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DjManager extends Model
{


    public function djs()
    {
        return $this->hasMany('App\Dj','invited_by','user_id');
    }

     public function city()
    {
        return $this->belongsTo('App\City','city');
    }

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
}

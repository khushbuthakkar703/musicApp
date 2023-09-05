<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    //
    public function dj(){
    	
    }

    public function city(){
        return $this->belongsTo('App\City','city');
    }
}

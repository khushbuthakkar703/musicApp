<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArtistManager extends Model
{
    //
    public function user(){
    	return $this->belongsTo('App\User','user_id');
    }

    public function getMyCampaignUsers(){

    	return \App\User::whereIn('id',json_decode($this->campaign_ids,true))
    					->select('id','username','email','profile_picture')
    					->where('role','campaign')
    					->get();
    }
}

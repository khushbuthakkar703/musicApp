<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IdentifiedMusic extends Model
{
    //
    const denied = 3;
    const accepted = 2;
    const withdraw_requested = 1;
    const no_action = 0;

    protected $casts = [
        'payments_records' => 'array'
    ];

    public function dj(){
    	return $this->belongsTo('App\User')->first();
    }

    public function manager(){
    	return $this->dj()->dj()->first()->djManager()->first();
	}

	public function MusicCampaignAudio(){
        return $this->belongsTo('App\MusicCampaignAudio', 'music_id');
    }

}
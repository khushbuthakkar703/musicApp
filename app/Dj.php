<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dj extends Model
{
    //
    protected $fillable = ['first_name', 'last_name', 'dj_name', 'club_name', 'user_id', 'city', 'phone_number','software','invited_by','type','address','zipcode'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function djManager()
    {
        return $this->belongsTo('App\User', 'invited_by');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function clubs()
    {
        return $this->hasMany('App\Club','dj_id');
    }

    public function campaigns(){
        return $this->hasMany('App\AcceptedCampaign','dj_id');
    }

     public function city()
    {
        return $this->belongsTo('App\City','city');
    }

    public function events(){
        return $this->hasMany('App\DjEvents');
    }

    public function getStar(){
        return $this->total_spin/1000+1;
    }

    public function reaction(){
        return $this->hasMany('App\Reaction');
    }

    public function hasLiked(MusicCampaign $musicCampaign){
        return $this
            ->reaction()
            ->where('campaign_id',$musicCampaign->id)
            ->where('reaction', "=",1)
            ->count() != 0;
    }
    public function getLiked(){
        return $this
                ->reaction()
                ->where('reaction', "=",1)
                ->pluck('reactions.campaign_id');
    }
}

<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *`
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password','role','confirmation_code','token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function djs()
    {
        return $this->hasMany('App\Dj', 'invited_by');
    }

    public function dj()
    {
        return $this->hasMany('App\Dj');
    }

    public function manager()
    {
        return $this->hasMany('App\DjManager');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function musicCampaign()
    {
        return $this->hasOne('App\MusicCampaign');
    }

    public function verified(){
        $this->confirmed = 1;
        //$this->confirmation_code = '123';
        $this->save();
    }

    public function artistmanager(){
        return $this->hasOne('App\ArtistManager')->first();
    }

    public function musicCampaigns()
    {
        return $this->hasMany('App\MusicCampaign');
    }

    public function isKeyer()
    {
        return $this->iskeyer == 1;
    }

    public function isOnline(){
        return \Cache::has('user-is-online-' . $this->id);
    }

    public function regionAdmin()
    {
        return $this->hasMany('App\RegionAdmin');
    }

    public function get_aggregrated_un(){
        if ($this->role == "dj"){
            return $this->dj()->first()->dj_name;
        }elseif ($this->role == "campaign"){
            return $this->musicCampaign()->first()->campaign_name;
        }elseif ($this->role == "djmanager"){
            return $this->manager()->first()->company_name;
        }
    }

    public function getProfilePicture(){
        return env('APP_URL').$this->profile_picture;
    }

    public function get_unset_campaign(){
        $unset_campaign = $this->musicCampaign()->where('campaign_name',"")->first();
        if ($unset_campaign == null){
            $set_campaign = $this->musicCampaign()->where('campaign_name','!=',"")->first();

            $unset_campaign = new MusicCampaign();
            $unset_campaign->first_name = $set_campaign->first_name;
            $unset_campaign->user_id = $set_campaign->user_id;
            $unset_campaign->last_name = $set_campaign->last_name;
            $unset_campaign->email = $set_campaign->email;
            $unset_campaign->company_name = $set_campaign->company_name;
            $unset_campaign->city = $set_campaign->city;
            $unset_campaign->street = $set_campaign->street;
            $unset_campaign->zipcode = $set_campaign->zipcode;
            $unset_campaign->phone = $set_campaign->phone;
            $unset_campaign->target_country = "[]";
            $unset_campaign->target_state = "[]";
            $unset_campaign->target_city = "[]";
            $unset_campaign->target_colition = "[]";
            $unset_campaign->spin_rate = 0;
        }
        return $unset_campaign;
    }
}

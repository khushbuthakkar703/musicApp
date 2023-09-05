<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MusicCampaign extends Model
{
    //
    protected $fillable=['first_name','last_name','email','company_name','country','state','city','street','zipcode','phone','audio_path','artwork_path','amount','campaign_name','user_id', 'referid'];

    public function musicCampaignAudio()
   {
       return $this->hasMany('App\MusicCampaignAudio','campaign_id');
   }

   public function city(){
        return $this->belongsTo('App\City', 'city');
   }

   public function isEligible($id){

    $dj = Dj::find($id);
    if($this->spin_rate / 5 < $dj->getStar()){
        return false;
    }

   	if($this->target_country == null or $this->target_country  == '[]')
   		$country = null;
   	else
   		$country = json_decode($this->target_country);

   	if($this->target_state == null or $this->target_state  == '[]')
   		$state = null;
   	else
   		$state = json_decode($this->target_state);

   	if($this->target_city == null or $this->target_city  == '[]')
   		$city = null;
   	else
   		$city = json_decode($this->target_city);

	if($this->target_colition == null or $this->target_colition  == '[]')
   		$colition = null;
   	else
   		$colition = json_decode($this->target_colition);

  

    if($dj->type == 'mobile'){
      $event = \App\DjEvents::where('dj_id', $dj->id)
                ->where('dj_events.status','approved')->first();
      //dd($event);

      if($event != null){
        $djCity = $event->city()->first();
        $djState = $djCity->state()->first();
        $djCountry = $djState->country()->first();

      }else{
        return false;
      }

    }else{
      $djCity = $dj->city()->first();
      $djState = $djCity->state()->first();
      $djCountry = $djState->country()->first();
    }
    
   	

   	/*replaceble by decision tree*/
   	/*for multiple city option implementation try djstate in state array*/
    if($country==null || sizeof($country)==0)
    {
        return true;
    }
    else {

        for ($i = 0; $i < sizeof($country);$i++) {
            if ($city[$i] == 0 || $djCity->id == $city[$i]) {
                if ($state[$i] == 0 || $djState->id == $state[$i]) {
                    if ($country[$i] == 0 || $djCountry->id == $country[$i]) {
                        if ($colition[$i] == 0 || $colition == $dj->invited_by[$i]) {
                            return true;
                        }
                    }
                }
            }
        }
    }

   	return false;
   }

   public function getAllMusic(){
      return MusicCampaign::join('music_campaign_audios','music_campaigns.id','music_campaign_audios.campaign_id');
   }

   public function getRegion(){
       $ra = $this->city()->first()->state()->first()->country()->first()->regionAdmin()->first();
       if($ra == null){
           return "global";
       } else if($ra->id == 1){
           return "europe";
       }
       return "global";
   }
}

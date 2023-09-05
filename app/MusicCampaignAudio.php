<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MusicCampaignAudio extends Model
{
    //
    protected $fillable = ['campaign_id','audio','company_name','artist_website','song_title','artwork','release_date','isrc','upc','genre','artist_name'];

    public function musicCampaign(){
       return $this->belongsTo('App\MusicCampaign','campaign_id');
   }

   public function getTitle(){
        return $this->song_title;
   }
}

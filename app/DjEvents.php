<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DjEvents extends Model
{
    //
    protected $fillable = ['name', 'city_id', 'address','estimated_attendance','start_time','end_time','contact_name','contact_number','website_url','dj_id'];

    public function city()
    {
        return $this->belongsTo('App\City');
    }

    public function dj(){
    	return $this->belongsTo('App\Dj');
    }
}

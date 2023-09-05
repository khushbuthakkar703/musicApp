<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegionAdmin extends Model
{
    public $fillable = ['name','phone_number'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function countries()
    {
        return $this->hasMany('App\Country','region_admin');
    }



}

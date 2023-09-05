<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VCS extends Model
{
    //
    protected $casts = [
        'update' => 'boolean',
    ];
    public static function should_update($app_type, $current_version, $platform){

        $vcs_data = VCS::where('app_type',$app_type)
            ->where('current_version', $current_version)
            ->where('platform', $platform)
            ->first();

        if($vcs_data == null){
            return true;
        }
        return $vcs_data->update;
    }
}

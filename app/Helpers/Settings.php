<?php


namespace App\Helpers;


class Settings{
    public static function get_dj_spin_rate($dj_star, $spin_rate){
        global $dj_spin_rate;
        if($dj_spin_rate == null){
            $dj_spin_rate = json_decode(\App\Setting::where('field', 'dj_spinrate')->first()->value, true);
        }
        try {
            return $dj_spin_rate[$dj_star][$spin_rate]/2;
        }catch (\Exception $exception){
            if ($spin_rate < 5){
                return $spin_rate/2;
            }
            return 0;
        }

    }
}

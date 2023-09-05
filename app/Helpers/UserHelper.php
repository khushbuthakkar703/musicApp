<?php

namespace App\Helpers;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Exception;


class UserHelper {
    public static function get_current_user(){
        try{
            $user = Auth::user();
            if($user == null){
                $token = JWTAuth::getToken();
                $user = JWTAuth::toUser($token);
            }

            return $user;
        }catch(Exception $e){
            error_log($e);
            return null;

        }
    }
}
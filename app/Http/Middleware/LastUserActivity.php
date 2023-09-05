<?php

namespace App\Http\Middleware;

use Cassandra\Date;
use Closure;
use Auth;
use Cache;
use Carbon\Carbon;
use mysql_xdevapi\Exception;
use Tymon\JWTAuth\Facades\JWTAuth;

class LastUserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        try {
            $currentUser = JWTAuth::toUser(JWTAuth::getToken());
        }catch(\Exception $e){
            $currentUser =null;
        }

        if($currentUser){

            $expiresAt = Carbon::now()->addMinutes(1);
            Cache::put('user-is-online-' . $currentUser->id, true, $expiresAt);
            $currentUser->last_active = Carbon::now();
            $currentUser->save();

            if($currentUser->role == "dj") {
                $onlineDjs = array();

                $djs = \App\User::where('role', 'dj')->get();
                foreach ($djs as $user) {
                    if ($user->isOnline()) {
                        $dj = $user->dj->first();
                        $u['id'] = $user->id;
                        $u['image'] = $user->profile_picture;
                        $u['name'] = $dj->first_name . ' ' . $dj->last_name;
                        $u['last_active'] = $user->last_active;
                        $onlineDjs[] = $u;

                    }
                }

//                event(new \App\Events\GenericEvent("campaigns_public", "online_dj",json_encode($onlineDjs)));
            }


        }
        return $response;
    }
}



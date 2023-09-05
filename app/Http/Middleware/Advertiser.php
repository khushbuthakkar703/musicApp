<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Advertiser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role === 'advertiser') {
                if($user->blocked == "login-blocked"){
                    //logOut();
                    Auth::logout();
                    \Session::forget('user');
                    setcookie('disableAdPopUp', false, time() - 3600, "/");

                    return redirect('/')->withError('You are blocked!! Contact Admin');
                }

                return $next($request);
                //throw new \Exception("Page Not Found",404);
            } else {
                return redirect('/');
            }
        } else{
            return redirect('/');
        }

        //return $next($request);
    }

     public static function logOut()
    {

        Auth::logout();
        \Session::forget('user');

        setcookie('disableAdPopUp', false, time() - 3600, "/");

        return redirect('/');

    }
}

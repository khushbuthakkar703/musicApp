<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            $role = Auth::user()->role;
            //return $role;
            if($role == 'dj'){
                return redirect('/dj/dashboard');
            }elseif($role == 'djmanager'){
                return redirect('/djmanager');
            }elseif($role == 'admin'){
                return redirect('/matches');
            }elseif($role == 'campaign'){
                return redirect('/campaign/dashboard');
            }elseif($role == 'advertiser'){
                return redirect('/advertiser');
            }elseif($role == 'artistmanager'){
                return redirect('/artistmanager');
            }elseif($role == 'keyer'){
                return redirect('/keyer');
            }
        }

        return $next($request);
    }
}

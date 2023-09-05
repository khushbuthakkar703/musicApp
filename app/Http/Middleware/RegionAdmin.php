<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RegionAdmin
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
            if (Auth::user()->role === 'regionadmin' || Auth::user()->role === 'admin') {
                return $next($request);
                //throw new \Exception("Page Not Found",404);
            } else {
                return redirect('/');
            }
        } else{
            return redirect('/');
        }
    }
}

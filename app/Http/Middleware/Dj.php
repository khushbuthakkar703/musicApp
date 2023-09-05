<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Dj
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            if (Auth::user()->role === 'dj') {
                return $next($request);
            } else {
                return redirect('/');
            }
        } else {
            return redirect('/');
        }
        //throw new \Exception("Page Not Found",404);
    }
}

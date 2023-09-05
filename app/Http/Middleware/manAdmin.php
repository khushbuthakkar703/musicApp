<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;

use Closure;

class manAdmin
{
    /**
     * Handle an incoming request.
     *
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            if (auth()->user()->role == 'admin' || auth()->user()->role == 'djmanager' || auth()->user()->role == 'regionadmin') {
                return $next($request);
            } else {
                return redirect('/');
            }
        } else {
            return redirect('/');
        }

    }
}

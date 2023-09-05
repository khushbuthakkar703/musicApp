<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Keyer
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
        $user = Auth::user();
        error_log("test1");
        if($user == null){
            return redirect('/')->with('error','You must login');
        }elseif (!$user->iskeyer()){
            return redirect()->back()->with('error','You don\'t have keying access, Contact Support to enable it');
        }
        return $next($request);
    }
}

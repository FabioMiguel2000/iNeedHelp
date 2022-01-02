<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Administrator;
use Illuminate\Support\Facades\Auth;

class IfNotBanned
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check() && !Auth::user()->is_blocked)
        {
            //If user not banned
            return $next($request);
        }
        else{
            return redirect()->back()->withErrors(['You have been banned, please contact for more information!']);
        }
        return $next($request);
    }
}

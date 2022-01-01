<?php

namespace App\Http\Middleware;

use App\Models\Administrator;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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
        if(Auth::check() && Administrator::where('user_id', Auth::user()->id)->exists())
        {
            //If it is an administrator
            return $next($request);

        }
        else{
            return redirect()->with('status', 'Access denied!');
        }
        return $next($request);
    }
}

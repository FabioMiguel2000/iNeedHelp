<?php

namespace App\Http\Middleware;

use App\Models\Administrator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Administrator::where('user_id', Auth::user()->id)->exists()) {
            //If it is an administrator
            return $next($request);

        }
        return redirect()->with('status', 'Access denied!');
    }
}

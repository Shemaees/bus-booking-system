<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::guard('admin')->check() && Auth::guard('admin')->User()->status  !== 1)
        {
            Auth::logout();
            return redirect()->route('admin.login')
                ->with('error', 'Your account has been banned. Please contact admin');
        }

        return $next($request);
    }
}

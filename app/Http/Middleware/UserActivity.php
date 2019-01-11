<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Auth;
use Cache;

class UserActivity
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
        // return $next($request);
        
        if(Auth::check()) {
            $expiresAt = Carbon::now()->addMinutes(5);
            Cache::put('user-is-online-' . Auth::user()->id, true, $expiresAt);
        }
        // return $next($request);

        // $expiresAt = Carbon::now()->addMinutes(5);
        // // if(Auth::guard('admin')->check()) { 
        // //    Cache::put('admin-is-online-' . Auth::guard('admin')->user()->id, true, $expiresAt);
        // //  } 
        //  if(Auth::check()) { 
        //     Cache::put('user-is-online-' . Auth::user()->id, true, $expiresAt);
        //  }
        return $next($request);
    }
}

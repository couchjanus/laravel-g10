<?php

namespace App\Http\Middleware;

use Closure;

class CheckIsAdmin
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
        // Обработка входящего запроса.
        if (!\Auth::user()->is_admin) {
            return redirect()->route('home');
        }
        return $next($request);
    }
}

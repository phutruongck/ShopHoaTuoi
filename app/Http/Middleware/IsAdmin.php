<?php

namespace App\Http\Middleware;

use Closure;

class IsAdmin
{
    public function handle($request, Closure $next)
    {
        if (\Auth::user() && \Auth::user()->rule == 1) {
            return $next($request);
        }

        return redirect('/home');
    }
}

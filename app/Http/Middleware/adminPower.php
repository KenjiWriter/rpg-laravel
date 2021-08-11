<?php

namespace App\Http\Middleware;

use Closure;
use auth;
use Illuminate\Http\Request;

class adminPower
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
        if(auth()->user()->admin_power <= 0) {
            return redirect('/profile');
        }
        
        return $next($request);
    }
}

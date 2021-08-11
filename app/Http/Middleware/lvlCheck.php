<?php

namespace App\Http\Middleware;
use App\Models\User;

use Closure;
use Illuminate\Http\Request;

class lvlCheck
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
        $user = new User;
        $user = auth()->user();
        if(auth()->user()->level < 5) {
            $user->exp_needed = $user->level*5;
            $user->save();
        } else {
            $user->exp_needed = $user->level*9.2321;
            $user->save();
        }
        
        while($user->exp >= $user->exp_needed) {  
            $user->exp -= auth()->user()->exp_needed;
            $user->level += 1;
            $user->stats_point += 3;
            if(auth()->user()->level < 5) {
                $user->exp_needed = $user->level*5;
            } else {
                $user->exp_needed = $user->level*2.5;
            }
            $user->save();
        }
        return $next($request);
    }
}

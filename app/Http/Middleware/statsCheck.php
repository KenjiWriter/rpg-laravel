<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class statsCheck
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
        if($user->physical_damage > $user->strength*1 || $user->physical_damage_max < $user->strength*7) {
            $user->physical_damage = $user->strength*1;
            $user->physical_damage_max = $user->strength*7;
        }
        if($user->magical_damage < $user->intelligence*3 || $user->magical_damage_max < $user->intelligence*15 || $user->mana != 47.5 + $user->intelligence*2.5) {
            $user->magical_damage = $user->intelligence*3;
            $user->magical_damage_max = $user->intelligence*15;
            $user->mana = 47.5 + $user->intelligence*2.5;
            $user->save();
        }
        if($user->health != $user->endurance*10 || $user->stamina != $user->endurance*2.5) {
            $user->health = $user->endurance*10;
            $user->stamina = $user->endurance*2.5;
            $user->save();
        }
        if($user->critical_chance != $user->luck*0.5) {
            $user->	critical_chance = $user->luck*0.5;
            $user->save();
        }
        
        return $next($request);
    }
}

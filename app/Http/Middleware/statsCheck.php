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
        $user = user::where('id','=',auth()->user()->id)->first();
        if($user->physical_damage > $user->strength*3 || $user->physical_damage_max < $user->strength*5) {
            $user->physical_damage = $user->strength*3;
            $user->physical_damage_max = $user->strength*5;
        }
        if($user->magical_damage < $user->intelligence*3 || $user->magical_damage_max < $user->intelligence*15 || $user->mana != 47.5 + $user->intelligence*2.5) {
            $user->magical_damage = $user->intelligence*5;
            $user->magical_damage_max = $user->intelligence*7;
            $user->mana = 47.5 + $user->intelligence*2.5;
        }
        if($user->health != 100+$user->vitality*10) {
            $user->health = 100+$user->vitality*10;
        }
        if($user->damage_reduction != $user->endurance * 0.1) {
            $user->damage_reduction = $user->endurance * 0.1;
        }
        if($user->critical_chance != $user->dexterity*0.5) {
            $user->	critical_chance = $user->dexterity*0.5;
        }
        $user->save();
        
        return $next($request);
    }
}

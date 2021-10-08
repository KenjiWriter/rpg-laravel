<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class FunctionsController extends Controller
{
    public static function numConverter($number) 
    {
        if($number >= 1000) {
            $number = $number/1000;
            $converted_number = round($number, 2).'k';
            return $converted_number;
         }
         else {
             return $number;
         }
    }

    public function checkStatus()
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
        if($user->health != $user->endurance*10 || $user->stamina != $user->endurance*2.5) {
            $user->health = $user->endurance*10;
            $user->stamina = $user->endurance*2.5;
        }
        if($user->critical_chance != $user->dexterity*0.5) {
            $user->	critical_chance = $user->dexterity*0.5;
        }
        $user->save();
    }
}

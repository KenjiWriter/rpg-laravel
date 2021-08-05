<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use Auth;

class mainController extends Controller
{
    public function numConverter($number) 
    {
        if($number >= 1000) {
            return $number/1000 . "k";
         }
         else {
             return $number;
         }
    }

    public function statAdd(Request $request) 
    {
        function add($stat) 
        {
            $user = user::where('id','=',auth()->user()->id)->first();
            $user->stats_point -= 1;
            $user->$stat += 1;
            $user->save();
        }
        
        if(isset($request->strength)) {
            add("strength");
            return back()->with('added', '+1 strength point');
        }
        if(isset($request->intelligence)) {
            add("intelligence");
            return back()->with('added', '+1 intelligence point');
        }
        if(isset($request->endurance)) {
            add("endurance");
            return back()->with('added', '+1 endurance point');
        }
        if(isset($request->luck)) {
            add("luck");
            return back()->with('added', '+1 luck point');
        }
    }
    
    function login() 
    {
        if(auth()->user()){
            return redirect('/profile');
        }
        return view('auth.login');
    }

    function test()
    {
        return view('test');
    }

    function register()
    {
        return view('auth.register');
    }

    function profile()
    {
        $user = auth()->user();
        //Convert numbers
        $exp = $this->numConverter($user->exp);
        $exp_needed = $this->numConverter($user->exp_needed);
        $health = $this->numConverter($user->health);
        $mana =$this->numConverter($user->mana);
        $stamina = $this->numConverter($user->stamina);
        $coins = $this->numConverter($user->coins);
        $strength = $this->numConverter($user->strength);
        $intelligence = $this->numConverter($user->intelligence);
        $endurance = $this->numConverter($user->endurance);
        $luck = $this->numConverter($user->luck);
        $crit_chance = $this->numConverter($user->critical_chance);
        $dmg = $this->numConverter($user->physical_damage);
        $dmg_max = $this->numConverter($user->physical_damage_max);
        $magic_dmg = $this->numConverter($user->magical_damage);
        $magic_dmg_max = $this->numConverter($user->magical_damage_max);
        return view('user.profile', compact('exp', 'exp_needed', 'health', 'mana', 'stamina', 'strength', 'intelligence', 'endurance', 'luck', 'dmg', 'dmg_max', 'magic_dmg', 'magic_dmg_max', 'crit_chance'));
    }
}

<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Http\Controllers\FunctionsController;
use Illuminate\Http\Request;
use Auth;

class mainController extends Controller
{
    public function statAdd(Request $request) 
    {
        function add($stat, $points) 
        {
            $user = user::where('id','=',auth()->user()->id)->first();
            if($points > auth()->user()->stats_point) {
                return back()->with('fail', 'Fail! Not enought point!');
            }
            $user->stats_point -= $points;
            $user->$stat += $points;
            $user->save();
        }
        $points = $request->amount;
        if($points == 0 || !$points) $points = 1;

        if(isset($request->strength)) {
            add("strength", $points);
            return back()->with('added', '+'.$points.' strength point');
        }
        if(isset($request->intelligence)) {
            add("intelligence", $points);
            return back()->with('added', '+'.$points.' intelligence point');
        }
        if(isset($request->endurance)) {
            add("endurance", $points);
            return back()->with('added', '+'.$points.' endurance point');
        }
        if(isset($request->luck)) {
            add("luck", $points);
            return back()->with('added', '+'.$points.' luck point');
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
        $convert = new FunctionsController;

        $user = auth()->user();
        //Convert numbers
        $exp = $convert->numConverter($user->exp);
        $exp_needed = $convert->numConverter($user->exp_needed);
        $health = $convert->numConverter($user->health);
        $mana = $convert->numConverter($user->mana);
        $stamina = $convert->numConverter($user->stamina);
        $coins = $convert->numConverter($user->coins);
        $strength = $convert->numConverter($user->strength);
        $intelligence = $convert->numConverter($user->intelligence);
        $endurance = $convert->numConverter($user->endurance);
        $luck = $convert->numConverter($user->luck);
        $crit_chance = $convert->numConverter($user->critical_chance);
        $dmg = $convert->numConverter($user->physical_damage);
        $dmg_max = $convert->numConverter($user->physical_damage_max);
        $magic_dmg = $convert->numConverter($user->magical_damage);
        $magic_dmg_max =  $convert->numConverter($user->magical_damage_max);
        return view('user.profile', compact('exp', 'exp_needed', 'health', 'mana', 'stamina', 'strength', 'intelligence', 'endurance', 'luck', 'dmg', 'dmg_max', 'magic_dmg', 'magic_dmg_max', 'crit_chance'));
    }
}

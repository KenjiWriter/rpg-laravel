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
    
    function login() 
    {
        if(auth()->user()){
            return redirect('/profile');
        }
        return view('auth.login');
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
        return view('user.profile', compact('exp', 'exp_needed', 'health', 'mana', 'stamina', 'strength', 'intelligence', 'endurance', 'luck'));
    }
}

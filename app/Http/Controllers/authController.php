<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;

class authController extends Controller
{
    function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }

    
    function check(Request $request)
    {
        //Validate request
        $request->validate([
            'login'             => 'required',
            'password'          => 'required'
        ]);

        if (Auth::attempt(['login' => $request->login, 'password' => $request->password])) {
            $user = auth()->user();
            Auth::login($user,true);
            return redirect('profile');
        } else {
            return back()->with('fail', 'Bad or Incorect login or password'); 
        }
    }

    function save(Request $request)
    {
        //Validate request
        $request->validate([
                'login'         => 'required|max:32|unique:users',
                'password'      => 'required|min:8|confirmed',
                'password_confirmation'   => 'required'
        ]);

        //Insert data into database
        $user = new User;
        $user->login = $request->login;
        $user->password = Hash::make($request->password);
        $user->level = 1;
        $user->stats_point = 1;
        $user->exp = 0;
        $user->exp_needed = 5;
        $user->coins = 10;
        $user->health = 100;
        $user->mana = 50.00;
        $user->stamina = 50.00;
        $user->strength = 1;
        $user->intelligence = 1;
        $user->endurance = 1;
        $user->luck = 1;

        $save = $user->save();

        if($save) {
            return back()->with('success', 'true');
        } else {
            return back()->with('fail', 'Somethink went wrong');
        }
    }
}

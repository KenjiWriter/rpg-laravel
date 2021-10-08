<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Http\Controllers\FunctionsController;
use Illuminate\Http\Request;
use Auth;

class mainController extends Controller
{
   
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
        $convert = new FunctionsController;

        $user = auth()->user();
        //Convert numbers
        $exp = $convert->numConverter($user->exp);
        $exp_needed = $convert->numConverter($user->exp_needed);
        return view('user.profile', compact('exp', 'exp_needed'));
    }
}

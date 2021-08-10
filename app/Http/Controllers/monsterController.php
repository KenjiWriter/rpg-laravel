<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\monster;
use Auth;

class monsterController extends Controller
{
    function add() 
    {
        
        if(auth()->user()->admin_power <= 9) {
            return back();
        }
        return view('admin.addmonster');
    }

    function save(Request $request)
    {
        //Validate request
        $request->validate([
            'name' => 'required|unique:monster',
            'level' => 'required|numeric',
            'health' => 'required|numeric',
            'dmg' => 'required|numeric',
            'dmg_max' => 'required|numeric',
        ]);

        //Inster data into database
        $monster = new monster;
        $monster->name = $request->name;
        $monster->level = $request->level;
        $monster->health = $request->health;
        $monster->damage = $request->dmg;
        $monster->damage_max = $request->dmg_max;
        $monster->class = $request->class;
        $save = $monster->save();

        if($save) {
            return back()->with('success', 'New monster was added to database');
        } else {
            return back()->with('fail', 'Something went wrong try again later');
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\monster;
use Auth;
use Session;

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
        if(isset($request->amount)) {
            session::put('amount', $request->amount);
            return back();
        }
        
        //Validate request
        $request->validate([
            'name' => 'required|unique:monster',
            'map_id' => 'required|numeric',
            'level' => 'required|numeric',
            'health' => 'required|numeric',
            'dmg' => 'required|numeric',
            'dmg_max' => 'required|numeric',
        ]);

        //Drop
        $drops = array();
        foreach ($request->drops as $id=>$drop) {
            if(!is_int($id)){
                throw new Exception("Invalid drop id $id");
            }
            $drops[$id]['id'] = $drop['id'];
            $drops[$id]['amount'] = $drop['amount'];
            $drops[$id]['max_amount'] = $drop['max_amount'];
            $drops[$id]['chances'] = $drop['chances'];
        }
        $drops = json_encode($drops);

        //Inster data into database
        $monster = new monster;
        $monster->name = $request->name;
        $monster->level = $request->level;
        $monster->health = $request->health;
        $monster->damage = $request->dmg;
        $monster->damage_max = $request->dmg_max;
        $monster->class = $request->class;
        $monster->map_id = $request->map_id;
        $monster->drops = $drops;
        $save = $monster->save();

        if($save) {
            return back()->with('success', 'New monster was added to database');
        } else {
            return back()->with('fail', 'Something went wrong try again later');
        }
    }
}

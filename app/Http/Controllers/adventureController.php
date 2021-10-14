<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use auth;
use Session;
use App\Http\Controllers\FunctionsController;
use Illuminate\Support\Arr;
use App\Models\User;
use App\Models\monster;
use App\Models\item;

class adventureController extends Controller
{
    
    function adventure()
    {
        if(session::get('fight')) {
            return redirect('/adventure/'.session::get('fight'));
        }
        
        return view('user.adventure');
    }

    public function startFight($map,$map_id)
    {
        //Start Fight
        if(!Session::get('fight')) {
            Session::put('fight', $map);
            $random_number = rand(1,100);
            if(5 > $random_number) {
                $monster = monster::inRandomOrder()->where('class','=','1')->where('map_id','=', $map_id)->limit(1)->get();
            } else {
                $monster = monster::inRandomOrder()->where('class','=','0')->where('map_id' ,'=', $map_id)->limit(1)->get();
            }
            if(!$monster) {
                return redirect('/adventure/')->with('fail','No mobs avaible for your level!');
            }
            foreach($monster as $enemi) {
                session::put('monster_current_hp', $enemi->health);
            }
            Session::put('monster', $monster);
            session::put('player_current_hp', auth()->user()->health);
        }
    }
  
    function end()
    {
        session::forget(['fight', 'monster_current_hp', 'monster', 'player_current_hp']);
        return redirect('/adventure/');
    }
    
    function woods()
    {
        $current_map = "woods";
        
        //Start fight
        $this->startFight($current_map, 1);
        return view('maps.exp_pve', compact('current_map'));
    }
    
    function Orcs_valley()
    {
        $current_map = "Orcs_valley";
        
        //Start fight
        $this->startFight("Orcs_valley", 2);
        return view('maps.exp_pve', compact('current_map'));
    }
}

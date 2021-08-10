<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use auth;
use Session;
use App\Models\User;
use App\Models\monster;

class adventureController extends Controller
{
    function adventure()
    {
        if(session::get('fight')) {
            return redirect('/adventure/'.session::get('fight'));
        }
        
        return view('user.adventure');
    }

    function woods()
    {
        //Start fight
        if(!Session::get('fight')) {
            Session::put('fight', 'woods');
            $monster = monster::inRandomOrder()->where('level','<=', auth()->user()->level+10)->limit(1)->get();
            foreach($monster as $enemi) {
                session::put('monster_current_hp', $enemi->health);
            }
            Session::put('monster', $monster);
            session::put('player_current_hp', auth()->user()->health);
        }

        $player = auth()->user();
        $monster = session::get('monster');
        $monster_current_hp = session::get('monster_current_hp');
        $player_current_hp = session::get('player_current_hp');
        foreach($monster as $enemi) {
            $enemi_name = $enemi->name;
            $enemi_level = $enemi->level;
            $enemi_min_dmg = $enemi->damage;
            $enemi_max_dmg = $enemi->damage_max;
        }
        if($monster_current_hp > 0) {
            $dmg = rand($player->physical_damage, $player->physical_damage_max);
            $monster_current_hp -= $dmg;
            session::put('monster_current_hp', $monster_current_hp);
            session::put('damage', 'You deal '.$dmg);
        }
        if($player_current_hp > 0) {
                $dmg = rand($enemi_min_dmg, $enemi_max_dmg); 
                $player_current_hp -= $dmg;
                session::put('player_current_hp', $player_current_hp);
                session::put('monster damage', $enemi_name.' deal '.$dmg);
        }
        header("Refresh:0.7");

        //fight result
        if($player_current_hp > 0) {
            //Won fight
            if($monster_current_hp <= 0.00) {
                $user = new User;
                $user = auth()->user();
                $coins_drop = $enemi_level * rand(1.1,2.5);
                $exp_drop = $enemi_level * rand(1.1,2.5);
                $user->coins += $coins_drop;
                $user->exp += $exp_drop;
                $user->save();
                session::forget(['fight', 'monster_current_hp', 'monster', 'player_current_hp']);
                return redirect('/adventure/')->with('success', 'You Won! Drop: exp+'.$exp_drop.' coins +'.$coins_drop);
            }
        } elseif($player_current_hp <= 0.00) {
            //Lose fight
            if($monster_current_hp > 0) {
                session::forget(['fight', 'monster_current_hp', 'monster', 'player_current_hp']);
                return redirect('/adventure/')->with('fail', 'You lose! Next time will be better');
            }
        }
        return view('maps.woods', compact('monster', 'monster_current_hp', 'player_current_hp'));
    }
}

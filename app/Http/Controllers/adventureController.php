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

    public function PlayerRound($monster_hp, $player_critial_chance, $player_min_dmg, $player_max_dmg) 
    {
        $convert = new FunctionsController;
        if($monster_hp >= 0) {
            $random_number = rand(1,100);
            $dmg = rand($player_min_dmg, $player_max_dmg);
            if($player_critial_chance <= $random_number) {
                $dmg *= 1.5;
                session::put('damage', 'You deal '.$dmg.' *CRIT*');
            } else {
                session::put('damage', 'You deal '.$dmg);
            }
            session::forget('monster_current_hp');
            $monster_hp = $monster_hp-$dmg;
            session::put('monster_current_hp', $monster_hp);
            return $monster_hp -= $dmg;
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
        $this->startFight("woods", 1);

        //Fight
        $player = auth()->user();
        $monster = session::get('monster');
        $monster_current_hp = session::get('monster_current_hp');
        $player_current_hp = session::get('player_current_hp');
        foreach($monster as $enemi) {
            $enemi_name = $enemi->name;
            $enemi_level = $enemi->level;
            $enemi_min_dmg = $enemi->damage;
            $enemi_max_dmg = $enemi->damage_max;
            $enemi_class = $enemi->class;
            $enemi_drop = $enemi->drops;
        }
        if($monster_current_hp >= 0) {
            $random_number = rand(1,100);
            if($player->critical_chance > $random_number) {
                $dmg = rand($player->physical_damage, $player->physical_damage_max)*1.5;
                session::put('damage', 'You deal '.$dmg.' *CRIT*');
            } else {
                $dmg = rand($player->physical_damage, $player->physical_damage_max);
                session::put('damage', 'You deal '.$dmg);
            }
            $monster_current_hp -= $dmg;
            session::put('monster_current_hp', $monster_current_hp);
        }
        if($player_current_hp >= 0) {
                $dmg = rand($enemi_min_dmg, $enemi_max_dmg); 
                $player_current_hp -= $dmg;
                session::put('player_current_hp', $player_current_hp);
                session::put('monster damage', $enemi_name.' deal '.$dmg);
        }
        header('refresh: 1');

        //fight result
        if($player_current_hp >= 0.00) {
            //Won fight
            if($monster_current_hp <= 0.00) {
                $user = new User;
                $user = auth()->user();
                if($enemi_class == 1) {
                    $coins_drop = $enemi_level * rand(2,3);
                    $exp_drop = $enemi_level * rand(2,3); 
                } else {
                    $coins_drop = $enemi_level * rand(1.1,2.5);
                    $exp_drop = $enemi_level * rand(1.1,2.5);
                }

                //Drop
                $drop = json_decode($enemi_drop, true);
                foreach ($drop as $id => $drop) {
                    $item_id = $drop['id'];
                    $random_number = rand(1,100);
                    if($drop['chances'] >= $random_number) {
                        $amount = rand($drop['amount'],$drop['max_amount']);
                        $user->items = json_decode($user->items, true);
                        $count = $amount;
                        if(empty($user->items[$item_id])){
                            $count = $amount;
                        } else {
                            foreach($user->items[$item_id] as $player_item) {
                                $count = $amount+$player_item;
                            }
                        }
                        $item_player = $user->items;
                        $item_player[$item_id] = array('amount' => $count);
                        $user->items = json_encode($item_player);
                        
                        $item = Item::findOrFail($item_id);
                        Session::put('drop', 'Drop:'.$item->name.' '.$amount);
                    }
                }
                $user->coins += $coins_drop;
                $user->exp += $exp_drop;
                $user->save();
                session::forget(['fight', 'monster_current_hp', 'monster', 'player_current_hp', 'dmg']);
                return redirect('/adventure/woods')->with('success', 'You Won! Reward: exp+'.$exp_drop.' coins +'.$coins_drop);
            }
        } elseif($player_current_hp <= 0.00) {
            //Lose fight
            if($monster_current_hp >= 0.00) {
                session::forget(['fight', 'monster_current_hp', 'monster', 'player_current_hp']);
                return redirect('/adventure/')->with('fail', 'You lose! Next time will be better');
            }
        }
        return view('maps.exp_pve', compact('monster', 'monster_current_hp', 'player_current_hp', 'current_map'));
    }
    
    function fight()
    {
        
    }
    
    function Orcs_valley()
    {
        $current_map = "Orcs_valley";
        
        //Start fight
        $this->startFight("Orcs_valley", 2);

        //Fight
        $player = auth()->user();
        $monster = session::get('monster');
        $monster_current_hp = session::get('monster_current_hp');
        $player_current_hp = session::get('player_current_hp');
        foreach($monster as $enemi) {
            $enemi_name = $enemi->name;
            $enemi_level = $enemi->level;
            $enemi_min_dmg = $enemi->damage;
            $enemi_max_dmg = $enemi->damage_max;
            $enemi_class = $enemi->class;
            $enemi_drop = $enemi->drops;
        }
        if(empty($enemi)){
            $this->end();
        }
        $this->PlayerRound($monster_current_hp, $monster_current_hp, $player->physical_damage, $player->physical_damage_max);
        if($player_current_hp >= 0) {
            if(isset($enemi_min_dmg)) {
                $dmg = rand($enemi_min_dmg, $enemi_max_dmg); 
            }
                $player_current_hp -= $dmg;
                session::put('player_current_hp', $player_current_hp);
                session::put('monster damage', $enemi_name.' deal '.$dmg);
        }

        //fight result
        if($player_current_hp >= 0.00) {
            //Won fight
            if($monster_current_hp <= 0.00) {
                $user = new User;
                $user = auth()->user();
                if($enemi_class == 1) {
                    $coins_drop = $enemi_level * rand(2,3);
                    $exp_drop = $enemi_level * rand(2,3); 
                } else {
                    $coins_drop = $enemi_level * rand(1.1,2.5);
                    $exp_drop = $enemi_level * rand(1.1,2.5);
                }

                //Drop
                $drop = json_decode($enemi_drop, true);
                foreach ($drop as $id => $drop) {
                    $item_id = $drop['id'];
                    $random_number = rand(1,100);
                    if($drop['chances'] >= $random_number) {
                        $amount = rand($drop['amount'],$drop['max_amount']);
                        $user->items = json_decode($user->items, true);
                        $count = $amount;
                        if(empty($user->items[$item_id])){
                            $count = $amount;
                        } else {
                            foreach($user->items[$item_id] as $player_item) {
                                $count = $amount+$player_item;
                            }
                        }
                        $item_player = $user->items;
                        $item_player[$item_id] = array('amount' => $count);
                        $user->items = json_encode($item_player);
                        
                        $item = Item::findOrFail($item_id)->only('name');
                        if(session::get('drop_count')) {
                            session::put('drop_count', session::get('drop_count')+1);
                        } else {
                            session::put('drop_count', 1); 
                        }
                        $item = Item::findOrFail($item_id);
                        Session::put('drop', 'Drop:'.$item->name.' '.$amount);
                    }
                }
                $user->coins += $coins_drop;
                $user->exp += $exp_drop;
                $user->save();
                session::forget(['fight', 'monster_current_hp', 'monster', 'player_current_hp']);
                return redirect('/adventure/Orcs_valley')->with('success', 'You Won! Reward: exp+'.$exp_drop.' coins +'.$coins_drop);
            }
        } else {
            //Lose fight
            if($monster_current_hp >= 0.00) {
                session::forget(['fight', 'monster_current_hp', 'monster', 'player_current_hp']);
                return redirect('/adventure/')->with('fail', 'You lose! Next time will be better');
            }

        }
        if($monster_current_hp <= 0.00 || $player_current_hp <= 0.00) {
            //Lose fight
            if($monster_current_hp >= 0.00) {
                session::forget(['fight', 'monster_current_hp', 'monster', 'player_current_hp']);
                return redirect('/adventure/')->with('fail', 'You lose! Next time will be better');
            }
        }
        return view('maps.exp_pve', compact('monster', 'monster_current_hp', 'player_current_hp', 'current_map'));
    }
}

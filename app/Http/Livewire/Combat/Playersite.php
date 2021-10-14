<?php

namespace App\Http\Livewire\Combat;

use Livewire\Component;
use App\Models\User;
use Session;
use App\Http\Controllers\FunctionsController;

class Playersite extends Component
{
    public $user;
    public $map;
    public $stop;
    protected $listeners = ['next_battle'];
    public function next_battle($result)
    {
        $this->stop  = $result;
    }
    
    public function attack() {
        $monster = session::get('monster');
        $player_current_hp = session::get('player_current_hp');
        $monster_hp = session::get('monster_current_hp');
        
        if($monster_hp >= 0)
        {
            if(isset($monster)){
                if($player_current_hp >= 0.00 || $monster_hp <= 0) {
                    foreach($monster as $enemi) {
                        $enemi_min_dmg = $enemi->damage;
                        $enemi_max_dmg = $enemi->damage_max;
                        $enemi_name = $enemi->name;
                    }
                    $function = new FunctionsController;
                    if(isset($enemi_min_dmg)) {
                            $dmg = rand($enemi_min_dmg, $enemi_max_dmg); 
                        }
                            $player_current_hp -= $dmg;
                            session::put('player_current_hp', $player_current_hp);
                            $message = $enemi_name." deal ".$dmg;
                            $this->emit('monster_message', $message);
                } else {
                    //Lose
                    $this->emit('result', 2, 0, 0);
                    $this->emit('next_battle', 1);
                    $function->end();
                }  
            }
        }
    }
    
    public function render()
    {
        $this->user = user::where('id','=',auth()->user()->id)->first();
        return view('livewire.combat.playersite');
    }
}

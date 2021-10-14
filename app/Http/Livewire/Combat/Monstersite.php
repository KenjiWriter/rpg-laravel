<?php

namespace App\Http\Livewire\Combat;

use Livewire\Component;
use App\Models\User;
use App\Models\item;
use Session;

class Monstersite extends Component
{
    public $enemi;
    public $map;
    public $stop;
    protected $listeners = ['next_battle'];
    public function next_battle($result)
    {
        $this->stop  = $result;
    }
    public function attack()
    {
        $monster_hp = session::get('monster_current_hp');
        $user = user::where('id','=',auth()->user()->id)->first();
        if($monster_hp >= 0) {
            $random_number = rand(1,100);
            $dmg = rand($user->physical_damage, $user->physical_damage_max);
            if($user->critical_chance <= $random_number) {
                $dmg *= 1.5;
                session::put('damage', 'You deal '.$dmg.' *CRIT*');
                $message = "You deal ".$dmg." *CRIT*";
                $this->emit('player_message', $message);
            } else {
                $message = "You deal ".$dmg;
                $this->emit('player_message', $message);
            }
            $monster_hp -= $dmg;
            session::put('monster_current_hp', $monster_hp);
        } else {
            //WON
            $enemi = $this->enemi;
            if($enemi->class == 1) {
                $coins_drop = $enemi->level * mt_rand(2,3);
                $exp_drop = $enemi->level * mt_rand(2,3); 
            } else {
                $coins_drop = $enemi->level * mt_rand(1.1,2.5);
                $exp_drop = $enemi->level * mt_rand(1.1,2.5);
            }

            //Drop
            $drop = json_decode($enemi->drops, true);
            $drop_item = [];
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
                    $drop_item[] = ['name' => $item->name, 'amount' => $amount, 'quality' => $item->rare];
                }
            }
            $user->coins += $coins_drop;
            $user->exp += $exp_drop;
            $user->save();
            $user->fresh();
            $this->emit('drop', $drop_item, $user->exp);
            $this->emit('result', 1, $coins_drop, $exp_drop);
            $this->emit('next_battle', 1);
            session::forget(['fight', 'monster_current_hp', 'monster', 'player_current_hp']);
        }
    }
    
    public function render()
    {
        $monster = session::get('monster');
        if(isset($monster)){
            foreach($monster as $enemi) {
                $this->enemi = $enemi;
            }
        }
        return view('livewire.combat.monstersite');
    }
}

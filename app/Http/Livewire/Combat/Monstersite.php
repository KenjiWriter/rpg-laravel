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
        $player_current_hp = session::get('player_current_hp');
        $user = user::where('id','=',auth()->user()->id)->first();
        if($monster_hp >= 0) {
            $random_number = rand(1,100);
            $dmg = rand($user->physical_damage, $user->physical_damage_max);
            if($user->critical_chance>= $random_number) {
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
                    $item = Item::findOrFail($item_id);
                    // Item stats
                    //Decode arrays
                    $strength = json_decode($item['strength'], true);
                    $intelligence = json_decode($item['intelligence'], true);
                    $endurance = json_decode($item['endurance'], true);
                    $vitality = json_decode($item['vitality'], true);
                    $dexterity = json_decode($item['dexterity'], true);
                    $amount = rand($drop['amount'],$drop['max_amount']);
                    //Rand numbers from min to max
                    $strength = rand($strength['min'], $strength['max']);
                    $intelligence = rand($intelligence['min'], $intelligence['max']);
                    $endurance = rand($endurance['min'], $endurance['max']);
                    $vitality = rand($vitality['min'], $vitality['max']);
                    $dexterity = rand($dexterity['min'], $dexterity['max']);

                    $user->items = json_decode($user->items, true);
                    if(empty($user->items)) {
                        if($item->stackable == 1) {
                            $newItem = array(['id' => $item_id, 'amount' => $amount]);
                        } else {
                            $newItem = array(['id' => $item_id, 
                            'strength' => $strength, 'intelligence' => $intelligence, 'endurance' => $endurance, 'vitality' => $vitality, 'dexterity' => $dexterity]);
                        }
                        $user->items = json_encode($newItem);
                    } else {
                        foreach($user->items as $key => $player_item) {
                            if($player_item['id'] == $item_id) {
                                if($item->stackable == 1) {
                                    // $newItem = ['id' => $item_id, 'amount' => $player_item['amount']+$amount];
                                    $player_items = $user->items;
                                    $player_items[$key]['amount'] += $amount;
                                    $user->items = json_encode($player_items);
                                } else {
                                    $newItem = ['id' => $item_id,
                                    'strength' => $strength, 'intelligence' => $intelligence, 'endurance' => $endurance, 'vitality' => $vitality, 'dexterity' => $dexterity];
                                    $player_items = $user->items;
                                    $player_items[] = $newItem;
                                    $user->items = json_encode($player_items);
                                }
                            } else {
                                if($item->stackable == 1) {
                                    $newItem = ['id' => $item_id, 'amount' => $amount];
                                    $player_items = $user->items;
                                    $player_items[] = $newItem;
                                    $user->items = json_encode($player_items);
                                } else {
                                    $newItem = ['id' => $item_id,
                                    'strength' => $strength, 'intelligence' => $intelligence, 'endurance' => $endurance, 'vitality' => $vitality, 'dexterity' => $dexterity];
                                    $player_items = $user->items;
                                    $player_items[] = $newItem;
                                    $user->items = json_encode($player_items);
                                }
                            }
                        }
                    }
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
            return;
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

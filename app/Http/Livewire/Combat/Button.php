<?php

namespace App\Http\Livewire\Combat;

use Livewire\Component;
use Session;

class Button extends Component
{
    public $result;
    public $map;
    protected $listeners = ['next_battle'];

    public function next_battle($result) {
        $this->result = $result;
    }
    public function next()
    {
        session::forget(['fight', 'monster_current_hp', 'monster', 'player_current_hp']);
        return redirect('adventure/'.$this->map);
    }
    public function exit()
    {
        session::forget(['fight', 'monster_current_hp', 'monster', 'player_current_hp']);
        return redirect('adventure/');
    }

    public function render()
    {
        return view('livewire.combat.button');
    }
}

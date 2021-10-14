<?php

namespace App\Http\Livewire\Combat;

use Livewire\Component;

class Button extends Component
{
    public $result;
    public $map;
    protected $listeners = ['next_battle'];

    public function next_battle($result) {
        $this->result = $result;
    }
    public function render()
    {
        return view('livewire.combat.button');
    }
}

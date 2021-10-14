<?php

namespace App\Http\Livewire\Combat;

use Livewire\Component;

class Drop extends Component
{
    public array $drops;
    public $amount;

    protected $listeners = ['drop'];

    public function drop($drops) {
        $this->drops = $drops;
    }
    
    public function render()
    {
        return view('livewire.combat.drop');
    }
}

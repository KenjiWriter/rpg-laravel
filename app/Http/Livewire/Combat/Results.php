<?php

namespace App\Http\Livewire\Combat;

use Livewire\Component;

class Results extends Component
{
    protected $listeners = ['result'];
    public $result;
    public $gold;
    public $exp;
    public function result($result, $gold, $exp) 
    {
        if($result === 1) {
            $this->result = 1;
            $this->gold = $gold;
            $this->exp = $exp;
        } else {
            $this->result = 2;
        }
    }
    public function render()
    {
        return view('livewire.combat.results');
    }
}

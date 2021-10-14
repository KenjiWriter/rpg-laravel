<?php

namespace App\Http\Livewire\Combat;

use Livewire\Component;

class Messages extends Component
{
    public $player_message;
    public $monster_message;
    protected $listeners = ['player_message', 'monster_message'];

    public function player_message($message) {
        $this->player_message = $message;
    }

    public function monster_message($message) {
        $this->monster_message = $message;
    }

    public function render()
    {
        return view('livewire.combat.messages');
    }
}

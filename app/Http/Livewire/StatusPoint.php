<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Http\Controllers\FunctionsController;

class StatusPoint extends Component
{
    public $amount = 0;
    public $user;
    public $fail;
    public $success;

    function points_check($points)
    {
        if($points == 0 || !$points) $points = 1;
        if($points <= 0) {
            $this->success = "";
            $this->fail = "Fail! Bad amount points!";
            return false;
        } else {
            $this->fail = "";
        }
        if($points > $this->user->stats_point) {
            $this->fail = "Fail! Not enought point!";
            $this->success = "";
            return false;
        } else {
            $this->fail = "";
        }
        return $points;
    }
    
    function add($stat) 
    { 
        $points = $this->points_check($this->amount);
        $this->user->$stat += $points;
        $this->user->stats_point -= $points;
        $this->user->save();
        $function = new FunctionsController;
        $function->checkStatus(); 
        $this->user->fresh();
        $this->amount = 0;
    }
    
    public function strength()
    {
        $this->add('strength');
    }
    public function intelligence()
    {
        $this->add('intelligence');
    }
    public function endurance()
    {
        $this->add('endurance');
    }
    public function vitality()
    {
        $this->add('vitality');
    }
    public function dexterity()
    {
        $this->add('dexterity');
    }
    
    public function render()
    {
        $this->user = user::where('id','=',auth()->user()->id)->first();
        return view('livewire.status-point');
    }
}

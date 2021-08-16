<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\item;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    private $items = array(); // With the data property

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'login',
        'password',
        'level',
        'exp',
        'coins',
        'health',
        'mana',
        'stamina',
        'strenght',
        'intelligence',
        'endurance',
        'luck',
    ];
    
    public $attributes = [
        'items',
    ];   
   
    public function __set($key, $value)
    {
        $this->attributes[$key] = $value;
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
}

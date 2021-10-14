<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\mainController;
use App\Http\Controllers\authController;
use App\Http\Controllers\monsterController;
use App\Http\Controllers\adventureController;
use App\Http\Controllers\itemController;


Route::get('/auth/logout', [authController::class, 'logout'])->name('auth.logout');


Route::post('/auth/save', [authController::class, 'save'])->name('auth.save');
Route::post('/auth/check', [authController::class, 'check'])->name('auth.check');

Route::group(['middleware'=>['authCheck']], function(){
    Route::get('/', [mainController::class, 'login']);
    Route::get('/login', [mainController::class, 'login'])->name('auth.login');
    Route::get('/register', [mainController::class, 'register'])->name('auth.register');

    //Stats
    Route::post('/stat/add', [mainController::class, 'statAdd'])->name('stat.add');
    //User
    Route::group(['middleware'=>['lvlCheck', 'statsCheck']], function(){
        Route::get('/profile', [mainController::class, 'profile'])->name('user.profile');
        Route::get('/adventure', [adventureController::class, 'adventure'])->name('user.adventure');
        Route::get('/adventure/cancel', [adventureController::class, 'end'])->name('user.adventure.cancel');
        Route::get('/adventure/woods', [adventureController::class, 'woods'])->name('user.adventure.woods');
        Route::get('/adventure/Orcs_valley', [adventureController::class, 'Orcs_valley'])->name('user.adventure.Orcs_valley');
    });

    //Admin
    Route::group(['middleware'=>['adminPower']], function(){
        //Monsters
    Route::get('/admin/monster/add', [monsterController::class, 'add'])->name('monster.add');
    Route::post('/admin/monster/save', [monsterController::class, 'save'])->name('monster.save');
    Route::post('/admin/monster/drop/add', [monsterController::class, 'save'])->name('monster.drop.add');
        //Items
    Route::get('/admin/item/add', [itemController::class, 'add'])->name('item.add');
    Route::post('/admin/item/save', [itemController::class, 'save'])->name('item.save');
    });
});
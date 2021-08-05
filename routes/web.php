<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\mainController;
use App\Http\Controllers\authController;
use App\Http\Controllers\monsterController;


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
    });

    //Admin
    Route::get('/admin/monster/add', [monsterController::class, 'add'])->name('monster.add');
    Route::post('/admin/monster/add', [monsterController::class, 'save'])->name('monster.save');
});

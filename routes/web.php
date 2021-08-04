<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\mainController;
use App\Http\Controllers\authController;


Route::get('/auth/logout', [authController::class, 'logout'])->name('auth.logout');


Route::post('/auth/save', [authController::class, 'save'])->name('auth.save');
Route::post('/auth/check', [authController::class, 'check'])->name('auth.check');

Route::group(['middleware'=>['authCheck']], function(){
    Route::get('/', [mainController::class, 'login']);
    Route::get('/login', [mainController::class, 'login'])->name('auth.login');
    Route::get('/register', [mainController::class, 'register'])->name('auth.register');


    //User
    Route::group(['middleware'=>['lvlCheck']], function(){
        Route::get('/profile', [mainController::class, 'profile'])->name('user.profile');
    });

    //Admin
});

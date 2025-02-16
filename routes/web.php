<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('index-without-login');
});
Route::get('/register',[AuthController::class, 'register'])->name('register');
Route::post('/register',[AuthController::class, 'handleRegister'])->name('handleRegister');
Route::get('/login',[AuthController::class, 'login'])->name('login');
Route::post('/login',[AuthController::class, 'handleLogin'])->name('handleLogin');
Route::get('/logout',[AuthController::class,'logout'])->name('logout');


Route::get('/index',[AuthController::class, 'index'])->name('index');



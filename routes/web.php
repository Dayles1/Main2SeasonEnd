<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('index-without-login');
});
Route::get('/register',[AuthController::class, 'register'])->name('register');
Route::post('/register',[AuthController::class, 'handleRegister'])->name('handleRegister');
Route::get('/login',[AuthController::class, 'login'])->name('login');
Route::post('/login',[AuthController::class, 'handleLogin'])->name('handleLogin');
Route::get('/logout',[AuthController::class,'logout'])->name('logout');

Route::middleware('checkAuth')->group(function () {

    Route::get('/index',[AuthController::class, 'index'])->name('index');
    Route::get('/profile',[UserController::class, 'profile'])->name('profile');
    Route::get('/about',[UserController::class, 'welcome'])->name('welcome');
    Route::get('/create',[PostController::class, 'create'])->name('create');
    Route::post('/create',[PostController::class, 'store'])->name('store');








});




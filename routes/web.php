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
Route::post('/logout',[AuthController::class,'logout'])->name('logout');

Route::middleware('checkAuth')->group(function () {
    Route::resource('posts', PostController::class);
    Route::get('/index',[AuthController::class, 'index'])->name('index');
    Route::get('/profile',[UserController::class, 'profile'])->name('profile');
    Route::get('/about',[UserController::class, 'welcome'])->name('welcome');
    Route::get('/profile/{username}',[UserController::class, 'show'])->name('user');

    Route::get('/edit',[UserController::class,'edit'])->name('profile.edit');
    Route::get('/posts/followed',[PostController::class,'followed'])->name('posts.followed');










});




<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NotificationController;

Route::get('/', function () {
    return view('index-without-login');
});
Route::get('/register',[AuthController::class, 'register'])->name('register');
Route::post('/register',[AuthController::class, 'handleRegister'])->name('handleRegister');
Route::get('/login',[AuthController::class, 'login'])->name('login');
Route::post('/login',[AuthController::class, 'handleLogin'])->name('handleLogin');

Route::get('/verify-email', [AuthController::class, 'verifyEmail'])->name('verify.email');



Route::get('/about',[UserController::class, 'welcome'])->name('welcome');

Route::get('/all',[PostController::class,'all'])->name('posts.all');


Route::middleware('checkAuth')->group(function () {
    Route::resource('posts', PostController::class);
    Route::get('/index',[AuthController::class, 'index'])->name('index');
    Route::get('/profile',[UserController::class, 'profile'])->name('profile');
    Route::get('/profile/{username}',[UserController::class, 'show'])->name('user');
    Route::get('/edit',[UserController::class,'edit'])->name('profile.edit');
    Route::post('/logout',[AuthController::class,'logout'])->name('logout');
    Route::post('/follow/{id}',[FollowController::class,'follow'])->name('follow');
    Route::post('/unfollow/{id}',[FollowController::class,'unfollow'])->name('unfollow');
    Route::patch('/update',[UserController::class,'update'])->name('profile.update');
    Route::get('/Home',[PostController::class,'followedPosts'])->name('posts.followed');

    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');

    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    

    Route::get('notifications/{id}', [NotificationController::class, 'markAsRead'])->name('notifications.read');







});



Route::get('/postsAll',[PostController::class,'all'])->name('posts.all');

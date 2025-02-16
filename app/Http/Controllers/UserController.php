<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile(){
        return view('my-profile');
    }
    public function welcome()
    {
        return view('index-without-login');
    }
    public function show($username){
        $user = User::where('username', $username)->firstOrFail();
        return view('user-profile',compact('user'));
    }
}

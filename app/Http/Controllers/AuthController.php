<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Mail\SendEmailVerification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    public function register()
    {
        return view('register');
    }
    public function handleRegister(RegisterRequest $request)
    {
        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $avatar = $request->file('avatar');
            $avatarName = time() . '-' . $avatar->getClientOriginalName();
            $path = $avatar->storeAs('public/uploads', $avatarName);
    
            $avatarPath = 'storage/uploads/' . $avatarName;
        } else {
            $avatarPath = 'storage/default/default-avatar.png';
        }
    
        $user = User::create([
            'username' => $request->username, 
            'name' => $request->name,
            'email' => $request->email,
            'verification_token' => Str::random(64),
            'password' => Hash::make($request->password),
            'avatar' => $avatarPath,
        ]);
    /////////////////////////////////////////////

    //////////////////////////////////////////
        Auth::login($user);
        
        return redirect()->route('index');
    }
    
    public function login()
    {
        return view('login');
    }
    public function handleLogin(LoginRequest $request)
{
    if (Auth::attempt([
        'email' => $request->email,
        'password' => $request->password
    ])) {
        return redirect()->route('index'); 
    } else {
        return back()->withErrors([
            'email' => 'Invalid login credentials.'
        ]);
    }
}


    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
    public function index(){
        return view('index');
    }
}

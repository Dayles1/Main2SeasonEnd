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
        
            $path = $avatar->storeAs('uploads', $avatarName, 'public');
        
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
Mail::to($request->email)->send(new SendEmailVerification($user));
    //////////////////////////////////////////
        // Auth::login($user);
        
        return redirect()->route('login')->with('success','Emailga habar jonatildi');
    }
    
    public function login()
    {
        return view('login');
    }
    public function handleLogin(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if (!$user->email_verified_at) {
                Auth::logout();
                return back()->withErrors(['email'=> 'Email tasdiqlanmagan']);
            }

            return redirect()->route('posts.all');
        }

        return back()->withErrors(['email'=> 'Email yoki Parol notogri']);
    }




    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
    
   
    public function verifyEmail(Request $request)
    {
        $token = $request->query('token');
        
        $user = User::where('verification_token', $token)->first();

        if (!$user) {
            return redirect()->route('login')->withErrors(['email'=> 'Noto tasdiqlandi']);
        }

        $user->email_verified_at = now();
        $user->save();

        return redirect()->route('login')->with('success', 'Email tasdiqlandi');
    }



}
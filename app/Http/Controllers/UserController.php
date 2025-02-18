<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileUpdateRequest;

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
    public function edit()
    {
        return view('edit-profile');
    }
    public function update(ProfileUpdateRequest $request)
{
    $user=Auth()->user();
if (!Hash::check($request->old_password, $user->password)) {
    return back()->withErrors(['old_password' => 'Parol notogri']);
}

if (!empty($request->new_password)) {
    $password = Hash::make($request->new_password);
} else {
    $password = $user->password;
}

if ($password !== $user->password) {
    $user->password = $password;
}



    $updateUser=User::findOrFail($user->id);
    

    if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
        if ($user->avatar !== 'storage/default/default-avatar.png') {
            if (file_exists(public_path($user->avatar))) {
                unlink(public_path($user->avatar));
            }
        }
        $avatar = $request->file('avatar');
        $avatarName = time() . '-' . $avatar->getClientOriginalName();
        $path = $avatar->storeAs('uploads', $avatarName, 'public');
        $avatarPath = 'storage/uploads/' . $avatarName;
    
    }
    
   
    $updateUser->update([
        'username' => $request->username, 
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password,
            'avatar' => $avatarPath,

    ]);

        
    return redirect()->route('profile');
}
}
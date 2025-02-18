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
    if ($request->has('new_password')) {
        $password = Hash::make($request->new_password);
    }
    else{
        $password=$user->password;
    }
    $updateUser=User::findOrFail($user->id);
    

    if ($request->hasFile('avatar') && $request->file('image')->isValid() && $user->image !== 'storage/default/default-avatar.png') {
        unlink( $user->image);
        $avatar = $request->file('avatar');
            $avatarName = time() . '-' . $avatar->getClientOriginalName();
            $path = $avatar->storeAs('uploads', $avatarName, 'public');
            $avatarPath = 'storage/uploads/' . $avatarName;
    }
    else {
        $avatarPath = 'storage/default/default-avatar.png';
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
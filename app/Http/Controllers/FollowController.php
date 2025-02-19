<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NewFollowerNotification;

class FollowController extends Controller
{
    public function follow(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->followers()->attach(auth()->user()->id);

        
        $user->notify(new NewFollowerNotification(Auth::user()));
        return back();
    }
    



public function unfollow( $id)
{
    $user = User::findOrFail($id);

   

    auth()->user()->following()->detach($user->id);

    return back();
}

}

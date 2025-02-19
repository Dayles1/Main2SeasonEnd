<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function unReadNorification ($username){
        $user=User::where('username', $username)->first();
        
return view('user-profile',compact('user'));
}






    public function markAsRead($id)
    {
        $notification = Auth::user()->notifications()->find($id);
        
        if ($notification) {
            $notification->markAsRead();
            
            if ($notification->data['type'] == 'follow') {
                return redirect()->route('user', $notification->data['username']);
            } elseif ($notification->data['type'] == 'comment') {
                return redirect()->route('posts.show', $notification->data['post_id']);
            }
        }
        
        return redirect()->back();
    }
}



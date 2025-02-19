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
    public function read($id){
        $notification=Auth::user()->unReadNorification->where('id',$id)->first();
        $notification->markAsRead();
        if($notification->data['type']=='follow'){
            return redirect()->route('user',$notification->data['username']);
        }
        elseif($notification->data['type']=='comment'){
            return redirect()->toutr('posts.show', $notification->data['post_id']);
        }
    }
}

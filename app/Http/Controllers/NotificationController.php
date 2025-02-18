<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class NotificationController extends Controller
{
    public function index(){
    $notifications= auth()->user()->notifications;
        return view('notifications',compact('notifications'));
}




public function readAll(){
    auth()->user()->unreadNotifications->markAsRead();

    return back();
    
}
public function markAsRead($id)
{
    $notification = Notification::findOrFail($id);
    
    $notification->markAsRead();
    
    return redirect()->route('profile'); 
}
}

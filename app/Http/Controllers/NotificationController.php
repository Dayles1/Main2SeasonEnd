<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}

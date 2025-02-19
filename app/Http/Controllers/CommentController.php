<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreCommentRequest;
use App\Notifications\NewCommentNotification;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request)
    {
        $comment = Comment::create([
            'comment' => $request->comment,
            'commentable_id' => $request->commentable_id,   //post->id
            'commentable_type' => $request->commentable_type, //type
            'user_name' => Auth::user()->name,
        ]);
    
        $comment->commentable->user->notify(new NewCommentNotification($comment));
    
        return back();
    }
    
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->back();
    }
}

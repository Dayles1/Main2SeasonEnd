<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreCommentRequest;

class CommentController extends Controller
{
   
    public function store(StoreCommentRequest $request)
    {
    

        Comment::create([
            'comment' => $request->comment,
            'commentable_id' => $request->commentable_id,
            'commentable_type' => $request->commentable_type,
            'user_name' => Auth::user()->name,
        ]);

        return back();
    }
    public function destroy(Comment $comment)
    {
      

        $comment->delete();

        return redirect()->back();
    }
}


<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('index', compact('posts'));
    }
  

    public function create()
    {
        return view('create-post');
    }

    public function store(StorePostRequest $request)
    {
       

        $post = new Post();
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->user_id = Auth::id();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads', 'public');
            $post->image = $imagePath;
        }

        $post->save();

        return redirect()->route('profile');
    }

    public function show(Post $post)
    {
        return view('show-post', compact('post'));
    }
    public function guestShow( $id)
    {
        $post=Post::findOrFail($id);
        
        return view('show-post', compact('post'));
    }

    public function edit(Post $post)
    {
        if(auth()->user()->id !== $post->user_id){
            return back();
        }
        return view('edit-post', compact('post'));
    }

    public function update(UpdatePostRequest $request, Post $post)
    { 

        
 
        $post->title = $request->input('title');
        $post->description = $request->input('description');

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads', 'public');
            $post->image = $imagePath;
        }

        $post->save();

        return redirect()->route('posts.index');
    }

    public function destroy(Post $post)
    {
        if ($post->image && file_exists(storage_path('app/public/' . $post->image))) {
            unlink(storage_path('app/public/' . $post->image));
        }

        $post->delete();
        return redirect()->route('profile');
    }
    public function all()
    {
        $posts = Post::all();
        return view('all-posts', compact('posts'));
    }
    public function followedPosts()
    {
        $user = Auth::user();
    
        $posts = Post::whereIn('user_id', $user->following->pluck('id'))->get();
    
        return view('index', compact('posts'));
    }
    

}


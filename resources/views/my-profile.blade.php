@extends('layouts.app')

@section('title','MY Profile')

@section('content')
<main class="flex-grow container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <div class="flex flex-col sm:flex-row items-center mb-4">
                <!-- Avatar -->
                <img src="{{ asset( auth()->user()->avatar) }}" alt="User Avatar"
                    class="w-20 h-20 rounded-full mr-4 mb-4 sm:mb-0">
                <div class="text-center sm:text-left">
                    <h1 class="text-2xl font-bold">{{ auth()->user()->name }}</h1>
                    <h3 class="text-2xl font-bold">{{ auth()->user()->email }}</h1>
                    <p class="text-gray-600">{{ '@' . auth()->user()->username }}</p>
                </div>

                <!-- Edit Profile button -->
                <div class="mt-4 sm:mt-0 sm:ml-auto">
                    <a href="{{route('profile.edit') }}"
                        class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">
                        Edit Profile
                    </a>
                </div>
            </div>

            <div class="flex flex-wrap justify-center sm:justify-start space-x-4">
                <span class="font-semibold">{{ auth()->user()->followers->count() }} Followers</span>
                <span class="font-semibold">{{ auth()->user()->following->count() }} Following</span>
                <span class="font-semibold">{{ auth()->user()->posts->count() }} Posts</span>
            </div>
        </div>

        <!-- My Posts Section -->
        <h2 class="text-2xl font-bold mb-4">My Posts</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse (auth()->user()->posts as $post)
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image"
                        class="w-full h-48 object-cover rounded-lg mb-4">
                    <h3 class="text-xl font-bold mb-2">{{ $post->title }}</h3>
                    <p class="text-gray-700 mb-4">{{ $post->description }}</p>

                    <div class="flex space-x-2">
                        <a href="{{ route('posts.show', $post->id) }}" class="text-indigo-600 hover:text-indigo-800">Read More</a>
                        <a href="{{ route('posts.edit', $post->id) }}" class="text-green-600 hover:text-green-800">Edit</a>
                        <form action="{{route('posts.destroy',$post->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:text-red-800">Delete</button>
                            
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-center w-full text-gray-500">No posts yet.</p>
            @endforelse
        </div>
    </div>
</main>
@endsection

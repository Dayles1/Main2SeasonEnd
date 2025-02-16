@extends('layouts.auth')
@section('auth','Welcome')
@section('content')


<main class="flex-grow container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-md p-8 text-center">
        <h2 class="text-2xl font-bold mb-4">Welcome to BlogSite!</h2>
        <p class="text-lg text-gray-500 mb-8">Please <a class="text-indigo-500 hover:text-indigo-700 underline"
                href="{{route('login')}}">Log in</a> or <a class="text-indigo-500 hover:text-indigo-700 underline"
                href="{{route('register')}}">Sign up</a> to view all posts.</p>
    </div>
</main>

   
@endsection
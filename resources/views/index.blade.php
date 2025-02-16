@extends('layouts.app')
@section('title','BlogSite')
@section('content')
    

    


<main class="flex-grow container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Followed Posts</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <img src="./images/post-image.png" alt="Post Image" class="w-full h-48 object-cover rounded-lg mb-4">
            <h2 class="text-xl font-bold mb-2">Post Title 1</h2>
            <p class="text-gray-700 mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua.</p>
            <p class="text-gray-700 mb-4">By <a href="./user-profile.html"
                    class="text-indigo-600 hover:text-indigo-800">Azizbek</a>
            </p>
            <a href="show-post.html" class="text-indigo-600 hover:text-indigo-800">Read More</a>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <img src="./images/post-image.png" alt="Post Image" class="w-full h-48 object-cover rounded-lg mb-4">
            <h2 class="text-xl font-bold mb-2">Post Title 2</h2>
            <p class="text-gray-700 mb-4">Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                aliquip ex ea commodo consequat.</p>
            <p class="text-gray-700 mb-4">By <a href="./user-profile.html"
                    class="text-indigo-600 hover:text-indigo-800">Azizbek</a>
            </p>
            <a href="show-post.html" class="text-indigo-600 hover:text-indigo-800">Read More</a>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <img src="./images/post-image.png" alt="Post Image" class="w-full h-48 object-cover rounded-lg mb-4">
            <h2 class="text-xl font-bold mb-2">Post Title 3</h2>
            <p class="text-gray-700 mb-4">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                dolore eu fugiat nulla pariatur.</p>
            <p class="text-gray-700 mb-4">By <a href="./user-profile.html"
                    class="text-indigo-600 hover:text-indigo-800">Azizbek</a>
            </p>
            <a href="show-post.html" class="text-indigo-600 hover:text-indigo-800">Read More</a>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <img src="./images/post-image.png" alt="Post Image" class="w-full h-48 object-cover rounded-lg mb-4">
            <h2 class="text-xl font-bold mb-2">Post Title 4</h2>
            <p class="text-gray-700 mb-4">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                deserunt mollit anim id est laborum.</p>
            <p class="text-gray-700 mb-4">By <a href="./user-profile.html"
                    class="text-indigo-600 hover:text-indigo-800">Azizbek</a>
            </p>
            <a href="show-post.html" class="text-indigo-600 hover:text-indigo-800">Read More</a>
        </div>
    </div>
</main>
@endsection
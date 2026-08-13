<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @auth
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Welcome, {{ auth()->user()->name }}</h3>
                        <p class="text-sm text-gray-500">Quick actions and recent posts</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('feed') }}" class="px-3 py-2 bg-gray-100 dark:bg-gray-700 rounded text-sm">View Feed</a>
                        <a href="{{ route('posts.create') }}" class="px-3 py-2 bg-blue-600 text-white rounded text-sm">Create Post</a>
                    </div>
                </div>

                <div>
                    <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">Your latest posts</h4>
                    @php
                        $latest = auth()->user()->posts()->latest()->take(3)->get();
                    @endphp

                    @if($latest->isEmpty())
                        <div class="p-4 bg-white dark:bg-gray-800 shadow rounded">You have no posts yet. Create your first post!</div>
                    @else
                        <div class="space-y-4">
                            @foreach($latest as $post)
                                <x-post-card :post="$post" />
                            @endforeach
                        </div>
                    @endif
                </div>
            @else
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <p class="text-gray-900 dark:text-gray-100 mb-4">You are not logged in.</p>
                    <div class="space-x-2">
                        <a href="{{ route('login') }}" class="px-3 py-2 bg-gray-100 dark:bg-gray-700 rounded text-sm">Login</a>
                        <a href="{{ route('register') }}" class="px-3 py-2 bg-blue-600 text-white rounded text-sm">Register</a>
                    </div>
                </div>
            @endauth
        </div>
    </div>
</x-app-layout>

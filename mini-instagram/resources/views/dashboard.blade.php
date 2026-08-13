<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Yuk Buat Potingan dan Berkomentar') }}
        </h2>
        <h1 class="text-sm text-gray-500 mt-1">
            {{ __('Selamat datang di mini Instagram! Buat postingan dan berinteraksi dengan teman-temanmu.') }}
        </h1>
        <h1 class="text-sm text-gray-500 mt-1">
            {{ __('ayok jadi salah satu manusia yang mengutarakan apa yang di ingin kan!') }}

    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="space-y-8">
                @forelse ($posts as $post)
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <!-- Post Header -->
                            <div class="flex items-center mb-4">
                                <img class="h-10 w-10 rounded-full object-cover" src="{{ $post->user->profile_photo_url ?? 'https://ui-avatars.com/api/?name='.urlencode($post->user->name) }}" alt="{{ $post->user->name }}">
                                <div class="ml-3 font-bold">{{ $post->user->name }}</div>
                            </div>

                            <!-- Post Image -->
                            <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="w-full rounded-lg mb-4">

                            <!-- Post Caption -->
                            <p><span class="font-bold">{{ $post->user->name }}</span> {{ $post->caption }}</p>
                            <div class="text-sm text-gray-500 mt-2">{{ $post->created_at->diffForHumans() }}</div>

                            <!-- Comments Section -->
                            <div class="mt-4 border-t border-gray-200 dark:border-gray-700 pt-4">
                                @foreach ($post->comments as $comment)
                                    <div class="mb-2">
                                        <p><span class="font-bold">{{ $comment->user->name }}</span> {{ $comment->body }}</p>
                                        <div class="text-xs text-gray-500 mt-1">{{ $comment->created_at->diffForHumans() }}</div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Add Comment Form -->
                            <form action="{{ route('comments.store') }}" method="POST" class="mt-4 border-t border-gray-200 dark:border-gray-700 pt-4">
                                @csrf
                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                <div class="flex items-center">
                                    <textarea name="body" rows="1" class="block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" placeholder="Add a comment..."></textarea>
                                    <x-primary-button class="ml-3">
                                        {{ __('Kirim') }}
                                    </x-primary-button>
                                </div>
                                <x-input-error :messages="$errors->get('body')" class="mt-2" />
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100 text-center">
                            No posts yet. Create your first post!
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>

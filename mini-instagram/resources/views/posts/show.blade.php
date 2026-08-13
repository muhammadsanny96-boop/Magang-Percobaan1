<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Post') }}
            </h2>
            <a href="{{ route('dashboard') }}" class="text-blue-500 hover:text-blue-700 font-semibold">
                ← Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            @if ($message = Session::get('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ $message }}
                </div>
            @endif

            <!-- Post -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <!-- Header -->
                <div class="border-b border-gray-200 p-6 flex justify-between items-center">
                    <div class="flex items-center">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($post->user->name) }}"
                             alt="{{ $post->user->name }}" class="w-10 h-10 rounded-full mr-3">
                        <span class="text-gray-700 font-semibold">{{ $post->user->name }}</span>
                    </div>
                    @if (Auth::id() === $post->user_id)
                        <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Yakin hapus post ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 font-semibold">Hapus</button>
                        </form>
                    @endif
                </div>

                <!-- Image -->
                <div class="w-full">
                    <img src="{{ Storage::url($post->image) }}" alt="Post image" class="w-full h-auto object-cover">
                </div>

                <!-- Caption & Info -->
                <div class="p-6 border-b border-gray-200">
                    <p class="text-gray-700 mb-2">
                        <span class="font-semibold">{{ $post->user->name }}</span> {{ $post->caption }}
                    </p>
                    <p class="text-gray-500 text-sm">
                        {{ $post->created_at->diffForHumans() }}
                    </p>
                </div>
            </div>

            <!-- Comments Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-6">
                        Komentar ({{ $post->comments->count() }})
                    </h3>

                    @if (Auth::check())
                        <!-- Form Add Comment -->
                        <form action="{{ route('comments.store', $post) }}" method="POST" class="mb-6 pb-6 border-b border-gray-200">
                            @csrf
                            <div class="flex gap-3">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}"
                                     alt="{{ Auth::user()->name }}" class="w-8 h-8 rounded-full">
                                <div class="flex-1">
                                    <textarea
                                        name="comment"
                                        rows="2"
                                        class="w-full shadow appearance-none border border-gray-300 rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('comment') border-red-500 @enderror"
                                        placeholder="Tambahkan komentar..."
                                        required></textarea>
                                    @error('comment')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                    <button type="submit" class="mt-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded text-sm">
                                        Kirim
                                    </button>
                                </div>
                            </div>
                        </form>
                    @else
                        <div class="mb-6 pb-6 border-b border-gray-200">
                            <p class="text-gray-600">
                                <a href="{{ route('login') }}" class="text-blue-500 hover:text-blue-700 font-semibold">Login</a>
                                untuk menambahkan komentar.
                            </p>
                        </div>
                    @endif

                    <!-- List Comments -->
                    @forelse ($post->comments as $comment)
                        <div class="mb-4 pb-4 border-b border-gray-200 last:border-b-0">
                            <div class="flex justify-between items-start mb-2">
                                <div class="flex items-center gap-2">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($comment->user->name) }}"
                                         alt="{{ $comment->user->name }}" class="w-8 h-8 rounded-full">
                                    <div>
                                        <p class="text-gray-700 font-semibold">{{ $comment->user->name }}</p>
                                        <p class="text-gray-500 text-xs">
                                            {{ $comment->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>
                                @if (Auth::id() === $comment->user_id)
                                    <form action="{{ route('comments.destroy', $comment) }}" method="POST" onsubmit="return confirm('Hapus komentar ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-semibold">
                                            Hapus
                                        </button>
                                    </form>
                                @endif
                            </div>
                            <p class="text-gray-700 ml-10">{{ $comment->comment }}</p>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">
                            Belum ada komentar. Jadilah yang pertama!
                        </p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

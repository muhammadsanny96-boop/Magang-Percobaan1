<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yuk Komentar</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

    <div class="container mx-auto p-4 md:p-8 max-w-3xl">

        <nav class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-700">Yuk Komentar</h1>
            <div class="flex items-center space-x-4">
                @auth
                    <div class="flex items-center space-x-2">
                        <span>Halo, <strong>{{ auth()->user()->name }}</strong></span>
                        <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                            {{ auth()->user()->comments()->count() }} Komentar
                        </span>
                        <a href="{{ route('comments.my') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded">
                            Komentar Saya
                        </a>
                        <a href="{{ route('posts.create') }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                            Buat Postingan
                        </a>

                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Login</a>
                    <a href="{{ route('register') }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">Register</a>
                @endauth
            </div>
        </nav>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @auth
            <div class="bg-white p-6 rounded-lg shadow-md mb-8">
                <form action="{{ route('comments.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="body" class="block text-gray-700 text-sm font-bold mb-2">Tulis Komentar:</label>
                        <textarea name="body" id="body" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('body') border-red-500 @enderror" required>{{ old('body') }}</textarea>
                        @error('body')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex items-center justify-end">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Kirim
                        </button>
                    </div>
                </form>
            </div>
        @else
            <div class="bg-blue-100 border-t-4 border-blue-500 rounded-b text-blue-900 px-4 py-3 shadow-md mb-8" role="alert">
                <p class="font-bold">Silakan <a href="{{ route('login') }}" class="underline">login</a> untuk menulis komentar.</p>
            </div>
        @endauth

        <div class="space-y-6">
            @forelse ($comments as $comment)
                <div class="bg-white p-5 rounded-lg shadow">
                    <p class="text-gray-800">{{ $comment->body }}</p>
                    <div class="text-sm text-gray-500 mt-3 flex justify-between items-center">
                        <span>Oleh: <strong>{{ $comment->user->name }}</strong></span>
                        <span>{{ $comment->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-500">Belum ada komentar.</p>
            @endforelse
        </div>
    </div>

</body>
</html>

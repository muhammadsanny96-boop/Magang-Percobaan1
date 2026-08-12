<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Komentar Saya</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

    <div class="container mx-auto p-4 md:p-8 max-w-3xl">

        <nav class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-700">Riwayat Komentar Saya</h1>
            <a href="{{ route('comments.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Kembali ke Yuk Komentar</a>
        </nav>

        <div class="space-y-6">
            @forelse ($comments as $comment)
                <div class="bg-white p-5 rounded-lg shadow">
                    <p class="text-gray-800">{{ $comment->body }}</p>
                    <div class="text-sm text-gray-500 mt-3 flex justify-between items-center">
                        <span>Oleh: <strong>{{ $comment->created_at->format('d F Y H:i') }}</strong></span>
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

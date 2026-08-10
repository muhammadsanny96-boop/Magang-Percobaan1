<div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md p-8 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6 text-center">Masuk</h2>

        @if (session('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

    </div class="w-full max-w-md p-8 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6 text-center">Masuk</h2>

        @if (session('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}">
            @error('email') <p>{{ $message }}</p> @enderror

            <input type="password" name="password" placeholder="Password">
            @error('password') <p>{{ $message }}</p> @enderror

            <button type="submit">Masuk</button>
        </form>

        <p>
            Belum punya akun?
            <a href="{{ route('register') }}">Daftar</a>
        </p>
    </div>
</div>

@extends('layouts.app', ['title' => 'Masuk - Komentar'])

@section('content')
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-md">
            <div class="text-center mb-8">
                <a href="{{ route('comments.index') }}" class="text-2xl font-black tracking-tight inline-block" style="color:#1b1b18">💬 COBA</a>
            </div>

            <div class="border-4 border-black bg-white rounded-2xl p-6 sm:p-8 shadow-[6px_6px_0_#1b1b18]">
                <h2 class="text-3xl font-black mb-1 text-center" style="color:#1b1b18">Selamat Datang!</h2>
                <p class="text-center text-lg mb-6" style="color:#55524a">Silakan masuk ke akun Anda.</p>

                @if (session('error'))
                    <div class="border-2 border-black bg-red-200 text-red-800 font-bold px-4 py-3 rounded-xl mb-4 shadow-[3px_3px_0_#000]">
                        <span class="mr-2">❌</span> {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="email" class="block font-bold mb-2 text-sm">Email <span class="text-red-600">*</span></label>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            placeholder="contoh@email.com"
                            class="w-full border-2 border-black rounded-xl px-4 py-3 font-medium focus:outline-none focus:ring-4 focus:ring-amber-300"
                            style="background:#fdfcf7"
                        />
                        @error('email')
                            <p class="mt-2 text-sm font-bold text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block font-bold mb-2 text-sm">Password <span class="text-red-600">*</span></label>
                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            placeholder="••••••••"
                            class="w-full border-2 border-black rounded-xl px-4 py-3 font-medium focus:outline-none focus:ring-4 focus:ring-amber-300"
                            style="background:#fdfcf7"
                        />
                        @error('password')
                            <p class="mt-2 text-sm font-bold text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <button
                        type="submit"
                        class="w-full bg-amber-400 hover:bg-amber-300 active:translate-y-0.5 active:shadow-[2px_2px_0_#000] border-2 border-black text-black font-black text-base px-6 py-3 rounded-xl shadow-[4px_4px_0_#000] transition-all cursor-pointer"
                    >
                        Masuk
                    </button>
                </form>

                <p class="mt-6 text-center text-sm font-medium" style="color:#55524a">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="font-bold text-amber-600 hover:underline">Daftar di sini</a>
                </p>
            </div>
        </div>
    </div>
@endsection

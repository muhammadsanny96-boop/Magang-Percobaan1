<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">


        @if (session('status') || session('success'))
    <div x-data="{ show: true }"
         x-show="show"
         class="mb-4 flex items-center justify-between rounded-xl border-2 border-black bg-lime-300 p-4 font-bold text-black shadow-[3px_3px_0px_0px_rgba(0,0,0,1)]">

        <div class="flex items-center gap-2">
            <span>✅</span>
            <span>{{ session('status') ?? session('success') }}</span>
        </div>

        {{-- Tombol Close X --}}
        <button @click="show = false" class="ml-4 font-black hover:opacity-75">
            ✕
        </button>
    </div>
@endif


        <title>Komentar</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700,900" rel="stylesheet" />

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                :root{--font-sans:'Instrument Sans',ui-sans-serif,system-ui,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji"}
                *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
                body{font-family:var(--font-sans);background:#f7f3e9;color:#1b1b18}

                .min-h-screen{min-height:100vh}
                .py-10{padding-top:2.5rem;padding-bottom:2.5rem}
                .px-4{padding-left:1rem;padding-right:1rem}
                .max-w-3xl{max-width:48rem;margin-left:auto;margin-right:auto}
                .text-4xl{font-size:2.25rem;line-height:1.1}
                .font-black{font-weight:900}
                .mb-2{margin-bottom:.5rem}
                .tracking-tight{letter-spacing:-.025em}
                .text-lg{font-size:1.125rem;line-height:1.6}
                .mb-8{margin-bottom:2rem}
                .border-2{border:2px solid #000}
                .border-4{border:4px solid #000}
                .border-dashed{border-style:dashed}
                .bg-lime-300{background:#bef264}
                .font-bold{font-weight:700}
                .px-4{padding-left:1rem;padding-right:1rem}
                .px-3{padding-left:.75rem;padding-right:.75rem}
                .px-6{padding-left:1.5rem;padding-right:1.5rem}
                .py-1{padding-top:.25rem;padding-bottom:.25rem}
                .py-3{padding-top:.75rem;padding-bottom:.75rem}
                .rounded-xl{border-radius:.75rem}
                .rounded-2xl{border-radius:1rem}
                .rounded-full{border-radius:9999px}
                .mb-6{margin-bottom:1.5rem}
                .shadow-\[4px_4px_0_#000\]{box-shadow:4px 4px 0 #000}
                .shadow-\[6px_6px_0_#1b1b18\]{box-shadow:6px 6px 0 #1b1b18}
                .bg-white{background:#fff}
                .p-6{padding:1.5rem}
                .p-10{padding:2.5rem}
                .p-4{padding:1rem}
                .mb-10{margin-bottom:2.5rem}
                .mb-4{margin-bottom:1rem}
                .block{display:block}
                .text-sm{font-size:.875rem}
                .w-full{width:100%}
                .font-medium{font-weight:500}
                .resize-none{resize:none}
                .leading-relaxed{line-height:1.625}
                .whitespace-pre-wrap{white-space:pre-wrap}
                .break-words{overflow-wrap:break-word}
                .bg-amber-400{background:#fbbf24}
                .text-base{font-size:1rem}
                .text-2xl{font-size:1.5rem;line-height:1.3}
                .flex{display:flex}
                .items-center{align-items:center}
                .justify-between{justify-content:space-between}
                .gap-2{gap:.5rem}
                .flex-wrap{flex-wrap:wrap}
                .text-xs{font-size:.75rem}
                .bg-black{background:#000}
                .text-white{color:#fff}
                .text-red-600{color:#dc2626}
                .mt-2{margin-top:.5rem}
                .text-center{text-align:center}
                .inline-block{display:inline-block}
                .cursor-pointer{cursor:pointer}
                .transition-all{transition:all .15s ease}
                input,textarea{font-family:inherit;font-size:1rem;color:#1b1b18;border:2px solid #000;border-radius:.75rem;padding:.75rem 1rem;width:100%;background:#fdfcf7;font-weight:500}
                input:focus,textarea:focus{outline:none;box-shadow:0 0 0 4px #fcd34d}
                textarea{resize:none}
                button{cursor:pointer}
                .btn-kirim{display:inline-block;background:#fbbf24;border:2px solid #000;color:#000;font-weight:900;font-size:1rem;padding:.75rem 1.5rem;border-radius:.75rem;box-shadow:4px 4px 0 #000;transition:all .15s ease}
                .btn-kirim:hover{background:#fcd34d}
                .btn-kirim:active{transform:translateY(2px);box-shadow:2px 2px 0 #000}
                .kartu-komentar{border:2px solid #000;border-radius:.75rem;padding:1rem;margin-bottom:1rem;box-shadow:3px 3px 0 #000}
                .kartu-kosong{border:2px dashed #000;border-radius:1rem;padding:2.5rem;text-align:center}
            </style>
        @endif
    </head>
    <body class="min-h-screen py-10 px-4">
        <main class="max-w-3xl mx-auto">
            {{-- Status login / logout --}}
            <div class="flex items-center justify-between gap-2 mb-8 flex-wrap">
                @auth
                    <p class="font-bold">
                         Halo, <span class="text-amber-600">{{ auth()->user()->name }}</span>!
                    </p>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button
                            type="submit"
                            class="inline-block bg-white hover:bg-amber-300 active:translate-y-0.5 active:shadow-[2px_2px_0_#000] border-2 border-black text-black font-black text-sm px-4 py-2 rounded-xl shadow-[4px_4px_0_#000] transition-all cursor-pointer"
                        >
                            Keluar
                        </button>
                    </form>
                @else
                    <p class="font-bold" style="color:#55524a">Belum login.</p>
                    <div class="flex items-center gap-2">
                        <a
                            href="{{ route('login') }}"
                            class="inline-block bg-amber-400 hover:bg-amber-300 active:translate-y-0.5 active:shadow-[2px_2px_0_#000] border-2 border-black text-black font-black text-sm px-4 py-2 rounded-xl shadow-[4px_4px_0_#000] transition-all cursor-pointer"
                        >
                            Masuk
                        </a>
                        <a
                            href="{{ route('register') }}"
                            class="inline-block bg-white hover:bg-amber-300 active:translate-y-0.5 active:shadow-[2px_2px_0_#000] border-2 border-black text-black font-black text-sm px-4 py-2 rounded-xl shadow-[4px_4px_0_#000] transition-all cursor-pointer"
                        >
                            Daftar
                        </a>
                    </div>
                @endauth
            </div>

            <h1 class="text-4xl font-black mb-2 tracking-tight" style="color:#1b1b18">💬 Komentar</h1>
            <p class="text-lg mb-8" style="color:#55524a">Tulis komentarmu, history-nya tercatat di bawah.</p>

            @if (session('success'))
                <div class="border-2 border-black bg-lime-300 text-black font-bold px-4 py-3 rounded-xl mb-6 shadow-[4px_4px_0_#000]">
                    ✅ {{ session('success') }}
                </div>
            @endif

            {{-- Form Komentar --}}
            <form method="POST" action="{{ route('comments.store') }}" class="border-4 border-black bg-white rounded-2xl p-6 mb-10 shadow-[6px_6px_0_#1b1b18]">
                @csrf

                <div class="mb-4">
                    <label for="body" class="block font-bold mb-2 text-sm">Komentar sebagai <span class="text-amber-600">{{ auth()->user()?->name ?? 'Tamu' }}</span><span class="text-red-600">*</span></label>
                    <textarea
                        id="body"
                        name="body"
                        rows="4"
                        maxlength="2000"
                        required
                        placeholder="Tulis komentarmu di sini..."
                        class="w-full border-2 border-black rounded-xl px-4 py-3 font-medium focus:outline-none focus:ring-4 focus:ring-amber-300 resize-none"
                        style="background:#fdfcf7"
                    >{{ old('body') }}</textarea>
                    @error('body')
                        <p class="mt-2 text-sm font-bold text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <button
                    type="submit"
                    class="inline-block bg-amber-400 hover:bg-amber-300 active:translate-y-0.5 active:shadow-[2px_2px_0_#000] border-2 border-black text-black font-black text-base px-6 py-3 rounded-xl shadow-[4px_4px_0_#000] transition-all cursor-pointer"
                >
                    Kirim Komentar
                </button>
            </form>

            {{-- History Komentar --}}
            <section>
                <h2 class="text-2xl font-black mb-4 flex items-center gap-2">
                     Riwayat Komentar
                    <span class="bg-black text-white text-sm font-bold px-3 py-1 rounded-full">{{ $comments->count() }}</span>
                </h2>

                @forelse ($comments as $comment)
                    <article class="border-2 border-black rounded-xl p-4 mb-4 shadow-[3px_3px_0_#000]" style="background:{{ $loop->iteration % 2 ? '#fdfcf7' : '#e7f5ff' }}">
                        <div class="flex items-center justify-between gap-2 mb-2 flex-wrap">
                            <h3 class="font-black">👤 {{ $comment->author }}</h3>
                            <time class="text-xs font-semibold" style="color:#55524a">
                                {{ $comment->created_at->timezone('Asia/Makassar')->format('d M Y, H:i') }}
                            </time>
                        </div>
                        <p class="font-medium leading-relaxed whitespace-pre-wrap break-words">{{ $comment->body }}</p>
                    </article>
                @empty
                    <div class="border-2 border-dashed border-black rounded-2xl p-10 text-center">
                        <p class="text-4xl mb-2"></p>
                        <p class="font-bold text-lg">Belum ada komentar.</p>
                        <p class="font-medium" style="color:#55524a">Jadilah orang pertama yang berkomentar!</p>
                    </div>
                @endforelse
            </section>
        </main>
    </body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Judul halaman akan dinamis, dengan default 'Komentar' --}}
    <title>{{ $title ?? 'Komemtar' }}</title>

    {{-- Link Font --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700,900" rel="stylesheet" />

    {{-- Logika Vite & Fallback CSS --}}
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        {{-- Saya mengambil fallback CSS yang paling lengkap dari comments/index.blade.php --}}
        <style>
            :root{--font-sans:'Instrument Sans',ui-sans-serif,system-ui,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji"}
            *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
            body{font-family:var(--font-sans);background:#f7f3e9;color:#1b1b18}
            .min-h-screen{min-height:100vh} .py-10{padding-top:2.5rem;padding-bottom:2.5rem} .px-4{padding-left:1rem;padding-right:1rem} .max-w-3xl{max-width:48rem;margin-left:auto;margin-right:auto} .max-w-md{max-width:28rem} .text-4xl{font-size:2.25rem;line-height:1.1} .font-black{font-weight:900} .mb-2{margin-bottom:.5rem} .tracking-tight{letter-spacing:-.025em} .text-lg{font-size:1.125rem;line-height:1.6} .mb-8{margin-bottom:2rem} .border-2{border:2px solid #000} .border-4{border:4px solid #000} .border-dashed{border-style:dashed} .bg-lime-300{background:#bef264} .font-bold{font-weight:700} .px-3{padding-left:.75rem;padding-right:.75rem} .px-6{padding-left:1.5rem;padding-right:1.5rem} .py-1{padding-top:.25rem;padding-bottom:.25rem} .py-3{padding-top:.75rem;padding-bottom:.75rem} .rounded-xl{border-radius:.75rem} .rounded-2xl{border-radius:1rem} .rounded-full{border-radius:9999px} .mb-6{margin-bottom:1.5rem} .shadow-\[4px_4px_0_#000\]{box-shadow:4px 4px 0 #000} .shadow-\[6px_6px_0_#1b1b18\]{box-shadow:6px 6px 0 #1b1b18} .bg-white{background:#fff} .p-6{padding:1.5rem} .p-10{padding:2.5rem} .p-4{padding:1rem} .mb-10{margin-bottom:2.5rem} .mb-4{margin-bottom:1rem} .block{display:block} .text-sm{font-size:.875rem} .w-full{width:100%} .font-medium{font-weight:500} .resize-none{resize:none} .leading-relaxed{line-height:1.625} .whitespace-pre-wrap{white-space:pre-wrap} .break-words{overflow-wrap:break-word} .bg-amber-400{background:#fbbf24} .text-base{font-size:1rem} .text-2xl{font-size:1.5rem;line-height:1.3} .flex{display:flex} .items-center{align-items:center} .justify-between{justify-content:space-between} .justify-center{justify-content:center} .gap-2{gap:.5rem} .flex-wrap{flex-wrap:wrap} .text-xs{font-size:.75rem} .bg-black{background:#000} .text-white{color:#fff} .text-red-600{color:#dc2626} .text-red-800{color:#991b1b} .bg-red-200{background:#fecaca} .mt-2{margin-top:.5rem} .mr-2{margin-right:.5rem} .text-center{text-align:center} .inline-block{display:inline-block} .cursor-pointer{cursor:pointer} .transition-all{transition:all .15s ease} .space-y-5 > :not([hidden]) ~ :not([hidden]){margin-top:1.25rem} .focus\:outline-none:focus{outline:none} .focus\:ring-4:focus{box-shadow:0 0 0 4px var(--tw-ring-color)} .focus\:ring-amber-300:focus{--tw-ring-color:#fcd34d} .hover\:bg-amber-300:hover{background:#fcd34d} .active\:translate-y-0\.5:active{transform:translateY(.125rem)} .active\:shadow-\[2px_2px_0_#000\]:active{box-shadow:2px 2px 0 #000} .text-black{color:#000} .mt-6{margin-top:1.5rem} .text-amber-600{color:#d97706} .hover\:underline:hover{text-decoration:underline}
            input,textarea{font-family:inherit;font-size:1rem;color:#1b1b18;border:2px solid #000;border-radius:.75rem;padding:.75rem 1rem;width:100%;background:#fdfcf7;font-weight:500}
            input:focus,textarea:focus{outline:none;box-shadow:0 0 0 4px #fcd34d}
            textarea{resize:none}
        </style>
    @endif
</head>
<body class="min-h-screen bg-[#f7f3e9] text-[#1b1b18]">
    {{-- Konten spesifik halaman akan dimasukkan di sini --}}
    @yield('content')
</body>
</html>

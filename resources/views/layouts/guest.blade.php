<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'LSP Rimbawan') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-stone-900 antialiased">
        <main class="min-h-screen bg-[#edf4ec]">
            <div class="grid min-h-screen lg:grid-cols-[1.05fr_.95fr]">
                <section class="relative hidden overflow-hidden bg-[#123829] px-12 py-10 text-white lg:flex lg:flex-col lg:justify-between">
                    <div class="absolute inset-0 opacity-95">
                        <div class="absolute inset-0 bg-[linear-gradient(135deg,rgba(10,39,27,.96),rgba(31,90,55,.86)),url('https://images.unsplash.com/photo-1448375240586-882707db888b?auto=format&fit=crop&w=1600&q=80')] bg-cover bg-center"></div>
                        <div class="absolute inset-x-0 bottom-0 h-64 bg-[linear-gradient(0deg,rgba(8,31,22,.98),rgba(8,31,22,0))]"></div>
                    </div>

                    <div class="relative z-10 flex items-center gap-4">
                        <div class="flex h-14 w-14 items-center justify-center rounded-full border-2 border-[#d9c575] bg-white/10 text-sm font-extrabold tracking-wide">
                            LSP
                        </div>
                        <div>
                            <p class="text-xl font-extrabold uppercase tracking-[.2em]">LSP Rimbawan</p>
                            <p class="mt-1 text-sm uppercase tracking-[.18em] text-emerald-100">Sertifikasi Profesi Kehutanan</p>
                        </div>
                    </div>

                    <div class="relative z-10 max-w-xl">
                        <p class="text-sm font-semibold uppercase tracking-[.35em] text-[#d9c575]">Kompeten. Terverifikasi. Berkelanjutan.</p>
                        <h1 class="mt-5 text-5xl font-extrabold leading-tight tracking-tight">
                            Portal Sertifikasi untuk insan rimbawan.
                        </h1>
                        <p class="mt-5 max-w-lg text-base leading-8 text-emerald-50">
                            Kelola pendaftaran, asesmen, dan sertifikat kompetensi dengan alur yang rapi serta verifikasi digital melalui QR Code.
                        </p>
                    </div>

                    <div class="relative z-10 grid grid-cols-3 gap-4 text-sm">
                        <div class="border-l-2 border-[#d9c575] bg-white/10 px-4 py-3 backdrop-blur">
                            <p class="font-bold">Asesi</p>
                            <p class="mt-1 text-emerald-100">Registrasi dan pilih skema.</p>
                        </div>
                        <div class="border-l-2 border-[#d9c575] bg-white/10 px-4 py-3 backdrop-blur">
                            <p class="font-bold">Asesor</p>
                            <p class="mt-1 text-emerald-100">Dukungan proses asesmen.</p>
                        </div>
                        <div class="border-l-2 border-[#d9c575] bg-white/10 px-4 py-3 backdrop-blur">
                            <p class="font-bold">Sertifikat</p>
                            <p class="mt-1 text-emerald-100">Validasi cepat via QR.</p>
                        </div>
                    </div>
                </section>

                <section class="flex min-h-screen items-center justify-center px-5 py-8 sm:px-8">
                    <div class="w-full max-w-md">
                        <div class="mb-8 text-center lg:hidden">
                            <a href="/" class="mx-auto flex h-16 w-16 items-center justify-center rounded-full border-2 border-[#1f5a37] bg-white text-sm font-extrabold text-[#1f5a37] shadow-sm">
                                LSP
                            </a>
                            <p class="mt-4 text-2xl font-extrabold tracking-[.16em] text-[#123829]">LSP RIMBAWAN</p>
                            <p class="mt-1 text-xs uppercase tracking-[.2em] text-stone-500">Sertifikasi Profesi Kehutanan</p>
                        </div>

                        <div class="border border-emerald-900/10 bg-white px-6 py-7 shadow-xl shadow-emerald-950/10 sm:px-8">
                            <div class="mb-6">
                                <p class="text-xs font-bold uppercase tracking-[.24em] text-[#1f5a37]">Portal Akses</p>
                                <h2 class="mt-2 text-2xl font-extrabold text-stone-950">Masuk ke Sistem</h2>
                                <p class="mt-2 text-sm leading-6 text-stone-600">Gunakan akun terdaftar untuk melanjutkan proses sertifikasi.</p>
                            </div>

                            {{ $slot }}
                        </div>

                        <p class="mt-6 text-center text-xs leading-5 text-stone-500">
                            LSP Rimbawan menjaga proses sertifikasi tetap tertib, transparan, dan mudah diverifikasi.
                        </p>
                    </div>
                </section>
            </div>
        </main>
    </body>
</html>

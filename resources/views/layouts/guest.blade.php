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
    <body class="font-sans text-stone-900 antialiased selection:bg-emerald-700 selection:text-white">
        @php
            $isRegister = request()->routeIs('register');
            $title = $isRegister ? 'Buat akun asesi' : 'Masuk ke portal';
            $subtitle = $isRegister
                ? 'Lengkapi pendaftaran untuk mulai mengikuti proses sertifikasi profesi kehutanan dan lingkungan hidup.'
                : 'Gunakan akun terdaftar untuk melanjutkan pendaftaran, asesmen, dan verifikasi sertifikasi.';
        @endphp

        <main class="min-h-screen bg-[radial-gradient(circle_at_top,rgba(210,227,214,.4),transparent_34%),linear-gradient(180deg,#f4f7f1_0%,#edf4ec_100%)]">
            <div class="grid min-h-screen lg:grid-cols-[1.08fr_.92fr]">
                <section class="relative hidden overflow-hidden bg-[#103423] px-12 py-10 text-white lg:flex lg:flex-col lg:justify-between">
                    <div class="absolute inset-0">
                        <div class="absolute inset-0 bg-[linear-gradient(135deg,rgba(9,34,22,.95),rgba(23,84,48,.82)),url('https://images.unsplash.com/photo-1441974231531-c6227db76b6e?auto=format&fit=crop&w=1600&q=80')] bg-cover bg-center"></div>
                        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(236,198,92,.2),transparent_30%)]"></div>
                        <div class="absolute inset-x-0 bottom-0 h-72 bg-[linear-gradient(0deg,rgba(8,28,18,.98),rgba(8,28,18,0))]"></div>
                    </div>

                    <div class="relative z-10 flex items-center justify-between gap-6">
                        <a href="{{ url('/') }}" class="flex items-center gap-4">
                            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-white/10 text-white backdrop-blur">
                                <svg class="h-7 w-7" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                    <path d="M12 2 5 9h2v2.7c0 .3-.1.6-.3.8L5 14h2v2.7c0 .3-.1.6-.3.8L5 19h14l-1.7-1.5c-.2-.2-.3-.5-.3-.8V14h2l-1.7-1.5c-.2-.2-.3-.5-.3-.8V9h2L12 2Z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xl font-extrabold uppercase tracking-[.18em]">LSP Rimbawan</p>
                                <p class="mt-1 text-xs uppercase tracking-[.26em] text-emerald-100">Dan Lingkungan Hidup</p>
                            </div>
                        </a>

                        <div class="flex items-center gap-3 text-sm font-semibold">
                            <a href="{{ url('/#news') }}" class="text-emerald-50/90 transition hover:text-white">News</a>
                            <a href="{{ url('/#alur-sertifikasi') }}" class="text-emerald-50/90 transition hover:text-white">Alur</a>
                            <a href="{{ url('/#skema-sertifikasi') }}" class="text-emerald-50/90 transition hover:text-white">Skema</a>
                        </div>
                    </div>

                    <div class="relative z-10 max-w-xl">
                        <p class="text-sm font-semibold uppercase tracking-[.35em] text-[#e4c35e]">Kompeten. Terverifikasi. Berkelanjutan.</p>
                        <h1 class="mt-6 text-5xl font-extrabold leading-tight tracking-tight">
                            Pengalaman masuk yang selaras dengan identitas rimbawan modern.
                        </h1>
                        <p class="mt-5 max-w-lg text-base leading-8 text-emerald-50/90">
                            Kami rapikan halaman akses agar lebih tenang, profesional, dan enak dipakai oleh asesi, asesor, maupun admin.
                        </p>
                    </div>

                    <div class="relative z-10 grid grid-cols-3 gap-4 text-sm">
                        <div class="border border-white/10 bg-white/10 px-4 py-4 backdrop-blur">
                            <p class="font-bold">Asesi</p>
                            <p class="mt-2 leading-6 text-emerald-100">Daftar akun, pilih skema, dan pantau progres.</p>
                        </div>
                        <div class="border border-white/10 bg-white/10 px-4 py-4 backdrop-blur">
                            <p class="font-bold">Asesor</p>
                            <p class="mt-2 leading-6 text-emerald-100">Berikan penilaian dengan alur yang rapi.</p>
                        </div>
                        <div class="border border-white/10 bg-white/10 px-4 py-4 backdrop-blur">
                            <p class="font-bold">Sertifikat</p>
                            <p class="mt-2 leading-6 text-emerald-100">Dokumen resmi dengan verifikasi QR publik.</p>
                        </div>
                    </div>
                </section>

                <section class="flex min-h-screen items-center justify-center px-5 py-8 sm:px-8">
                    <div class="w-full max-w-xl">
                        <div class="mb-8 text-center lg:hidden">
                            <a href="{{ url('/') }}" class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-[linear-gradient(180deg,#26934b,#185e31)] text-white shadow-lg shadow-emerald-900/20">
                                <svg class="h-8 w-8" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                    <path d="M12 2 5 9h2v2.7c0 .3-.1.6-.3.8L5 14h2v2.7c0 .3-.1.6-.3.8L5 19h14l-1.7-1.5c-.2-.2-.3-.5-.3-.8V14h2l-1.7-1.5c-.2-.2-.3-.5-.3-.8V9h2L12 2Z" />
                                </svg>
                            </a>
                            <p class="mt-4 text-2xl font-extrabold tracking-[.16em] text-[#123829]">LSP RIMBAWAN</p>
                            <p class="mt-1 text-xs uppercase tracking-[.2em] text-stone-500">Sertifikasi Kehutanan & Lingkungan</p>
                        </div>

                        <div class="border border-emerald-900/10 bg-white/95 px-6 py-7 shadow-2xl shadow-emerald-950/10 backdrop-blur sm:px-8 sm:py-8">
                            <div class="mb-7 flex items-start justify-between gap-4 border-b border-emerald-900/10 pb-6">
                                <div>
                                    <p class="text-xs font-bold uppercase tracking-[.26em] text-[#1f5a37]">Portal Akses</p>
                                    <h2 class="mt-2 text-3xl font-extrabold text-stone-950">{{ $title }}</h2>
                                    <p class="mt-2 max-w-md text-sm leading-7 text-stone-600">{{ $subtitle }}</p>
                                </div>
                                <div class="hidden h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-[#f2f7f1] text-[#1f5a37] sm:flex">
                                    <svg class="h-7 w-7" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                        <path d="M12 12a5 5 0 1 0-5-5 5 5 0 0 0 5 5Zm0 2c-4.42 0-8 2.01-8 4.5V21h16v-2.5c0-2.49-3.58-4.5-8-4.5Z" />
                                    </svg>
                                </div>
                            </div>

                            {{ $slot }}
                        </div>

                        <div class="mt-6 flex flex-col gap-3 text-center text-xs leading-6 text-stone-500 sm:flex-row sm:items-center sm:justify-between sm:text-left">
                            <p>LSP Rimbawan menjaga proses sertifikasi tetap tertib, transparan, dan mudah diverifikasi.</p>
                            <a href="{{ url('/') }}" class="font-semibold text-[#1f5a37] transition hover:text-[#123829]">Kembali ke halaman utama</a>
                        </div>
                    </div>
                </section>
            </div>
        </main>
    </body>
</html>

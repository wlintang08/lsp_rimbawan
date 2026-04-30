<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'LSP Rimbawan') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    
    <!-- Tailwind & Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body {
            font-family: 'Figtree', sans-serif;
            color: #182018;
            background: #f5f8f3;
        }
    </style>
</head>
<body class="antialiased flex flex-col min-h-screen">

    <!-- Header / Navbar -->
    <header class="sticky top-0 z-50 bg-white/90 backdrop-blur-md border-b border-green-900/10 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            
            <!-- Logo & Brand -->
            <a href="{{ url('/') }}" class="flex items-center gap-3 group">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center text-white bg-gradient-to-b from-green-600 to-green-800 shadow-lg shadow-green-900/20 transition-transform group-hover:scale-105">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2 5 9h2v2.7c0 .3-.1.6-.3.8L5 14h2v2.7c0 .3-.1.6-.3.8L5 19h14l-1.7-1.5c-.2-.2-.3-.5-.3-.8V14h2l-1.7-1.5c-.2-.2-.3-.5-.3-.8V9h2L12 2Z"/></svg>
                </div>
                <div>
                    <h1 class="text-xl md:text-2xl font-extrabold text-green-900 leading-none">LSP RIMBAWAN</h1>
                    <p class="text-[10px] md:text-xs font-bold tracking-[0.25em] uppercase text-green-700/80 mt-1">Dan Lingkungan Hidup</p>
                </div>
            </a>

            <!-- Navigation Links -->
            <nav class="hidden lg:flex gap-8 text-sm font-bold text-stone-600">
                @guest
                    <a href="{{ url('/') }}" class="hover:text-green-700 transition">Home</a>
                @else
                    @if(auth()->user()->role == 'asesi')
                        <a href="{{ route('asesi.dashboard') }}" class="hover:text-green-700 transition">Dashboard</a>
                    @else
                        <a href="{{ route('dashboard') }}" class="hover:text-green-700 transition">Dashboard</a>
                    @endif
                @endguest
                <a href="{{ url('/news') }}" class="hover:text-green-700 transition">News</a>
                <a href="{{ url('/alur-sertifikasi') }}" class="hover:text-green-700 transition">Alur Sertifikasi</a>
                <a href="{{ url('/skema-sertifikasi') }}" class="hover:text-green-700 transition">Skema Sertifikasi</a>
            </nav>

            <!-- Actions -->
            <div class="flex items-center gap-4">
                @guest
                    <a href="{{ route('login') }}" class="hidden sm:inline-flex items-center justify-center h-10 px-6 rounded-full font-bold text-sm bg-gradient-to-b from-green-600 to-green-800 text-white shadow-lg shadow-green-900/20 hover:scale-105 transition-transform">
                        Login Asesi
                    </a>
                @else
                    <!-- Auth Dropdown / Logout -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center gap-2 text-sm font-bold text-green-900 hover:text-green-700 focus:outline-none">
                            <span>{{ auth()->user()->name }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        
                        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-xl border border-stone-100 py-1" style="display: none;">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-stone-50 font-medium">Logout</button>
                            </form>
                        </div>
                    </div>
                @endguest
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-stone-900 text-stone-400 py-10 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-sm">
            
        </div>
    </footer>

    <!-- WhatsApp Floating Button -->
    <a href="https://wa.me/6281316968279?text=Halo%20Admin%20LSP%20Rimbawan,%20saya%20ingin%20bertanya%20seputar%20sertifikasi." 
       target="_blank"
       rel="noopener noreferrer"
       class="fixed bottom-6 right-6 z-50 w-14 h-14 bg-green-500 rounded-full flex items-center justify-center text-white shadow-lg shadow-green-500/30 hover:scale-110 hover:-translate-y-1 transition-all duration-300">
        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.665.592 1.221.774 1.394.86s.274.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.045.072.045.419-.099.824zm-3.423-14.416c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm.029 18.88c-1.161 0-2.305-.292-3.318-.844l-3.677.964.984-3.595c-.607-1.052-.927-2.246-.926-3.468.001-3.825 3.113-6.937 6.937-6.937 3.825 0 6.938 3.112 6.938 6.937 0 3.824-3.113 6.938-6.938 6.943z"/>
        </svg>
    </a>
</body>
</html>

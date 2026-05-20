@extends('layouts.front')

@section('content')
<div class="bg-white border-b border-stone-200 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-3xl md:text-4xl font-extrabold text-green-900">Berita & Informasi Terbaru</h1>
        <p class="mt-4 text-stone-600 max-w-2xl mx-auto">Informasi seputar pendaftaran, jadwal asesmen, dan pengumuman resmi LSP Rimbawan.</p>
    </div>
</div>

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <article class="md:col-span-2 lg:col-span-3 bg-white rounded-2xl shadow-sm border border-stone-200 overflow-hidden hover:shadow-xl hover:shadow-green-900/10 transition duration-300">
            <div class="grid md:grid-cols-5">
                <a href="{{ route('news.detail', $featuredNews['slug']) }}" class="md:col-span-3 aspect-[4/3] md:aspect-auto min-h-[320px] bg-green-100 relative overflow-hidden group">
                    <img
                        src="{{ $featuredNews['image_remote'] ? $featuredNews['image'] : asset($featuredNews['image']) }}"
                        alt="{{ $featuredNews['alt'] }}"
                        class="w-full h-full object-cover transition duration-500 group-hover:scale-105"
                        style="object-position: {{ $featuredNews['image_position'] }};"
                    >
                    <div class="absolute inset-0 bg-gradient-to-t md:bg-gradient-to-r from-stone-950/55 via-stone-950/10 to-transparent"></div>
                    <div class="absolute left-5 top-5">
                        <span class="inline-flex rounded-full bg-white/90 px-3 py-1 text-xs font-extrabold uppercase tracking-widest text-green-800 shadow-sm">{{ $featuredNews['category'] }}</span>
                    </div>
                </a>
                <div class="md:col-span-2 p-6 md:p-8 flex flex-col justify-center">
                    <span class="text-xs text-stone-400 font-semibold">{{ $featuredNews['date'] }}</span>
                    <h2 class="mt-3 text-2xl md:text-3xl font-extrabold text-stone-900 leading-tight">
                        <a href="{{ route('news.detail', $featuredNews['slug']) }}" class="hover:text-green-800 transition">{{ $featuredNews['title'] }}</a>
                    </h2>
                    <p class="mt-4 text-stone-600 text-sm md:text-base leading-relaxed">{{ $featuredNews['excerpt'] }}</p>
                    <div class="mt-8">
                        <a href="{{ route('news.detail', $featuredNews['slug']) }}" class="inline-flex items-center justify-center rounded-lg bg-green-700 px-5 py-3 text-sm font-bold text-white hover:bg-green-800 transition">Baca selengkapnya</a>
                    </div>
                </div>
            </div>
        </article>

        @foreach($newsItems as $item)
            <article class="bg-white rounded-2xl shadow-sm border border-stone-200 overflow-hidden hover:shadow-xl hover:shadow-green-900/10 transition duration-300 flex flex-col">
                <a href="{{ route('news.detail', $item['slug']) }}" class="aspect-video w-full bg-green-100 relative overflow-hidden group">
                    <img
                        src="{{ $item['image_remote'] ? $item['image'] : asset($item['image']) }}"
                        alt="{{ $item['alt'] }}"
                        class="w-full h-full object-cover transition duration-500 group-hover:scale-105"
                        style="object-position: {{ $item['image_position'] }};"
                    >
                    <div class="absolute inset-0 bg-gradient-to-t from-stone-900/80 via-stone-900/15 to-transparent"></div>
                    <div class="absolute bottom-4 left-4">
                        <span class="text-xs font-bold uppercase tracking-widest text-green-300">{{ $item['category'] }}</span>
                    </div>
                </a>
                <div class="p-6 flex flex-col flex-1">
                    <span class="text-xs text-stone-400 font-semibold">{{ $item['date'] }}</span>
                    <h3 class="mt-3 text-xl font-bold text-stone-900 leading-snug">
                        <a href="{{ route('news.detail', $item['slug']) }}" class="hover:text-green-800 transition">{{ $item['title'] }}</a>
                    </h3>
                    <p class="mt-3 text-stone-600 text-sm leading-relaxed">{{ $item['excerpt'] }}</p>
                    <div class="mt-6 pt-4 border-t border-stone-100">
                        <a href="{{ route('news.detail', $item['slug']) }}" class="text-sm font-bold text-green-700 hover:text-green-900">Baca selengkapnya &rarr;</a>
                    </div>
                </div>
            </article>
        @endforeach
    </div>
</section>
@endsection

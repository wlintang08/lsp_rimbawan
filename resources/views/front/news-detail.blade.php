@extends('layouts.front')

@section('content')
<article>
    <div class="bg-white border-b border-stone-200">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <a href="{{ route('news') }}" class="inline-flex items-center text-sm font-bold text-green-700 hover:text-green-900">&larr; Kembali ke berita</a>
            <div class="mt-8">
                <span class="inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-extrabold uppercase tracking-widest text-green-800">{{ $news['category'] }}</span>
                <p class="mt-5 text-sm font-semibold text-stone-400">{{ $news['date'] }}</p>
                <h1 class="mt-3 text-3xl md:text-5xl font-extrabold text-green-950 leading-tight">{{ $news['title'] }}</h1>
                <p class="mt-5 text-lg text-stone-600 leading-relaxed">{{ $news['excerpt'] }}</p>
            </div>
        </div>
    </div>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="relative overflow-hidden rounded-2xl bg-green-100 shadow-xl shadow-green-900/10">
            <img
                src="{{ $news['image_remote'] ? $news['image'] : asset($news['image']) }}"
                alt="{{ $news['alt'] }}"
                class="w-full max-h-[560px] object-cover"
                style="object-position: {{ $news['image_position'] }};"
            >
        </div>
    </div>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
        <div class="space-y-5 text-base md:text-lg text-stone-700 leading-relaxed">
            @foreach($news['body'] as $paragraph)
                <p>{{ $paragraph }}</p>
            @endforeach
        </div>
    </div>
</article>

<section class="bg-white border-t border-stone-200 py-14">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-extrabold text-green-950">Berita lainnya</h2>
        <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($relatedNews as $item)
                <article class="border border-stone-200 rounded-2xl overflow-hidden bg-white hover:shadow-lg hover:shadow-green-900/10 transition">
                    <a href="{{ route('news.detail', $item['slug']) }}" class="block aspect-video overflow-hidden bg-green-100">
                        <img
                            src="{{ $item['image_remote'] ? $item['image'] : asset($item['image']) }}"
                            alt="{{ $item['alt'] }}"
                            class="w-full h-full object-cover"
                            style="object-position: {{ $item['image_position'] }};"
                        >
                    </a>
                    <div class="p-5">
                        <span class="text-xs font-semibold text-stone-400">{{ $item['date'] }}</span>
                        <h3 class="mt-2 text-base font-bold text-stone-900 leading-snug">
                            <a href="{{ route('news.detail', $item['slug']) }}" class="hover:text-green-800 transition">{{ $item['title'] }}</a>
                        </h3>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endsection

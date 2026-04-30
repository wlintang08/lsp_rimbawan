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
        <!-- News Card 1 -->
        <article class="bg-white rounded-2xl shadow-sm border border-stone-200 overflow-hidden hover:shadow-xl hover:shadow-green-900/10 transition duration-300">
            <div class="aspect-video w-full bg-green-100 relative">
                <img src="https://images.unsplash.com/photo-1425913397330-cf8af2ff40a1?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Hutan" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-stone-900/80 to-transparent"></div>
                <div class="absolute bottom-4 left-4 text-white">
                    <span class="text-xs font-bold uppercase tracking-widest text-green-400">Update LSP</span>
                </div>
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold text-stone-900 leading-snug">Pendaftaran skema dibuka dengan tampilan yang lebih meyakinkan.</h3>
                <p class="mt-3 text-stone-600 text-sm leading-relaxed">Asesi bisa menangkap informasi penting lebih cepat karena hierarki visualnya sekarang lebih tegas dan nyaman dibaca.</p>
                <div class="mt-6 flex items-center justify-between">
                    <span class="text-xs text-stone-400 font-semibold">12 Okt 2026</span>
                    <a href="#" class="text-sm font-bold text-green-700 hover:text-green-900">Baca selengkapnya &rarr;</a>
                </div>
            </div>
        </article>

        <!-- News Card 2 -->
        <article class="bg-white rounded-2xl shadow-sm border border-stone-200 overflow-hidden hover:shadow-xl hover:shadow-green-900/10 transition duration-300">
            <div class="aspect-video w-full bg-green-100 relative">
                <img src="https://images.unsplash.com/photo-1466721591366-2d5fba72006d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Verifikasi" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-stone-900/80 to-transparent"></div>
                <div class="absolute bottom-4 left-4 text-white">
                    <span class="text-xs font-bold uppercase tracking-widest text-green-400">Verifikasi</span>
                </div>
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold text-stone-900 leading-snug">Sertifikat digital tetap formal sambil terlihat modern.</h3>
                <p class="mt-3 text-stone-600 text-sm leading-relaxed">Pendekatan desain baru menjaga sisi resmi lembaga, tapi tidak lagi terasa kaku atau generik.</p>
                <div class="mt-6 flex items-center justify-between">
                    <span class="text-xs text-stone-400 font-semibold">05 Okt 2026</span>
                    <a href="#" class="text-sm font-bold text-green-700 hover:text-green-900">Baca selengkapnya &rarr;</a>
                </div>
            </div>
        </article>

        <!-- News Card 3 -->
        <article class="bg-white rounded-2xl shadow-sm border border-stone-200 overflow-hidden hover:shadow-xl hover:shadow-green-900/10 transition duration-300">
            <div class="aspect-video w-full bg-green-100 relative">
                <img src="https://images.unsplash.com/photo-1441974231531-c6227db76b6e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Asesmen" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-stone-900/80 to-transparent"></div>
                <div class="absolute bottom-4 left-4 text-white">
                    <span class="text-xs font-bold uppercase tracking-widest text-green-400">Asesmen</span>
                </div>
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold text-stone-900 leading-snug">Proses penilaian kini terasa lebih bersih dan fokus.</h3>
                <p class="mt-3 text-stone-600 text-sm leading-relaxed">Nuansa hijau hutan dan detail hangat memberi identitas visual yang lebih khas tanpa berlebihan.</p>
                <div class="mt-6 flex items-center justify-between">
                    <span class="text-xs text-stone-400 font-semibold">28 Sep 2026</span>
                    <a href="#" class="text-sm font-bold text-green-700 hover:text-green-900">Baca selengkapnya &rarr;</a>
                </div>
            </div>
        </article>
    </div>
</section>
@endsection

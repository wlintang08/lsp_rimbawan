@extends('layouts.front')

@section('content')
<!-- Hero Section -->
<section class="relative bg-green-900 pt-24 pb-48 lg:pt-32 lg:pb-56 overflow-hidden">
    <!-- Background Image with Overlay -->
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1511497584788-876760111969?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80" 
             alt="Hutan" 
             class="w-full h-full object-cover" />
        <div class="absolute inset-0 bg-green-900/85 mix-blend-multiply"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-green-900/90 to-transparent"></div>
    </div>

    <div class="relative z-10 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <!-- Badge -->
        <div class="inline-flex items-center justify-center px-4 py-1.5 mb-8 rounded-full bg-yellow-400 text-yellow-900 text-xs font-bold tracking-widest uppercase shadow-lg shadow-yellow-500/20">
            Lisensi BNSP Terakreditasi
        </div>
        <div class="inline-flex items-center justify-center px-4 py-1.5 mb-8 rounded-full bg-yellow-400 text-yellow-900 text-xs font-bold tracking-widest uppercase shadow-lg shadow-yellow-500/20">
            Terintegrasi Kementerian Kehutanan
        </div>
        <div class="inline-flex items-center justify-center px-4 py-1.5 mb-8 rounded-full bg-yellow-400 text-yellow-900 text-xs font-bold tracking-widest uppercase shadow-lg shadow-yellow-500/20">
            Terintegrasi Kementrian Lingkungan Hidup
        </div>

        <!-- Headline -->
        <h1 class="text-4xl md:text-6xl lg:text-7xl font-extrabold text-white tracking-tight leading-[1.1]">
            Mencetak Tenaga Profesional <br class="hidden md:block"/> Lingkungan Hidup
        </h1>

        <!-- Subtitle -->
        <p class="mt-8 text-lg md:text-xl text-green-50 max-w-3xl mx-auto font-medium leading-relaxed">
            Menjamin kompetensi sumber daya manusia di sektor kehutanan melalui proses sertifikasi yang independen, objektif, dan terukur.
        </p>

        <!-- CTA Buttons -->
        <div class="mt-12 flex flex-col sm:flex-row gap-4 justify-center items-center">
            <a href="{{ url('/skema-sertifikasi') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 rounded-lg bg-white text-green-800 font-bold text-lg hover:bg-green-50 transition shadow-xl shadow-green-900/20">
                Cari Skema Sertifikasi
            </a>
            <a href="{{ url('/alur-sertifikasi') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 rounded-lg bg-transparent border-2 border-white/60 text-white font-bold text-lg hover:bg-white/10 hover:border-white transition">
                Lihat Alur Daftar
            </a>
        </div>
    </div>
</section>

<!-- Statistics Section (Overlapping Hero) -->
<section class="relative z-20 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 -mt-24 lg:-mt-28 mb-24">
    <div class="bg-white rounded-3xl shadow-2xl shadow-green-900/10 p-8 md:p-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 divide-y md:divide-y-0 md:divide-x divide-stone-100 text-center">
            
            <div class="pt-6 md:pt-0">
                <div class="text-4xl md:text-5xl font-extrabold text-green-700 tracking-tight">1,250+</div>
                <div class="mt-3 text-[11px] font-bold text-stone-500 uppercase tracking-[0.2em]">Asesi Terverifikasi</div>
            </div>

            <div class="pt-6 md:pt-0">
                <div class="text-4xl md:text-5xl font-extrabold text-green-700 tracking-tight">45</div>
                <div class="mt-3 text-[11px] font-bold text-stone-500 uppercase tracking-[0.2em]">Asesor Kompeten</div>
            </div>

            <div class="pt-6 md:pt-0">
                <div class="text-4xl md:text-5xl font-extrabold text-green-700 tracking-tight">125</div>
                <div class="mt-3 text-[11px] font-bold text-stone-500 uppercase tracking-[0.2em]">Skema Aktif</div>
            </div>

            <div class="pt-6 md:pt-0">
                <div class="text-4xl md:text-5xl font-extrabold text-green-700 tracking-tight">98%</div>
                <div class="mt-3 text-[11px] font-bold text-stone-500 uppercase tracking-[0.2em]">Tingkat Kelulusan</div>
            </div>

        </div>
    </div>
</section>

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
    <div class="flex items-end justify-between gap-4">
        <div>
            <h2 class="text-2xl font-extrabold text-stone-900">Berita & Artikel</h2>
            <div class="mt-3 h-1 w-16 rounded-full bg-green-700"></div>
        </div>
        <a href="{{ route('news') }}" class="text-sm font-bold text-green-800 hover:text-green-950">Lihat Semua &rarr;</a>
    </div>

    <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($homeNews as $news)
            <article class="bg-white rounded-2xl shadow-sm border border-stone-200 overflow-hidden hover:shadow-lg hover:shadow-green-900/10 transition">
                <a href="{{ route('news.detail', $news['slug']) }}" class="block aspect-video bg-green-100 overflow-hidden">
                    <img
                        src="{{ $news['image_remote'] ? $news['image'] : asset($news['image']) }}"
                        alt="{{ $news['alt'] }}"
                        class="w-full h-full object-cover"
                        style="object-position: {{ $news['image_position'] }};"
                    >
                </a>
                <div class="p-5">
                    <p class="text-[11px] font-bold text-green-700">{{ $news['date'] }}</p>
                    <h3 class="mt-2 text-base font-extrabold leading-snug text-stone-900">
                        <a href="{{ route('news.detail', $news['slug']) }}" class="hover:text-green-800">{{ $news['title'] }}</a>
                    </h3>
                    <p class="mt-3 text-sm leading-6 text-stone-600">{{ $news['excerpt'] }}</p>
                    <a href="{{ route('news.detail', $news['slug']) }}" class="mt-4 inline-flex text-sm font-bold text-green-700 hover:text-green-950">Baca Selengkapnya &rarr;</a>
                </div>
            </article>
        @endforeach
    </div>
</section>

<section class="profession-section">
    <div class="profession-inner">
        <div class="profession-media">
            <img
                src="https://images.unsplash.com/photo-1556761175-b413da4baf72?ixlib=rb-4.0.3&auto=format&fit=crop&w=900&q=80"
                alt="Kegiatan profesional LSP"
            >
        </div>
        <div>
            <h2 class="profession-title">Menjaga Standar Profesi Rimbawan</h2>
            <p class="profession-description">
                LSP Rimbawan dan Lingkungan menjaga mutu proses sertifikasi melalui asesor kompeten, instrumen penilaian yang jelas, dan alur administrasi yang terukur.
            </p>
            <div class="profession-features">
                <div class="profession-feature">
                    <div class="profession-icon">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M12 3l7 4v5c0 5-3 8-7 9-4-1-7-4-7-9V7l7-4z" /></svg>
                    </div>
                    <div>
                        <h3>Legalitas Terjamin</h3>
                        <p>Sertifikasi mengacu pada standar dan ketentuan nasional yang berlaku.</p>
                    </div>
                </div>
                <div class="profession-feature">
                    <div class="profession-icon">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14c-4 0-7 2-7 4v1h14v-1c0-2-3-4-7-4z" /></svg>
                    </div>
                    <div>
                        <h3>Asesor Berpengalaman</h3>
                        <p>Proses asesmen dilakukan oleh asesor kompeten sesuai bidang keahlian.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

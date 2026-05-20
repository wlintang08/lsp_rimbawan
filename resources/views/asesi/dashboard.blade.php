@extends('layouts.front')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    
    <!-- Welcome Banner -->
    <div class="bg-gradient-to-br from-green-800 to-green-900 rounded-2xl shadow-xl shadow-green-900/20 overflow-hidden relative mb-8">
        <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1511497584788-876760111969?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80')] opacity-10 bg-cover bg-center mix-blend-overlay"></div>
        <div class="relative p-8 md:p-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
            <div>
                <h2 class="text-3xl font-extrabold text-white">Dashboard Asesi</h2>
                <p class="mt-2 text-green-100 text-lg">Selamat datang kembali, <strong>{{ auth()->user()->name }}</strong>.</p>
            </div>
            <div class="flex gap-3 shrink-0">
                <a href="{{ route('asesi.skema') }}" class="inline-flex items-center justify-center px-5 py-2.5 rounded-lg bg-white text-green-800 font-bold text-sm shadow-md hover:bg-green-50 transition">
                    Lihat Skema
                </a>
                <a href="{{ route('asesi.pendaftaran') }}" class="inline-flex items-center justify-center px-5 py-2.5 rounded-lg bg-green-700/50 text-white font-bold text-sm border border-green-500 hover:bg-green-700 transition">
                    Pendaftaran Saya
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Kolom Utama: Status Pendaftaran -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-2xl shadow-sm border border-stone-200 p-6">
                <h3 class="text-xl font-extrabold text-stone-900 mb-6">Status Pendaftaran Terakhir</h3>
                
                @if($pendaftaran->isEmpty())
                    <div class="text-center py-10 bg-stone-50 rounded-xl border border-dashed border-stone-300">
                        <p class="text-stone-500 font-medium">Belum ada pendaftaran skema.</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-stone-200">
                                    <th class="py-4 px-2 text-xs font-bold text-stone-500 uppercase tracking-widest">Skema</th>
                                    <th class="py-4 px-2 text-xs font-bold text-stone-500 uppercase tracking-widest">Status</th>
                                    <th class="py-4 px-2 text-xs font-bold text-stone-500 uppercase tracking-widest">Nilai</th>
                                    <th class="py-4 px-2 text-xs font-bold text-stone-500 uppercase tracking-widest text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-stone-100">
                                @foreach($pendaftaran as $d)
                                <tr class="hover:bg-stone-50/50 transition">
                                    <td class="py-4 px-2 font-semibold text-stone-800">{{ $d->skema->nama_skema }}</td>
                                    <td class="py-4 px-2">
                                        <?php
                                            $badgeClass = 'bg-stone-100 text-stone-800 border-stone-200';
                                            if ($d->status == 'pending') {
                                                $badgeClass = 'bg-amber-100 text-amber-800 border-amber-200';
                                            } elseif ($d->status == 'diterima') {
                                                $badgeClass = 'bg-blue-100 text-blue-800 border-blue-200';
                                            } elseif ($d->status == 'lulus') {
                                                $badgeClass = 'bg-green-100 text-green-800 border-green-200';
                                            } elseif ($d->status == 'ditolak') {
                                                $badgeClass = 'bg-red-100 text-red-800 border-red-200';
                                            } elseif ($d->status == 'tidak_lulus') {
                                                $badgeClass = 'bg-stone-100 text-stone-800 border-stone-200';
                                            }
                                        ?>
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold border {{ $badgeClass }} uppercase tracking-wider">
                                            {{ str_replace('_', ' ', $d->status) }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-2 font-mono text-sm text-stone-600">{{ $d->nilai ?? '-' }}</td>
                                    <td class="py-4 px-2 text-right">
                                        @if($d->status == 'lulus')
                                            <a href="{{ route('sertifikat.cetak', $d->id) }}" class="inline-flex items-center justify-center px-3 py-1.5 rounded bg-green-100 text-green-700 hover:bg-green-200 hover:text-green-800 font-bold text-xs transition">
                                                Cetak Sertifikat
                                            </a>
                                        @else
                                            <span class="text-xs text-stone-400 font-medium">Belum tersedia</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        <!-- Kolom Samping: Notifikasi -->
        <div class="space-y-6">
            <div class="bg-white rounded-2xl shadow-sm border border-stone-200 p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-extrabold text-stone-900">Notifikasi</h3>
                    @if($notifikasi->isNotEmpty())
                        <span class="flex h-6 w-6 items-center justify-center rounded-full bg-red-100 text-xs font-bold text-red-600">{{ $notifikasi->count() }}</span>
                    @endif
                </div>

                @if($notifikasi->isEmpty())
                    <div class="text-center py-8">
                        <svg class="mx-auto h-12 w-12 text-stone-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        <p class="mt-2 text-stone-500 font-medium text-sm">Belum ada notifikasi baru.</p>
                    </div>
                @else
                    <div class="space-y-3">
                        @foreach($notifikasi as $n)
                            <div class="p-4 bg-blue-50 border border-blue-100 rounded-xl text-sm text-blue-900 leading-relaxed shadow-sm">
                                <div class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-blue-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <div>{{ $n->notifikasi }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

    </div>

    <section class="mt-16">
        <div class="flex items-end justify-between gap-4">
            <div>
                <h2 class="text-2xl font-extrabold text-stone-900">Berita & Artikel</h2>
                <div class="mt-3 h-1 w-16 rounded-full bg-green-700"></div>
            </div>
            <a href="{{ route('news') }}" class="text-sm font-bold text-green-800 hover:text-green-950">Lihat Semua &rarr;</a>
        </div>

        <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($dashboardNews as $news)
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

    <section class="profession-section is-card">
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
</div>

<script>
// Auto mark notifikasi as read if notifikasi > 0
document.addEventListener("DOMContentLoaded", function () {
    @if($notifikasi->isNotEmpty())
        fetch("{{ route('notifikasi.read') }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Content-Type": "application/json"
            }
        });
    @endif
});
</script>
@endsection

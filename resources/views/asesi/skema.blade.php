@extends('layouts.front')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-3xl font-extrabold text-green-900">Daftar Skema</h2>
            <p class="mt-2 text-stone-600">Pilih skema sertifikasi yang sesuai dengan kompetensi Anda.</p>
        </div>
        <a href="{{ route('asesi.dashboard') }}" class="inline-flex items-center text-sm font-bold text-stone-500 hover:text-green-700 transition">
            &larr; Kembali ke Dashboard
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 text-green-800 flex items-start gap-3 shadow-sm">
            <svg class="w-5 h-5 text-green-600 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <div class="text-sm font-medium">{{ session('success') }}</div>
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-800 flex items-start gap-3 shadow-sm">
            <svg class="w-5 h-5 text-red-600 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <div class="text-sm font-medium">{{ session('error') }}</div>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($skema as $s)
            @php($daftar = $pendaftaran->get($s->id))
            
            <div class="bg-white rounded-2xl shadow-sm border border-stone-200 overflow-hidden flex flex-col hover:shadow-xl hover:shadow-green-900/10 transition duration-300 relative group">
                
                <!-- Status Badge -->
                @if($daftar)
                    <div class="absolute top-4 right-4 z-10">
                        <?php
                            $badgeClass = 'bg-stone-100 text-stone-800';
                            if ($daftar->status == 'pending') {
                                $badgeClass = 'bg-amber-100 text-amber-800';
                            } elseif ($daftar->status == 'diterima') {
                                $badgeClass = 'bg-blue-100 text-blue-800';
                            } elseif ($daftar->status == 'lulus') {
                                $badgeClass = 'bg-green-100 text-green-800';
                            } elseif ($daftar->status == 'ditolak') {
                                $badgeClass = 'bg-red-100 text-red-800';
                            } elseif ($daftar->status == 'tidak_lulus') {
                                $badgeClass = 'bg-stone-200 text-stone-800';
                            }
                        ?>
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-extrabold {{ $badgeClass }} uppercase tracking-wider shadow-sm">
                            {{ str_replace('_', ' ', $daftar->status) }}
                        </span>
                    </div>
                @endif

                <div class="h-1.5 bg-gradient-to-r from-green-500 to-green-700"></div>
                
                <div class="p-6 flex-grow">
                    <h3 class="text-xl font-extrabold text-stone-900 pr-16">{{ $s->nama_skema }}</h3>
                    <p class="mt-3 text-sm text-stone-600 leading-relaxed">{{ $s->deskripsi ?: 'Tidak ada deskripsi untuk skema ini.' }}</p>
                </div>

                <div class="p-6 border-t border-stone-100 bg-stone-50">
                    @if($daftar)
                        <div class="w-full inline-flex items-center justify-center px-4 py-2.5 bg-stone-200 text-stone-500 rounded-lg text-sm font-bold cursor-not-allowed">
                            <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Sudah Mendaftar
                        </div>
                    @else
                        <form action="{{ route('asesi.daftar', $s->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2.5 bg-green-700 text-white rounded-lg text-sm font-bold hover:bg-green-800 transition shadow-md shadow-green-900/10">
                                Daftar Skema Ini
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @empty
            <div class="col-span-full py-16 text-center bg-white rounded-2xl border border-dashed border-stone-300">
                <svg class="mx-auto h-12 w-12 text-stone-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                <h3 class="mt-2 text-sm font-semibold text-stone-900">Belum ada skema</h3>
                <p class="mt-1 text-sm text-stone-500">Saat ini belum ada skema sertifikasi yang aktif.</p>
            </div>
        @endforelse
    </div>

</div>
@endsection

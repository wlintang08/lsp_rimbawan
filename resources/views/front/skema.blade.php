@extends('layouts.front')

@section('content')
<div class="bg-white border-b border-stone-200 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-3xl md:text-4xl font-extrabold text-green-900">Daftar Skema Sertifikasi</h1>
        <p class="mt-4 text-stone-600 max-w-2xl mx-auto">Berbagai skema kompetensi sektor kehutanan dan lingkungan hidup yang dirancang khusus untuk memenuhi standar industri.</p>
    </div>
</div>

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        
        @forelse($skema as $s)
        <div class="bg-white rounded-2xl shadow-sm border border-stone-200 overflow-hidden hover:shadow-xl hover:shadow-green-900/10 transition duration-300 flex flex-col">
            <!-- Header Pattern/Color -->
            <div class="h-2 bg-gradient-to-r from-green-500 to-green-700"></div>
            
            <div class="p-6 flex-grow">
                <div class="inline-flex items-center px-3 py-1 rounded-full bg-green-50 text-green-700 text-xs font-bold uppercase tracking-widest mb-4">
                    Skema Aktif
                </div>
                
                <h3 class="text-xl font-extrabold text-stone-900 leading-tight">
                    {{ $s->nama_skema }}
                </h3>
                
                <p class="mt-3 text-stone-600 text-sm leading-relaxed line-clamp-3">
                    {{ $s->deskripsi ?? 'Skema ini dirancang untuk memastikan tenaga profesional memiliki kompetensi yang sesuai dengan standar nasional dalam ruang lingkup kehutanan dan pelestarian alam.' }}
                </p>
            </div>
            
            <div class="p-6 border-t border-stone-100 bg-stone-50">
                @guest
                    <a href="{{ route('login') }}" class="w-full inline-flex items-center justify-center px-4 py-2.5 bg-white border border-stone-300 rounded-lg text-sm font-bold text-stone-700 hover:bg-stone-100 transition">
                        Login untuk Mendaftar
                    </a>
                @else
                    @if(auth()->user()->role == 'asesi')
                        <a href="{{ route('asesi.skema') }}" class="w-full inline-flex items-center justify-center px-4 py-2.5 bg-green-700 text-white rounded-lg text-sm font-bold hover:bg-green-800 transition">
                            Lihat & Daftar Skema
                        </a>
                    @else
                        <span class="text-xs text-stone-500">Silakan login sebagai asesi untuk mendaftar.</span>
                    @endif
                @endguest
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-12">
            <svg class="mx-auto h-12 w-12 text-stone-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
            </svg>
            <h3 class="mt-2 text-sm font-semibold text-stone-900">Belum ada data skema</h3>
            <p class="mt-1 text-sm text-stone-500">Saat ini belum ada skema sertifikasi yang tersedia.</p>
        </div>
        @endforelse

    </div>
</section>
@endsection

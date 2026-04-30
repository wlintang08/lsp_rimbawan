@extends('layouts.front')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-3xl font-extrabold text-green-900">Pendaftaran Saya</h2>
            <p class="mt-2 text-stone-600">Riwayat dan status pendaftaran skema sertifikasi Anda.</p>
        </div>
        <a href="{{ route('asesi.dashboard') }}" class="inline-flex items-center text-sm font-bold text-stone-500 hover:text-green-700 transition">
            &larr; Kembali ke Dashboard
        </a>
    </div>

    <!-- Filter Form -->
    <div class="bg-white rounded-2xl shadow-sm border border-stone-200 p-6 mb-8">
        <form method="GET" action="{{ route('asesi.pendaftaran') }}" class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
            
            <div class="md:col-span-4">
                <label class="block text-xs font-bold text-stone-500 uppercase tracking-widest mb-2">Cari Skema</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-stone-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="text" name="search" class="pl-10 w-full rounded-xl border-stone-300 focus:border-green-500 focus:ring-green-500 text-sm" placeholder="Nama skema..." value="{{ request('search') }}">
                </div>
            </div>

            <div class="md:col-span-4">
                <label class="block text-xs font-bold text-stone-500 uppercase tracking-widest mb-2">Status</label>
                <select name="status" class="w-full rounded-xl border-stone-300 focus:border-green-500 focus:ring-green-500 text-sm">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status')=='pending'?'selected':'' }}>Pending</option>
                    <option value="diterima" {{ request('status')=='diterima'?'selected':'' }}>Diterima</option>
                    <option value="ditolak" {{ request('status')=='ditolak'?'selected':'' }}>Ditolak</option>
                    <option value="lulus" {{ request('status')=='lulus'?'selected':'' }}>Lulus</option>
                    <option value="tidak_lulus" {{ request('status')=='tidak_lulus'?'selected':'' }}>Tidak Lulus</option>
                </select>
            </div>

            <div class="md:col-span-2">
                <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2.5 bg-green-700 text-white rounded-xl text-sm font-bold hover:bg-green-800 transition shadow-md shadow-green-900/10">
                    Filter
                </button>
            </div>

            <div class="md:col-span-2">
                <a href="{{ route('asesi.pendaftaran') }}" class="w-full inline-flex items-center justify-center px-4 py-2.5 bg-stone-100 text-stone-700 border border-stone-200 rounded-xl text-sm font-bold hover:bg-stone-200 transition">
                    Reset
                </a>
            </div>

        </form>
    </div>

    <!-- Data Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-stone-200 overflow-hidden">
        @if($data->isEmpty())
            <div class="text-center py-16 px-4">
                <svg class="mx-auto h-12 w-12 text-stone-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                </svg>
                <h3 class="mt-2 text-sm font-semibold text-stone-900">Tidak ada data pendaftaran</h3>
                <p class="mt-1 text-sm text-stone-500">Anda belum mendaftar ke skema apapun atau tidak ada data yang cocok dengan filter.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-stone-50 border-b border-stone-200">
                            <th class="py-4 px-6 text-xs font-bold text-stone-500 uppercase tracking-widest">Skema</th>
                            <th class="py-4 px-6 text-xs font-bold text-stone-500 uppercase tracking-widest">Status</th>
                            <th class="py-4 px-6 text-xs font-bold text-stone-500 uppercase tracking-widest">Nilai</th>
                            <th class="py-4 px-6 text-xs font-bold text-stone-500 uppercase tracking-widest">No Sertifikat</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-stone-100">
                        @foreach($data as $d)
                        <tr class="hover:bg-stone-50/50 transition">
                            <td class="py-4 px-6 font-semibold text-stone-800">{{ $d->skema->nama_skema ?? '-' }}</td>
                            <td class="py-4 px-6">
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
                            <td class="py-4 px-6 font-mono text-sm text-stone-600">{{ $d->nilai ?? '-' }}</td>
                            <td class="py-4 px-6 font-mono text-sm text-stone-600">{{ $d->no_sertifikat ?? '-' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            @if($data->hasPages())
                <div class="px-6 py-4 border-t border-stone-200 bg-stone-50">
                    {{ $data->withQueryString()->links() }}
                </div>
            @endif
        @endif
    </div>

</div>
@endsection

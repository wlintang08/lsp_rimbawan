@extends('layouts.front')

@section('content')
<div class="bg-white border-b border-stone-200 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-3xl md:text-4xl font-extrabold text-green-900">Alur Sertifikasi</h1>
        <p class="mt-4 text-stone-600 max-w-2xl mx-auto">Tahapan proses sertifikasi di LSP Rimbawan dibuat transparan, jelas, dan mudah diikuti oleh setiap calon asesi.</p>
    </div>
</div>

<section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="space-y-8 relative before:absolute before:inset-0 before:ml-5 before:-translate-x-px md:before:mx-auto md:before:translate-x-0 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-transparent before:via-stone-300 before:to-transparent">
        
        <!-- Step 1 -->
        <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active">
            <div class="flex items-center justify-center w-10 h-10 rounded-full border-4 border-white bg-green-600 text-white font-bold shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 shadow-md">
                1
            </div>
            <div class="w-[calc(100%-4rem)] md:w-[calc(50%-2.5rem)] p-6 bg-white rounded-2xl shadow-sm border border-stone-200 hover:border-green-500 hover:shadow-lg transition">
                <h3 class="font-bold text-xl text-stone-900">Registrasi Akun</h3>
                <p class="mt-2 text-stone-600 text-sm leading-relaxed">Calon asesi membuat akun dan menyiapkan data dasar serta kelengkapan dokumen administratif sebelum memilih skema yang sesuai.</p>
            </div>
        </div>

        <!-- Step 2 -->
        <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active">
            <div class="flex items-center justify-center w-10 h-10 rounded-full border-4 border-white bg-green-600 text-white font-bold shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 shadow-md">
                2
            </div>
            <div class="w-[calc(100%-4rem)] md:w-[calc(50%-2.5rem)] p-6 bg-white rounded-2xl shadow-sm border border-stone-200 hover:border-green-500 hover:shadow-lg transition">
                <h3 class="font-bold text-xl text-stone-900">Pilih Skema Sertifikasi</h3>
                <p class="mt-2 text-stone-600 text-sm leading-relaxed">Pilih skema sertifikasi yang sesuai dengan kompetensi yang ingin diujikan. Skema akan ditinjau oleh tim admin.</p>
            </div>
        </div>

        <!-- Step 3 -->
        <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active">
            <div class="flex items-center justify-center w-10 h-10 rounded-full border-4 border-white bg-green-600 text-white font-bold shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 shadow-md">
                3
            </div>
            <div class="w-[calc(100%-4rem)] md:w-[calc(50%-2.5rem)] p-6 bg-white rounded-2xl shadow-sm border border-stone-200 hover:border-green-500 hover:shadow-lg transition">
                <h3 class="font-bold text-xl text-stone-900">Proses Asesmen</h3>
                <p class="mt-2 text-stone-600 text-sm leading-relaxed">Asesor kompeten akan menilai asesi berdasarkan kriteria dan unjuk kerja yang telah ditetapkan dalam Standar Kompetensi Kerja Nasional.</p>
            </div>
        </div>

        <!-- Step 4 -->
        <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active">
            <div class="flex items-center justify-center w-10 h-10 rounded-full border-4 border-white bg-green-600 text-white font-bold shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 shadow-md">
                4
            </div>
            <div class="w-[calc(100%-4rem)] md:w-[calc(50%-2.5rem)] p-6 bg-white rounded-2xl shadow-sm border border-stone-200 hover:border-green-500 hover:shadow-lg transition">
                <h3 class="font-bold text-xl text-stone-900">Penerbitan Sertifikat</h3>
                <p class="mt-2 text-stone-600 text-sm leading-relaxed">Peserta yang dinyatakan Kompeten (K) dapat mengunduh dan mencetak sertifikat digital yang dilengkapi fitur verifikasi QR Code.</p>
            </div>
        </div>

    </div>

    <div class="mt-16 text-center">
        @guest
            <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-4 rounded-full bg-green-700 text-white font-bold hover:bg-green-800 transition shadow-xl shadow-green-900/20">
                Mulai Pendaftaran Sekarang
            </a>
        @endguest
    </div>
</section>
@endsection

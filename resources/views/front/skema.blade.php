@extends('layouts.front')

@section('content')

{{-- ===== HERO SECTION ===== --}}
<div class="bg-white border-b border-stone-200 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-3xl md:text-4xl font-extrabold text-green-900">Daftar Skema Sertifikasi</h1>
        <p class="mt-4 text-stone-600 max-w-2xl mx-auto">Berbagai skema kompetensi sektor kehutanan dan lingkungan hidup yang dirancang khusus untuk memenuhi standar industri.</p>

        {{-- ===== SEARCH BOX ===== --}}
        <div class="mt-8 max-w-xl mx-auto relative">
            <span class="absolute inset-y-0 left-4 flex items-center pointer-events-none text-stone-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M21 21l-4.35-4.35M17 11A6 6 0 1 0 5 11a6 6 0 0 0 12 0z"/>
                </svg>
            </span>
            <input
                id="skema-search"
                type="text"
                placeholder="Cari skema sertifikasi..."
                class="w-full pl-12 pr-4 py-3 rounded-xl border border-stone-300 bg-white shadow-sm text-stone-800 placeholder-stone-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition text-sm"
                autocomplete="off"
            />
            <p id="no-result" class="hidden mt-3 text-sm text-stone-400">Tidak ada skema yang cocok dengan pencarian Anda.</p>
        </div>
    </div>
</div>

{{-- ===== GRID SKEMA ===== --}}
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div id="skema-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

        @forelse($skema as $s)
        <div
            class="skema-card bg-white rounded-2xl shadow-sm border border-stone-200 overflow-hidden hover:shadow-xl hover:shadow-green-900/10 transition duration-300 flex flex-col"
            data-nama="{{ strtolower($s->nama_skema) }}"
            data-deskripsi="{{ strtolower($s->deskripsi ?? '') }}"
        >
            {{-- Accent bar --}}
            <div class="h-2 bg-gradient-to-r from-green-500 to-green-700"></div>

            <div class="p-6 flex-grow">
                <div class="inline-flex items-center px-3 py-1 rounded-full bg-green-50 text-green-700 text-xs font-bold uppercase tracking-widest mb-4">
                    Skema Aktif
                </div>

                {{-- JUDUL — klik untuk buka modal --}}
                <h3
                    class="text-xl font-extrabold text-stone-900 leading-tight cursor-pointer hover:text-green-700 transition-colors duration-200 group flex items-start gap-2"
                    onclick="openSkemaModal({{ $s->id }})"
                    title="Klik untuk melihat detail"
                >
                    <span class="flex-1">{{ $s->nama_skema }}</span>
                    <svg class="w-4 h-4 mt-1 flex-shrink-0 text-green-500 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                </h3>

                <p class="mt-3 text-stone-600 text-sm leading-relaxed line-clamp-3">
                    {{ $s->deskripsi ?? 'Skema ini dirancang untuk memastikan tenaga profesional memiliki kompetensi yang sesuai dengan standar nasional dalam ruang lingkup kehutanan dan pelestarian alam.' }}
                </p>

                @if($s->kriterias->count() > 0)
                <div class="mt-4 flex items-center gap-2 text-xs text-stone-500">
                    <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 12l2 2 4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0z"/>
                    </svg>
                    <span>{{ $s->kriterias->count() }} unit kompetensi</span>
                </div>
                @endif
            </div>

            <div class="p-6 border-t border-stone-100 bg-stone-50 flex items-center justify-between gap-3">
                {{-- Detail button --}}
                <button
                    onclick="openSkemaModal({{ $s->id }})"
                    class="inline-flex items-center gap-1.5 text-xs font-bold text-green-700 hover:text-green-900 transition"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    Lihat Detail
                </button>

                @guest
                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-4 py-2 bg-white border border-stone-300 rounded-lg text-xs font-bold text-stone-700 hover:bg-stone-100 transition">
                        Login untuk Daftar
                    </a>
                @else
                    @if(auth()->user()->role == 'asesi')
                        <a href="{{ route('asesi.skema') }}" class="inline-flex items-center justify-center px-4 py-2 bg-green-700 text-white rounded-lg text-xs font-bold hover:bg-green-800 transition">
                            Daftar Skema
                        </a>
                    @else
                        <span class="text-xs text-stone-400">Login sebagai asesi</span>
                    @endif
                @endguest
            </div>
        </div>

        @empty
        <div class="col-span-full text-center py-12">
            <svg class="mx-auto h-12 w-12 text-stone-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
            </svg>
            <h3 class="mt-2 text-sm font-semibold text-stone-900">Belum ada data skema</h3>
            <p class="mt-1 text-sm text-stone-500">Saat ini belum ada skema sertifikasi yang tersedia.</p>
        </div>
        @endforelse

    </div>
</section>


{{-- ===== MODAL DETAIL SKEMA ===== --}}
<div
    id="skema-modal"
    class="fixed inset-0 z-50 flex items-center justify-center p-4"
    style="display:none !important;"
    aria-modal="true"
    role="dialog"
>
    {{-- Backdrop --}}
    <div
        id="modal-backdrop"
        class="absolute inset-0 bg-stone-900/60 backdrop-blur-sm"
        onclick="closeSkemaModal()"
    ></div>

    {{-- Panel --}}
    <div
        id="modal-panel"
        class="relative bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto flex flex-col"
        style="transform: scale(0.95); opacity: 0; transition: transform 0.25s ease, opacity 0.25s ease;"
    >
        {{-- Accent --}}
        <div class="h-2 bg-gradient-to-r from-green-500 to-green-700 rounded-t-2xl flex-shrink-0"></div>

        {{-- Header --}}
        <div class="px-6 pt-6 pb-4 flex items-start justify-between gap-4 flex-shrink-0">
            <div>
                <span class="inline-flex items-center px-3 py-1 rounded-full bg-green-50 text-green-700 text-xs font-bold uppercase tracking-widest mb-3">
                    Skema Aktif
                </span>
                <h2 id="modal-title" class="text-2xl font-extrabold text-stone-900 leading-tight"></h2>
            </div>
            <button
                onclick="closeSkemaModal()"
                class="flex-shrink-0 mt-1 w-8 h-8 flex items-center justify-center rounded-full bg-stone-100 hover:bg-stone-200 text-stone-500 hover:text-stone-700 transition"
                aria-label="Tutup"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- Body --}}
        <div class="px-6 pb-6 space-y-6">

            {{-- Deskripsi --}}
            <div>
                <h4 class="text-xs font-bold uppercase tracking-widest text-stone-400 mb-2">Deskripsi</h4>
                <p id="modal-deskripsi" class="text-stone-700 text-sm leading-relaxed"></p>
            </div>

            {{-- Unit Kompetensi / Kriteria --}}
            <div id="modal-kriterias-section">
                <h4 class="text-xs font-bold uppercase tracking-widest text-stone-400 mb-3">Unit Kompetensi</h4>
                <ul id="modal-kriterias" class="space-y-2"></ul>
                <p id="modal-no-kriteria" class="hidden text-sm text-stone-400 italic">Belum ada unit kompetensi yang tercatat.</p>
            </div>

            {{-- Action --}}
            <div id="modal-action" class="pt-2 flex gap-3 border-t border-stone-100"></div>
        </div>
    </div>
</div>


{{-- ===== DATA SKEMA (JSON) ===== --}}
<script>
const skemaData = @json($skemaJson);

// ──────────────────────────────────────────────
// SEARCH FILTER
// ──────────────────────────────────────────────
const searchInput = document.getElementById('skema-search');
const noResult    = document.getElementById('no-result');

searchInput.addEventListener('input', function () {
    const q     = this.value.toLowerCase().trim();
    const cards = document.querySelectorAll('.skema-card');
    let   shown = 0;

    cards.forEach(card => {
        const nama  = card.dataset.nama     || '';
        const desk  = card.dataset.deskripsi || '';
        const match = !q || nama.includes(q) || desk.includes(q);
        card.style.display = match ? '' : 'none';
        if (match) shown++;
    });

    noResult.classList.toggle('hidden', shown > 0 || q === '');
});

// ──────────────────────────────────────────────
// MODAL LOGIC
// ──────────────────────────────────────────────
const modal        = document.getElementById('skema-modal');
const modalPanel   = document.getElementById('modal-panel');
const modalTitle   = document.getElementById('modal-title');
const modalDesk    = document.getElementById('modal-deskripsi');
const modalList    = document.getElementById('modal-kriterias');
const modalNoKrit  = document.getElementById('modal-no-kriteria');
const modalAction  = document.getElementById('modal-action');

function openSkemaModal(id) {
    const data = skemaData[id];
    if (!data) return;

    // Populate
    modalTitle.textContent = data.nama_skema;
    modalDesk.textContent  = data.deskripsi;

    // Kriterias
    modalList.innerHTML = '';
    if (data.kriterias && data.kriterias.length > 0) {
        modalNoKrit.classList.add('hidden');
        data.kriterias.forEach((k, i) => {
            const li = document.createElement('li');
            li.className = 'flex items-start gap-3 bg-green-50 rounded-xl px-4 py-3';
            li.innerHTML = `
                <span class="flex-shrink-0 w-6 h-6 rounded-full bg-green-600 text-white text-xs font-extrabold flex items-center justify-center mt-0.5">${i + 1}</span>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-stone-800">${k.nama}</p>
                    ${k.bobot ? `<p class="text-xs text-stone-500 mt-0.5">Bobot: ${k.bobot}</p>` : ''}
                </div>`;
            modalList.appendChild(li);
        });
    } else {
        modalNoKrit.classList.remove('hidden');
    }

    // Action buttons
    const isAsesi = {{ (auth()->check() && auth()->user()->role === 'asesi') ? 'true' : 'false' }};
    const isGuest = {{ auth()->guest() ? 'true' : 'false' }};
    modalAction.innerHTML = '';

    if (isGuest) {
        modalAction.innerHTML = `<a href="{{ route('login') }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-white border border-stone-300 rounded-xl text-sm font-bold text-stone-700 hover:bg-stone-100 transition">Login untuk Mendaftar</a>`;
    } else if (isAsesi) {
        modalAction.innerHTML = `<a href="{{ route('asesi.skema') }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-green-700 text-white rounded-xl text-sm font-bold hover:bg-green-800 transition">Daftar Skema Ini</a>`;
    }

    // Show modal
    modal.style.setProperty('display', 'flex', 'important');
    document.body.style.overflow = 'hidden';

    requestAnimationFrame(() => {
        modalPanel.style.transform = 'scale(1)';
        modalPanel.style.opacity   = '1';
    });
}

function closeSkemaModal() {
    modalPanel.style.transform = 'scale(0.95)';
    modalPanel.style.opacity   = '0';
    setTimeout(() => {
        modal.style.setProperty('display', 'none', 'important');
        document.body.style.overflow = '';
    }, 250);
}

// Close on Escape key
document.addEventListener('keydown', e => {
    if (e.key === 'Escape') closeSkemaModal();
});
</script>

@endsection

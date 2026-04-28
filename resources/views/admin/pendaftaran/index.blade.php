@extends('layouts.app')

@section('content')

<h2>Data Pendaftaran</h2>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif

<!-- 🔍 SEARCH & FILTER -->
<form method="GET" action="{{ route('admin.pendaftaran') }}" class="row mb-3">

    <div class="col-md-4">
        <input type="text" name="search" class="form-control"
               placeholder="Cari nama / email..."
               value="{{ request('search') }}">
    </div>

    <div class="col-md-3">
        <select name="status" class="form-control">
            <option value="">Semua Status</option>
            <option value="pending" {{ request('status')=='pending'?'selected':'' }}>Pending</option>
            <option value="diterima" {{ request('status')=='diterima'?'selected':'' }}>Diterima</option>
            <option value="ditolak" {{ request('status')=='ditolak'?'selected':'' }}>Ditolak</option>
            <option value="lulus" {{ request('status')=='lulus'?'selected':'' }}>Lulus</option>
            <option value="tidak_lulus" {{ request('status')=='tidak_lulus'?'selected':'' }}>Tidak Lulus</option>
        </select>
    </div>

    <div class="col-md-2">
        <button class="btn btn-primary w-100">Search</button>
    </div>

    <div class="col-md-2">
        <a href="{{ route('admin.pendaftaran') }}" class="btn btn-secondary w-100">Reset</a>
    </div>

</form>

<a href="{{ route('admin.pendaftaran.export.excel') }}" class="btn btn-success mb-3">
    Export Excel
</a>
<a href="{{ route('admin.pendaftaran.export.pdf') }}" class="btn btn-danger mb-3">
    Export PDF
</a>
<a href="{{ route('admin.laporan') }}" class="btn btn-dark mb-3">
    Cetak Laporan PDF
</a>

<!-- 📋 TABLE -->
<table class="table table-bordered">
<tr>
    <th>Nama</th>
    <th>Email</th>
    <th>Skema</th>
    <th>Status</th>
    <th>Aksi</th>
    <th>Validasi Oleh</th>
    <th>Waktu</th>
</tr>

@foreach($data as $d)
<tr>
    <td>{{ $d->user->name }}</td>
    <td>{{ $d->user->email }}</td>
    <td>{{ $d->skema->nama_skema }}</td>

    <!-- ✅ STATUS -->
    <td>
        <span class="badge 
            @if($d->status == 'pending') bg-secondary
            @elseif($d->status == 'diterima') bg-primary
            @elseif($d->status == 'lulus') bg-success
            @elseif($d->status == 'ditolak') bg-danger
            @elseif($d->status == 'tidak_lulus') bg-dark
            @endif
        ">
            {{ $d->status }}
        </span>
    </td>

    <!-- ✅ AKSI -->
    <td>
        @if(in_array($d->status, ['pending','diterima']))
        <form action="/admin/pendaftaran/{{ $d->id }}" method="POST">
            @csrf
            @method('PATCH')

            <select name="status" class="form-select mb-1">
                @if($d->status == 'pending')
                    <option value="diterima">Diterima</option>
                    <option value="ditolak">Ditolak</option>
                @elseif($d->status == 'diterima')
                    <option value="lulus">Lulus</option>
                    <option value="tidak_lulus">Tidak Lulus</option>
                @endif
            </select>

            <button class="btn btn-primary btn-sm w-100">
                Update
            </button>
        </form>
        @else
            <span class="text-muted">Selesai</span>
        @endif

        @if($d->status == 'lulus')
            <a href="/sertifikat/{{ $d->id }}" class="btn btn-success btn-sm mt-1 w-100">
                Cetak Sertifikat
            </a>
        @endif
    </td>

    <!-- ✅ VALIDATOR -->
    <td>
        {{ $d->validated_by ? $d->validator->name : '-' }}
    </td>

    <!-- ✅ WAKTU -->
    <td>
        {{ $d->validated_at ? \Illuminate\Support\Carbon::parse($d->validated_at)->format('d-m-Y H:i') : '-' }}
    </td>

</tr>
@endforeach

</table>

<!-- 📄 PAGINATION -->
<div class="mt-3">
    {{ $data->withQueryString()->links() }}
</div>

@endsection
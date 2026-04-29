@extends('layouts.app')

@section('content')

<h2>Pendaftaran Saya</h2>

<form method="GET" action="{{ route('asesi.pendaftaran') }}" class="row mb-3">
    <div class="col-md-4">
        <input type="text" name="search" class="form-control"
               placeholder="Cari nama skema..."
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
        <button class="btn btn-primary w-100">Filter</button>
    </div>

    <div class="col-md-2">
        <a href="{{ route('asesi.pendaftaran') }}" class="btn btn-secondary w-100">Reset</a>
    </div>
</form>

@if($data->isEmpty())
    <p class="text-muted">Belum ada pendaftaran.</p>
@else
    <table class="table table-bordered">
        <tr>
            <th>Skema</th>
            <th>Status</th>
            <th>Nilai</th>
            <th>No Sertifikat</th>
        </tr>

        @foreach($data as $d)
        <tr>
            <td>{{ $d->skema->nama_skema ?? '-' }}</td>
            <td>{{ $d->status }}</td>
            <td>{{ $d->nilai ?? '-' }}</td>
            <td>{{ $d->no_sertifikat ?? '-' }}</td>
        </tr>
        @endforeach
    </table>

    <div class="mt-3">
        {{ $data->withQueryString()->links() }}
    </div>
@endif

@endsection

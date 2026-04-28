@extends('layouts.app')

@section('content')

<h2>Pendaftaran Saya</h2>

@if($data->isEmpty())
    <p>Belum ada pendaftaran</p>
@endif

<form method="GET" class="row mb-3">

    <div class="col-md-4">
        <input type="text" name="search" class="form-control"
               placeholder="Cari nama / email..."
               value="{{ request('search') }}">
    </div>

    <div class="col-md-3">
        <select name="status" class="form-control">
        <select name="status" class="form-control">
    <option value="">Semua Status</option>

    <option value="pending" {{ request('status')=='pending'?'selected':'' }}>
        Pending
    </option>

    <option value="diterima" {{ request('status')=='diterima'?'selected':'' }}>
        Diterima
    </option>

    <option value="ditolak" {{ request('status')=='ditolak'?'selected':'' }}>
        Ditolak
    </option>

    <option value="lulus" {{ request('status')=='lulus'?'selected':'' }}>
        Lulus
    </option>

    <option value="tidak_lulus" {{ request('status')=='tidak_lulus'?'selected':'' }}>
        Tidak Lulus
    </option>
</select>
    </div>

    <div class="col-md-2">
        <button class="btn btn-primary w-100">Filter</button>
    </div>

</form>

<table class="table">
<tr>
    <th>Skema</th>
    <th>Status</th>
</tr>

@foreach($data as $d)
<tr>
    <td>{{ $d->skema->nama_skema ?? '-' }}</td>
    <td>{{ $d->status }}</td>
</tr>
@endforeach

</table>

@endsection
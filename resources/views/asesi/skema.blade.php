@extends('layouts.app')

@section('content')

<h2>Daftar Skema</h2>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif

<table class="table table-bordered">
<tr>
    <th>Nama Skema</th>
    <th>Deskripsi</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>

@foreach($skema as $s)
@php($daftar = $pendaftaran->get($s->id))
<tr>
    <td>{{ $s->nama_skema }}</td>
    <td>{{ $s->deskripsi }}</td>
    <td>
        @if($daftar)
            <span class="badge bg-secondary">{{ $daftar->status }}</span>
        @else
            <span class="text-muted">Belum daftar</span>
        @endif
    </td>
    <td>
        @if($daftar)
            <span class="text-muted">Sudah terdaftar</span>
        @else
            <form action="{{ route('asesi.daftar', $s->id) }}" method="POST">
                @csrf
                <button class="btn btn-success btn-sm">Daftar</button>
            </form>
        @endif
    </td>
</tr>
@endforeach

</table>

@endsection

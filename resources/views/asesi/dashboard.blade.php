@extends('layouts.app')

@section('content')

<h2>Dashboard Asesi</h2>

<p>Selamat datang, {{ auth()->user()->name }}</p>

<div class="d-flex gap-2 mb-3">
    <a href="{{ route('asesi.skema') }}" class="btn btn-primary">Lihat Skema</a>
    <a href="{{ route('asesi.pendaftaran') }}" class="btn btn-outline-secondary">Pendaftaran Saya</a>
</div>

<h4>Notifikasi</h4>

@if($notifikasi->isEmpty())
    <p class="text-muted">Belum ada notifikasi.</p>
@else
    @foreach($notifikasi as $n)
        <div class="alert alert-info">
            {{ $n->notifikasi }}
        </div>
    @endforeach
@endif

<h4 class="mt-4">Status Pendaftaran</h4>

@if($pendaftaran->isEmpty())
    <p class="text-muted">Belum ada pendaftaran.</p>
@else
    <table class="table table-bordered mt-2">
        <tr>
            <th>Skema</th>
            <th>Status</th>
            <th>Nilai</th>
            <th>No Sertifikat</th>
            <th>Aksi</th>
        </tr>

        @foreach($pendaftaran as $d)
        <tr>
            <td>{{ $d->skema->nama_skema }}</td>
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
            <td>{{ $d->nilai ?? '-' }}</td>
            <td>{{ $d->no_sertifikat ?? '-' }}</td>
            <td>
                @if($d->status == 'lulus')
                    <a href="{{ route('sertifikat.cetak', $d->id) }}" class="btn btn-success btn-sm">Cetak Sertifikat</a>
                @else
                    <span class="text-muted">Belum tersedia</span>
                @endif
            </td>
        </tr>
        @endforeach
    </table>
@endif

@endsection

@extends('layouts.app')

@section('content')

<h2>Dashboard Asesi</h2>

<p>Selamat datang, {{ auth()->user()->name }}</p>

<a href="/skema-list" class="btn btn-primary">Lihat Skema</a>

<h4>Notifikasi</h4>

@foreach($pendaftaran as $p)
    @if($p->notifikasi)
        <div class="alert alert-info">
            {{ $p->notifikasi }}
        </div>
    @endif
@endforeach

<h4 class="mt-4">Status Pendaftaran</h4>

@if($pendaftaran->isEmpty())
    <p class="text-muted">Belum ada pendaftaran.</p>
@else
    <table class="table table-bordered mt-2">
        <tr>
            <th>Skema</th>
            <th>Status</th>
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
            <td>{{ $d->no_sertifikat ?? '-' }}</td>
            <td>
                @if($d->status == 'lulus')
                    <a href="/sertifikat/{{ $d->id }}" class="btn btn-success btn-sm">Cetak Sertifikat</a>
                @else
                    <span class="text-muted">Belum tersedia</span>
                @endif
            </td>
        </tr>
        @endforeach
    </table>
@endif

@endsection

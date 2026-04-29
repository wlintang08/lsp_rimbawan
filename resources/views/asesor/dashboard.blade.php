@extends('layouts.app')

@section('content')

<div class="container">
    <h3 class="mb-4">Dashboard Asesor</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            Data Peserta Asesmen
        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Skema</th>
                        <th>Status</th>
                        <th>Nilai</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($data as $i => $d)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $d->user->name }}</td>
                        <td>{{ $d->skema->nama_skema }}</td>
                        <td>{{ $d->status }}</td>
                        <td>
                            @if($d->nilai !== null)
                                <span class="badge {{ $d->nilai >= 70 ? 'bg-success' : 'bg-danger' }}">
                                    {{ number_format($d->nilai, 2) }}
                                </span>
                            @else
                                <span class="text-muted">Belum dinilai</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('asesor.nilai.form', $d->id) }}" class="btn btn-primary btn-sm">
                                {{ $d->nilai !== null ? 'Ubah Nilai' : 'Nilai' }}
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Tidak ada data peserta</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

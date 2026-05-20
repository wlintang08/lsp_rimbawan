@extends('layouts.app')

@section('content')

<h2>Data Skema</h2>

<a href="{{ route('skema.create') }}" class="btn btn-primary mb-3">Tambah Skema</a>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th style="width: 60px;">No</th>
            <th>Nama Skema</th>
            <th>Deskripsi</th>
            <th style="width: 160px;">Unit Kompetensi</th>
            <th style="width: 180px;">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($skema as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nama_skema }}</td>
                <td>{{ Str::limit($item->deskripsi, 120) }}</td>
                <td>{{ $item->kriterias_count }} unit</td>
                <td>
                    <a href="{{ route('skema.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    @if(auth()->user()->role === 'superadmin')
                        <form action="{{ route('skema.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus skema ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center text-muted">Belum ada data skema.</td>
            </tr>
        @endforelse
    </tbody>
</table>

@endsection

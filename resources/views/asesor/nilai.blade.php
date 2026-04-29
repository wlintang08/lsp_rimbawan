@extends('layouts.app')

@section('content')

<h3>Form Penilaian</h3>

<div class="card p-3">
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="mb-3">
        <strong>Asesi:</strong> {{ $data->user->name }}<br>
        <strong>Skema:</strong> {{ $data->skema->nama_skema }}
    </div>

    <form method="POST" action="{{ route('asesor.nilai', $data->id) }}">
        @csrf

        <table class="table table-bordered">
            <tr>
                <th>Kriteria</th>
                <th>Bobot</th>
                <th>Nilai</th>
            </tr>

            @foreach($data->skema->kriterias as $k)
            <tr>
                <td>{{ $k->nama }}</td>
                <td>{{ $k->bobot }}</td>
                <td>
                    <input type="number"
                           name="nilai[{{ $k->id }}]"
                           class="form-control"
                           min="0" max="100"
                           value="{{ old('nilai.' . $k->id, $nilaiTersimpan[$k->id]->nilai ?? '') }}"
                           required>
                </td>
            </tr>
            @endforeach
        </table>

        <button class="btn btn-success">Simpan Penilaian</button>
        <a href="{{ route('asesor.dashboard') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

@endsection

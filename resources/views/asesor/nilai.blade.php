@extends('layouts.app')

@section('content')

<h3>Form Penilaian</h3>

<div class="card p-3">

<form method="POST" action="{{ route('asesor.nilai', $data->id) }}">
@csrf

<table class="table table-bordered">
<tr>
    <th>Kriteria</th>
    <th>Nilai</th>
</tr>

@foreach($data->skema->kriterias as $k)
<tr>
    <td>{{ $k->nama }}</td>
    <td>
        <input type="number" 
               name="nilai[{{ $k->id }}]" 
               class="form-control"
               min="0" max="100"
               required>
    </td>
</tr>
@endforeach

</table>

<button class="btn btn-success">
    Simpan Penilaian
</button>

</form>

</div>

@endsection
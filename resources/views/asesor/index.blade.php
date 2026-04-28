@extends('layouts.app')

@section('content')

<h2>Data Asesor</h2>

<a href="/asesor/create" class="btn btn-primary mb-3">Tambah Asesor</a>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
...
</table>

@endsection
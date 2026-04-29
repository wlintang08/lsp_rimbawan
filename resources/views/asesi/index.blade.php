@extends('layouts.app')

@section('content')

<h2>Data Asesi</h2>

<a href="{{ route('asesi.create') }}" class="btn btn-primary mb-3">Tambah Asesi</a>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
...
</table>

@endsection

@extends('layouts.app')

@section('content')

<h2>Data Skemar</h2>

<a href="/skema/create" class="btn btn-primary mb-3">Tambah Skema</a>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
...
</table>

@endsection
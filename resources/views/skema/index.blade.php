@extends('layouts.app')

@section('content')

<h2>Data Skema</h2>

<a href="{{ route('skema.create') }}" class="btn btn-primary mb-3">Tambah Skema</a>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
...
</table>

@endsection

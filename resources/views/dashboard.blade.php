@extends('layouts.app')

@section('content')

<h2>Dashboard Admin</h2>

<p>Selamat datang, {{ auth()->user()->name }}</p>

<div class="row">
    <div class="col-md-4">
        <a href="{{ route('asesi.index') }}" class="btn btn-primary w-100 mb-2">Data Asesi</a>
    </div>
    <div class="col-md-4">
        <a href="{{ route('asesor.index') }}" class="btn btn-success w-100 mb-2">Data Asesor</a>
    </div>
    <div class="col-md-4">
        <a href="{{ route('skema.index') }}" class="btn btn-warning w-100 mb-2">Data Skema</a>
    </div>
    <div class="col-md-4">
        <a href="{{ route('admin.pendaftaran') }}" class="btn btn-dark w-100 mb-2">Data Pendaftaran</a>
    </div>
</div>

@endsection

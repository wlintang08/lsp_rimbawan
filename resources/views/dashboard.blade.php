@extends('layouts.app')

@section('content')

<h2>Dashboard Admin</h2>

<p>Selamat datang, {{ auth()->user()->name }}</p>

<div class="row">
    <div class="col-md-4">
        <a href="/asesi" class="btn btn-primary w-100 mb-2">Data Asesi</a>
    </div>
    <div class="col-md-4">
        <a href="/asesor" class="btn btn-success w-100 mb-2">Data Asesor</a>
    </div>
    <div class="col-md-4">
        <a href="/skema" class="btn btn-warning w-100 mb-2">Data Skema</a>
    </div>
    <div class="col-md-4">
        <a href="/admin/pendaftaran" class="btn btn-dark w-100 mb-2">
            Data Pendaftaran
        </a>
    </div>
</div>

@endsection
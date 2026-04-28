@extends('layouts.app')

@section('content')

<h2>Audit Log</h2>

<table class="table table-bordered">
<tr>
    <th>User</th>
    <th>Aksi</th>
    <th>Deskripsi</th>
    <th>Waktu</th>
</tr>

@foreach($logs as $log)
<tr>
    <td>{{ $log->user->name ?? '-' }}</td>
    <td>{{ $log->aksi }}</td>
    <td>{{ $log->deskripsi }}</td>
    <td>{{ $log->created_at }}</td>
</tr>
@endforeach

</table>

{{ $logs->links() }}

@endsection
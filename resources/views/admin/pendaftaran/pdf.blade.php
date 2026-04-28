<h2>Data Pendaftaran</h2>

<table border="1" width="100%" cellpadding="5">
<tr>
    <th>Nama</th>
    <th>Email</th>
    <th>Skema</th>
    <th>Status</th>
</tr>

@foreach($data as $d)
<tr>
    <td>{{ $d->user->name }}</td>
    <td>{{ $d->user->email }}</td>
    <td>{{ $d->skema->nama_skema }}</td>
    <td>{{ $d->status }}</td>
</tr>
@endforeach

</table>
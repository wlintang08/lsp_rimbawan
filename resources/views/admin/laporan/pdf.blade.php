<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Pendaftaran</title>

    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        h2 {
            text-align: center;
        }

        .tanggal {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }

        th {
            background: #eee;
        }

        th, td {
            padding: 6px;
        }

        .footer {
            margin-top: 40px;
            text-align: right;
        }
    </style>
</head>
<body>

<h2>LAPORAN DATA PENDAFTARAN</h2>
<div class="tanggal">Tanggal: {{ $tanggal }}</div>

<table>
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Skema</th>
        <th>Status</th>
    </tr>

    @foreach($data as $i => $d)
    <tr>
        <td>{{ $i+1 }}</td>
        <td>{{ $d->user->name }}</td>
        <td>{{ $d->user->email }}</td>
        <td>{{ $d->skema->nama_skema }}</td>
        <td>{{ $d->status }}</td>
    </tr>
    @endforeach
</table>

<div class="footer">
    <p>Admin LSP</p>
    <br><br>
    <p>(___________________)</p>
</div>

</body>
</html>
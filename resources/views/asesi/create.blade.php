<!DOCTYPE html>
<html>
<head>
    <title>Tambah Asesi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

<h2>Tambah Asesi</h2>

<form action="{{ route('asesi.store') }}" method="POST">
    @csrf

    <input type="text" name="nama" class="form-control mb-2" placeholder="Nama">
    <input type="text" name="nik" class="form-control mb-2" placeholder="NIK">
    <input type="email" name="email" class="form-control mb-2" placeholder="Email">
    <input type="text" name="no_hp" class="form-control mb-2" placeholder="No HP">
    <textarea name="alamat" class="form-control mb-2" placeholder="Alamat"></textarea>

    <select name="skema_id" class="form-control mb-2">
        <option value="">-- Pilih Skema --</option>
        @foreach($skema as $s)
        <option value="{{ $s->id }}">{{ $s->nama_skema }}</option>
        @endforeach
    </select>

    <button class="btn btn-success">Simpan</button>
</form>

</body>
</html>

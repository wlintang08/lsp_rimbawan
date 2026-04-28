<!DOCTYPE html>
<html>
<head>
    <title>Tambah Asesor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

<h2>Tambah Asesor</h2>

<form action="/asesor" method="POST">
    @csrf

    <input type="text" name="nama" class="form-control mb-2" placeholder="Nama">
    <input type="text" name="kompetensi" class="form-control mb-2" placeholder="Kompetensi">
    <input type="text" name="no_hp" class="form-control mb-2" placeholder="No HP">

    <button class="btn btn-success">Simpan</button>
</form>

</body>
</html>
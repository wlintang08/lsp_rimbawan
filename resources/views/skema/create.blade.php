<!DOCTYPE html>
<html>
<head>
    <title>Tambah Skema</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

<h2>Tambah Skema</h2>

<form action="/skema" method="POST">
    @csrf

    <input type="text" name="nama_skema" class="form-control mb-2" placeholder="Nama Skema">

    <textarea name="deskripsi" class="form-control mb-2" placeholder="Deskripsi"></textarea>

    <button class="btn btn-success">Simpan</button>
</form>

</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Asesor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

<h2>Edit Asesor</h2>

<form action="{{ route('asesor.update', $asesor->id) }}" method="POST">
    @csrf
    @method('PUT')

    <input type="text" name="nama" value="{{ $asesor->nama }}" class="form-control mb-2">
    <input type="text" name="kompetensi" value="{{ $asesor->kompetensi }}" class="form-control mb-2">
    <input type="text" name="no_hp" value="{{ $asesor->no_hp }}" class="form-control mb-2">

    <button class="btn btn-primary">Update</button>
</form>

</body>
</html>

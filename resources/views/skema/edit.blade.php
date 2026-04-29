<!DOCTYPE html>
<html>
<head>
    <title>Edit Skema</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

<h2>Edit Skema</h2>

<form action="{{ route('skema.update', $skema->id) }}" method="POST">
    @csrf
    @method('PUT')

    <input type="text" name="nama_skema" value="{{ $skema->nama_skema }}" class="form-control mb-2">

    <textarea name="deskripsi" class="form-control mb-2">{{ $skema->deskripsi }}</textarea>

    <button class="btn btn-primary">Update</button>
</form>

</body>
</html>

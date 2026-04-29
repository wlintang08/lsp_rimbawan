<!DOCTYPE html>
<html>
<head>
    <title>Edit Asesi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

<h2>Edit Asesi</h2>

<form action="{{ route('asesi.update', $asesi->id) }}" method="POST">
    @csrf
    @method('PUT')

    <input type="text" name="nama" value="{{ $asesi->nama }}" class="form-control mb-2">
    <input type="text" name="nik" value="{{ $asesi->nik }}" class="form-control mb-2">
    <input type="email" name="email" value="{{ $asesi->email }}" class="form-control mb-2">
    <input type="text" name="no_hp" value="{{ $asesi->no_hp }}" class="form-control mb-2">
    <textarea name="alamat" class="form-control mb-2">{{ $asesi->alamat }}</textarea>

    <select name="skema_id" class="form-control mb-2">
        @foreach($skema as $s)
        <option value="{{ $s->id }}" {{ $asesi->skema_id == $s->id ? 'selected' : '' }}>
            {{ $s->nama_skema }}
        </option>
        @endforeach
    </select>

    <button class="btn btn-primary">Update</button>
</form>

</body>
</html>

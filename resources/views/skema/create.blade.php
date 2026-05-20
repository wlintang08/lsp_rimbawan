<!DOCTYPE html>
<html>
<head>
    <title>Tambah Skema</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

<h2>Tambah Skema</h2>

<form action="{{ route('skema.store') }}" method="POST">
    @csrf

    <input type="text" name="nama_skema" class="form-control mb-2" placeholder="Nama Skema" value="{{ old('nama_skema') }}">

    <textarea name="deskripsi" class="form-control mb-2" rows="5" placeholder="Deskripsi">{{ old('deskripsi') }}</textarea>

    <label class="form-label">Unit Kompetensi</label>
    <textarea name="unit_kompetensi" class="form-control mb-2" rows="6" placeholder="Tulis satu unit kompetensi per baris">{{ old('unit_kompetensi') }}</textarea>
    <div class="form-text mb-3">Contoh: Mengukur kayu bulat rimba. Setiap baris akan disimpan sebagai unit kompetensi terpisah.</div>

    <button class="btn btn-success">Simpan</button>
</form>

</body>
</html>

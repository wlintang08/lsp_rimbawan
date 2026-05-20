<!DOCTYPE html>
<html>
<head>
    <title>Edit Skema</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

<h2>Edit Skema</h2>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<form action="{{ route('skema.update', $skema->id) }}" method="POST">
    @csrf
    @method('PUT')

    <input type="text" name="nama_skema" value="{{ old('nama_skema', $skema->nama_skema) }}" class="form-control mb-2">

    <label class="form-label">Deskripsi</label>
    <textarea id="deskripsi" name="deskripsi" class="form-control mb-2" rows="6">{{ old('deskripsi', $skema->deskripsi) }}</textarea>

    <div class="d-flex align-items-center justify-content-between mt-3">
        <label class="form-label mb-0">Tambah Unit Kompetensi</label>
        <button type="button" id="moveUnits" class="btn btn-sm btn-outline-secondary">Pindahkan daftar dari deskripsi</button>
    </div>
    <textarea id="unit_kompetensi" name="unit_kompetensi" class="form-control mb-2" rows="6" placeholder="Tulis satu unit kompetensi per baris">{{ old('unit_kompetensi') }}</textarea>
    <div class="form-text mb-3">Isi hanya unit baru. Unit yang sudah ada tidak akan dibuat ganda.</div>

    <button class="btn btn-primary">Update</button>
    <a href="{{ route('skema.index') }}" class="btn btn-secondary">Kembali</a>
</form>

<hr>

<h5>Unit Kompetensi Saat Ini</h5>
@if($skema->kriterias->count())
    <ul class="list-group">
        @foreach($skema->kriterias as $kriteria)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span>{{ $kriteria->nama }}</span>
                <form action="{{ route('skema.kriteria.destroy', [$skema->id, $kriteria->id]) }}" method="POST" onsubmit="return confirm('Hapus unit kompetensi ini?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger">Hapus</button>
                </form>
            </li>
        @endforeach
    </ul>
@else
    <p class="text-muted">Belum ada unit kompetensi.</p>
@endif

<script>
document.getElementById('moveUnits').addEventListener('click', function () {
    const desc = document.getElementById('deskripsi');
    const units = document.getElementById('unit_kompetensi');
    const lines = desc.value.split(/\r?\n/);
    const unitLines = [];
    const descLines = [];

    lines.forEach(function (line) {
        const trimmed = line.trim();
        if (/^([-*]|\d+[\.)])\s+/.test(trimmed)) {
            unitLines.push(trimmed.replace(/^([-*]|\d+[\.)])\s+/, ''));
        } else {
            descLines.push(line);
        }
    });

    units.value = [units.value, unitLines.join("\n")].filter(Boolean).join("\n");
    desc.value = descLines.join("\n").trim();
});
</script>

</body>
</html>

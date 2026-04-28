<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Sertifikat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f4f7f6;
            color: #1f2933;
        }

        .container {
            max-width: 560px;
            margin: 40px auto;
            background: #ffffff;
            border: 1px solid #d8e2dc;
            border-radius: 8px;
            padding: 28px;
        }

        h2 {
            margin-top: 0;
            color: #14532d;
        }

        .row {
            margin-bottom: 12px;
        }

        .label {
            display: block;
            margin-bottom: 4px;
            font-weight: bold;
        }

        .valid {
            color: #15803d;
            font-size: 24px;
            font-weight: bold;
            margin-top: 20px;
        }

        .invalid {
            color: #b91c1c;
            font-size: 24px;
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Verifikasi Sertifikat</h2>

        <div class="row">
            <span class="label">Nama</span>
            {{ $data->user->name }}
        </div>

        <div class="row">
            <span class="label">Skema</span>
            {{ $data->skema->nama_skema }}
        </div>

        <div class="row">
            <span class="label">No Sertifikat</span>
            {{ $data->no_sertifikat ?? '-' }}
        </div>

        <div class="row">
            <span class="label">Status</span>
            {{ $data->status }}
        </div>

        @if($data->status == 'lulus')
            <div class="valid">VALID</div>
        @else
            <div class="invalid">TIDAK VALID</div>
        @endif
    </div>
</body>
</html>
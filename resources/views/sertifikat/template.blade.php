<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sertifikat Kompetensi</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 8mm;
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            color: #17251d;
            font-family: "DejaVu Sans", Arial, sans-serif;
            background: #ffffff;
        }

        .certificate {
            position: relative;
            width: 262mm;
            height: 176mm;
            margin: 0 auto;
            padding: 0;
            overflow: hidden;
            border: 1.6mm double #1f5a37;
            page-break-inside: avoid;
        }

        .certificate:before {
            content: "";
            position: absolute;
            top: 3.2mm;
            right: 3.2mm;
            bottom: 3.2mm;
            left: 3.2mm;
            border: .35mm solid #8cae94;
        }

        .content {
            position: absolute;
            top: 10mm;
            right: 12mm;
            bottom: 12mm;
            left: 12mm;
            z-index: 1;
        }

        .topbar {
            width: 100%;
            border-bottom: .55mm solid #1f5a37;
            border-collapse: collapse;
            padding-bottom: 0;
        }

        .topbar td {
            padding: 0 0 4mm;
        }

        .logo-cell {
            width: 22mm;
            vertical-align: middle;
        }

        .logo {
            width: 18mm;
            height: 18mm;
            border: .7mm solid #1f5a37;
            border-radius: 50%;
            text-align: center;
            color: #1f5a37;
            font-weight: bold;
            line-height: 1;
            padding-top: 4.2mm;
            font-size: 10px;
        }

        .logo span {
            display: block;
            margin-top: 1.3mm;
            font-size: 5.6px;
            letter-spacing: .4px;
        }

        .agency {
            text-align: left;
            vertical-align: middle;
        }

        .agency .name {
            margin: 0;
            font-size: 18px;
            font-weight: 800;
            letter-spacing: 1.8px;
            text-transform: uppercase;
        }

        .agency .subtitle {
            margin: 1.5mm 0 0;
            font-size: 9px;
            color: #53645a;
            letter-spacing: .9px;
            text-transform: uppercase;
        }

        .number-box {
            position: absolute;
            top: 6mm;
            right: 2mm;
            width: 60mm;
            text-align: right;
            font-size: 8px;
            color: #53645a;
        }

        .number-box strong {
            display: block;
            margin-top: 1.5mm;
            color: #17251d;
            font-size: 10.5px;
            letter-spacing: .4px;
            white-space: nowrap;
        }

        .title {
            margin-top: 8mm;
            text-align: center;
        }

        .title h1 {
            margin: 0;
            color: #1f5a37;
            font-family: Georgia, "Times New Roman", serif;
            font-size: 25px;
            font-weight: bold;
            letter-spacing: 5px;
            text-transform: uppercase;
        }

        .title .line {
            width: 38mm;
            height: .6mm;
            margin: 3mm auto 0;
            background: #c7a54b;
        }

        .intro {
            width: 150mm;
            margin: 6mm auto 0;
            text-align: center;
            color: #415045;
            font-size: 10.5px;
            line-height: 1.65;
        }

        .recipient {
            width: 165mm;
            margin: 3mm auto 0;
            padding-bottom: 2.4mm;
            border-bottom: .45mm solid #c7a54b;
            text-align: center;
        }

        .recipient h2 {
            margin: 0;
            color: #14261b;
            font-family: Georgia, "Times New Roman", serif;
            font-size: 21px;
            font-weight: bold;
            line-height: 1.1;
            text-transform: uppercase;
        }

        .scheme-label {
            margin: 4mm 0 1.5mm;
            text-align: center;
            color: #53645a;
            font-size: 8px;
            letter-spacing: .9px;
            text-transform: uppercase;
        }

        .scheme {
            width: 165mm;
            max-height: 13mm;
            margin: 0 auto;
            overflow: hidden;
            text-align: center;
            color: #173521;
            font-size: 13px;
            font-weight: bold;
            line-height: 1.28;
        }

        .meta {
            width: 165mm;
            margin: 4mm auto 0;
            border-collapse: collapse;
            color: #415045;
            font-size: 8px;
        }

        .meta td {
            padding: 2mm 2.2mm;
            border-top: .25mm solid #dfe7e2;
            border-bottom: .25mm solid #dfe7e2;
        }

        .meta .label {
            width: 31mm;
            color: #53645a;
            letter-spacing: .5px;
            text-transform: uppercase;
        }

        .qr-area {
            position: absolute;
            left: 8mm;
            bottom: 20mm;
            width: 34mm;
            text-align: center;
        }

        .qr-area img {
            width: 22mm;
            height: 22mm;
        }

        .qr-area p {
            margin: 1mm 0 0;
            color: #53645a;
            font-size: 7px;
        }

        .qr-area .verify-note {
            width: 42mm;
            margin-left: -4mm;
            line-height: 1.35;
        }

        .signature {
            position: absolute;
            right: 8mm;
            bottom: 20mm;
            width: 70mm;
            text-align: center;
        }

        .signature .city {
            margin: 0 0 3mm;
            font-size: 8px;
        }

        .signature .sign-mark {
            height: 12mm;
            color: #1f5a37;
            font-family: Georgia, "Times New Roman", serif;
            font-size: 17px;
            font-style: italic;
            line-height: 12mm;
        }

        .signature .line {
            width: 46mm;
            margin: 0 auto 1.5mm;
            border-top: .35mm solid #17251d;
        }

        .signature .name {
            margin: 0;
            font-size: 8px;
            font-weight: bold;
            letter-spacing: .2px;
            text-transform: uppercase;
        }

        .signature .role {
            margin: 1mm 0 0;
            color: #53645a;
            font-size: 6.5px;
            letter-spacing: .5px;
            text-transform: uppercase;
        }

    </style>
</head>
<body>
    <div class="certificate">
        <div class="content">
            <table class="topbar">
                <tr>
                    <td class="logo-cell">
                        <div class="logo">LSP<span>RIMBAWAN</span></div>
                    </td>
                    <td class="agency">
                        <p class="name">LSP Rimbawan</p>
                        <p class="subtitle">Lembaga Sertifikasi Profesi</p>
                    </td>
                </tr>
            </table>

            <div class="number-box">
                Nomor Sertifikat
                <strong>{{ $pendaftaran->no_sertifikat ?? '-' }}</strong>
            </div>

            <div class="title">
                <h1>Sertifikat Kompetensi</h1>
                <div class="line"></div>
            </div>

            <p class="intro">
                Diberikan kepada peserta yang telah dinyatakan memenuhi persyaratan dan kompeten pada skema sertifikasi berikut.
            </p>

            <div class="recipient">
                <h2>{{ $asesi->name }}</h2>
            </div>

            <p class="scheme-label">Skema Sertifikasi</p>
            <div class="scheme">{{ $skema->nama_skema }}</div>

            <table class="meta">
                <tr>
                    <td class="label">Tanggal Terbit</td>
                    <td>{{ $tanggal }}</td>
                    <td class="label">Status</td>
                    <td>{{ strtoupper(str_replace('_', ' ', $pendaftaran->status)) }}</td>
                </tr>
            </table>

            <div class="qr-area">
                <img src="data:image/svg+xml;base64,{{ $qr }}" alt="QR Verifikasi">
                <p>Scan untuk verifikasi</p>
                <p class="verify-note">Sertifikat ini dapat diverifikasi melalui QR Code yang tertera.</p>
            </div>

            <div class="signature">
                <p class="city">Ditetapkan di Indonesia, {{ $tanggal }}</p>
                <div class="sign-mark">ttd</div>
                <div class="line"></div>
                <p class="name">Ketua LSP Rimbawan</p>
                <p class="role">Penanggung Jawab Sertifikasi</p>
            </div>
        </div>
    </div>
</body>
</html>

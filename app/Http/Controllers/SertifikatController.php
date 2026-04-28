<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class SertifikatController extends Controller
{
    public function cetak($id)
    {
        $pendaftaran = Pendaftaran::with('user', 'skema')->findOrFail($id);
        $this->authorize('cetak', $pendaftaran);

        if ($pendaftaran->status !== 'lulus') {
            abort(403, 'Tidak berhak mencetak sertifikat');
        }

        if (Auth::user()->role !== 'admin' && $pendaftaran->user_id !== Auth::id()) {
            abort(403, 'Tidak berhak mencetak sertifikat');
        }

        $verificationUrl = rtrim(config('app.url'), '/')
            . route('sertifikat.verify', $pendaftaran->id, false);

        // Generate QR as SVG so it does not require the PHP Imagick extension.
        $qr = base64_encode(
            QrCode::format('svg')
                ->size(180)
                ->margin(2)
                ->errorCorrection('H')
                ->generate($verificationUrl)
        );

        $pdf = Pdf::loadView('sertifikat.template', [
            'asesi' => $pendaftaran->user,
            'skema' => $pendaftaran->skema,
            'pendaftaran' => $pendaftaran,
            'tanggal' => now()->format('d M Y'),
            'qr' => $qr,
            'verificationUrl' => $verificationUrl,
        ])->setPaper('a4', 'landscape');

        return $pdf->download('sertifikat.pdf');
    }
}

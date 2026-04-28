<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\UpdateStatusRequest;
use App\Exports\PendaftaranExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class PendaftaranController extends Controller
{
    public function index(Request $request)
    {
        $query = Pendaftaran::with(['user','skema']);

        // SEARCH
        if ($request->search) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        // FILTER
        if ($request->status) {
            $query->where('status', $request->status);
        }

        $data = $query->latest()->paginate(10);

        return view('admin.pendaftaran.index', compact('data'));
    }

    public function updateStatus(UpdateStatusRequest $request, $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $this->authorize('update', $pendaftaran);

        $current = $pendaftaran->status;
        $new = $request->status;

        // ❗ STATUS FINAL TIDAK BOLEH DIUBAH
        if (in_array($current, [
            Pendaftaran::STATUS_LULUS,
            Pendaftaran::STATUS_TIDAK_LULUS
        ])) {
            return back()->with('error', 'Status sudah final dan tidak bisa diubah');
        }

        // ❗ RULE TRANSISI STATUS
        $allowed = [
            Pendaftaran::STATUS_PENDING => [
                Pendaftaran::STATUS_DITERIMA,
                Pendaftaran::STATUS_DITOLAK
            ],
            Pendaftaran::STATUS_DITERIMA => [
                Pendaftaran::STATUS_LULUS,
                Pendaftaran::STATUS_TIDAK_LULUS
            ],
            Pendaftaran::STATUS_DITOLAK => [],
            Pendaftaran::STATUS_LULUS => [],
            Pendaftaran::STATUS_TIDAK_LULUS => []
        ];

        if (!in_array($new, $allowed[$current])) {
            return back()->with('error', 'Transisi status tidak valid');
        }

        // ✅ NOTIFIKASI
        $pesan = '';

        if ($new == 'diterima') {
            $pesan = 'Pendaftaran Anda diterima';
        } elseif ($new == 'ditolak') {
            $pesan = 'Pendaftaran Anda ditolak';
        } elseif ($new == 'lulus') {
            $pesan = 'Selamat! Anda dinyatakan LULUS';
        } elseif ($new == 'tidak_lulus') {
            $pesan = 'Anda belum lulus, silakan coba lagi';
        }

        // ✅ UPDATE DATA
        $pendaftaran->status = $new;
        $pendaftaran->notifikasi = $pesan;
        $pendaftaran->is_read = false;
        $pendaftaran->validated_by = Auth::id();
        $pendaftaran->validated_at = now();

        // ✅ GENERATE NOMOR SERTIFIKAT
        if ($new === Pendaftaran::STATUS_LULUS && empty($pendaftaran->no_sertifikat)) {

            $lastNumber = Pendaftaran::whereYear('created_at', now()->year)
                ->whereNotNull('no_sertifikat')
                ->selectRaw('MAX(CAST(SUBSTRING_INDEX(no_sertifikat, "/", -1) AS UNSIGNED)) as max_no')
                ->value('max_no');

            $nextNumber = $lastNumber ? $lastNumber + 1 : 1;

            $no = str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

            $pendaftaran->no_sertifikat = "LSP-RIM/" . now()->year . "/" . $no;
        }

        // ✅ SIMPAN
        $pendaftaran->save();

        // ✅ LOG
        Log::info('Update status pendaftaran', [
            'pendaftaran_id' => $pendaftaran->id,
            'status_lama' => $current,
            'status_baru' => $new,
            'admin_id' => Auth::id(),
            'waktu' => now()
        ]);

        return back()->with('success', 'Status berhasil diperbarui');
    }

    public function exportExcel()
    {
        return Excel::download(new PendaftaranExport, 'pendaftaran.xlsx');
    }

    public function exportPdf()
    {
        $data = Pendaftaran::with('user','skema')->get();

        $pdf = Pdf::loadView('admin.pendaftaran.pdf', compact('data'));

        return $pdf->download('pendaftaran.pdf');
    }

    public function laporanPdf()
    {
        $data = \App\Models\Pendaftaran::with('user','skema')->latest()->get();

        $tanggal = now()->format('d-m-Y');

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.laporan.pdf', compact('data','tanggal'));

        return $pdf->stream('laporan-pendaftaran.pdf');
    }

}
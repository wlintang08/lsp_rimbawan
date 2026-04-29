<?php

namespace App\Http\Controllers\Asesor;

use App\Http\Controllers\Controller;
use App\Models\NilaiKriteria;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $data = Pendaftaran::with('user', 'skema')
            ->whereIn('status', [Pendaftaran::STATUS_DITERIMA, Pendaftaran::STATUS_LULUS, Pendaftaran::STATUS_TIDAK_LULUS])
            ->latest()
            ->get();

        return view('asesor.dashboard', compact('data'));
    }

    public function nilai(Request $request, $id)
    {
        $request->validate([
            'nilai' => 'required|array|min:1',
            'nilai.*' => 'required|numeric|min:0|max:100',
        ]);

        $data = Pendaftaran::with('skema.kriterias')->findOrFail($id);

        if (!in_array($data->status, [Pendaftaran::STATUS_DITERIMA, Pendaftaran::STATUS_LULUS, Pendaftaran::STATUS_TIDAK_LULUS], true)) {
            return redirect()->route('asesor.dashboard')->with('error', 'Pendaftaran ini belum bisa dinilai.');
        }

        $kriterias = $data->skema?->kriterias ?? collect();

        if ($kriterias->isEmpty()) {
            return redirect()->route('asesor.dashboard')->with('error', 'Skema belum memiliki kriteria penilaian.');
        }

        $totalBobot = 0;
        $totalNilai = 0;

        foreach ($kriterias as $kriteria) {
            $nilai = (float) ($request->nilai[$kriteria->id] ?? 0);
            $bobot = max((int) $kriteria->bobot, 1);

            NilaiKriteria::updateOrCreate(
                [
                    'pendaftaran_id' => $id,
                    'kriteria_id' => $kriteria->id,
                ],
                [
                    'nilai' => $nilai,
                ]
            );

            $totalNilai += $nilai * $bobot;
            $totalBobot += $bobot;
        }

        $rata = $totalBobot > 0 ? round($totalNilai / $totalBobot, 2) : 0;
        $status = $rata >= 70 ? Pendaftaran::STATUS_LULUS : Pendaftaran::STATUS_TIDAK_LULUS;

        $data->update([
            'nilai' => $rata,
            'status' => $status,
            'asesor_id' => Auth::id(),
            'notifikasi' => $status === Pendaftaran::STATUS_LULUS
                ? 'Selamat! Anda dinyatakan LULUS'
                : 'Anda belum lulus, silakan coba lagi',
            'is_read' => false,
        ]);

        return redirect()->route('asesor.dashboard')->with('success', 'Penilaian berhasil disimpan');
    }

    public function formNilai($id)
    {
        $data = Pendaftaran::with(['skema.kriterias', 'nilaiKriteria'])->findOrFail($id);

        if (!in_array($data->status, [Pendaftaran::STATUS_DITERIMA, Pendaftaran::STATUS_LULUS, Pendaftaran::STATUS_TIDAK_LULUS], true)) {
            return redirect()->route('asesor.dashboard')->with('error', 'Pendaftaran ini belum bisa dinilai.');
        }

        $nilaiTersimpan = $data->nilaiKriteria->keyBy('kriteria_id');

        return view('asesor.nilai', compact('data', 'nilaiTersimpan'));
    }
}

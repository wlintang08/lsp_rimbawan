<?php

namespace App\Http\Controllers\Asesor;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\NilaiKriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // hanya yang sudah diterima
        $data = Pendaftaran::with('user','skema')
            ->where('status', 'diterima')
            ->get();

        return view('asesor.dashboard', compact('data'));
    }

    public function nilai(Request $request, $id)
    {
        $data = \App\Models\Pendaftaran::findOrFail($id);

        $total = 0;
        $count = count($request->nilai);

        foreach ($request->nilai as $kriteria_id => $nilai) {

            \App\Models\NilaiKriteria::updateOrCreate(
                [
                    'pendaftaran_id' => $id,
                    'kriteria_id' => $kriteria_id
                ],
                [
                    'nilai' => $nilai
                ]
            );

            $total += $nilai;
        }

        $rata = $total / $count;

        $status = $rata >= 70 ? 'lulus' : 'tidak_lulus';

        $data->update([
            'nilai' => $rata,
            'status' => $status,
            'asesor_id' => auth::id()
        ]);

        return redirect()->route('asesor.dashboard')
        ->with('success', 'Penilaian berhasil disimpan');
    }

    public function formNilai($id)
    {
        $data = \App\Models\Pendaftaran::with('skema.kriterias')->findOrFail($id);

        return view('asesor.nilai', compact('data'));
    }
}
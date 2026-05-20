<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Skema;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    /**
     * Simpan unit kompetensi baru ke skema tertentu.
     */
    public function store(Request $request, Skema $skema)
    {
        $request->validate([
            'nama'  => 'required|string|max:255',
            'bobot' => 'nullable|integer|min:1',
        ]);

        $skema->kriterias()->create([
            'nama'  => $request->nama,
            'bobot' => $request->bobot ?? 1,
        ]);

        return back()->with('success', 'Unit kompetensi berhasil ditambahkan.');
    }

    /**
     * Hapus unit kompetensi.
     */
    public function destroy(Skema $skema, Kriteria $kriteria)
    {
        abort_unless($kriteria->skema_id === $skema->id, 404);

        $kriteria->delete();

        return back()->with('success', 'Unit kompetensi berhasil dihapus.');
    }
}

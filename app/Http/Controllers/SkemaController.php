<?php

namespace App\Http\Controllers;

use App\Models\Skema;
use Illuminate\Http\Request;

class SkemaController extends Controller
{
    public function index()
    {
        $skema = Skema::withCount('kriterias')->latest()->get();
        return view('skema.index', compact('skema'));
    }

    public function create()
    {
        return view('skema.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_skema' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'unit_kompetensi' => 'nullable|string',
        ]);

        $skema = Skema::create($request->only('nama_skema', 'deskripsi'));
        $this->storeUnitKompetensi($skema, $request->input('unit_kompetensi'));

        return redirect()->route('skema.index')->with('success', 'Data skema berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $skema = Skema::with('kriterias')->findOrFail($id);
        return view('skema.edit', compact('skema'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_skema' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'unit_kompetensi' => 'nullable|string',
        ]);

        $skema = Skema::findOrFail($id);
        $skema->update($request->only('nama_skema', 'deskripsi'));
        $this->storeUnitKompetensi($skema, $request->input('unit_kompetensi'));

        return redirect()->route('skema.index')->with('success', 'Data skema berhasil diupdate.');
    }

    public function destroy($id)
    {
        if (auth()->user()->role !== 'superadmin') {
            abort(403);
        }

        Skema::destroy($id);

        return back()->with('success', 'Data skema berhasil dihapus.');
    }

    private function storeUnitKompetensi(Skema $skema, ?string $unitKompetensi): void
    {
        if (! $unitKompetensi) {
            return;
        }

        $existing = $skema->kriterias()
            ->pluck('nama')
            ->map(fn ($nama) => mb_strtolower(trim($nama)))
            ->all();

        collect(preg_split('/\r\n|\r|\n/', $unitKompetensi))
            ->map(fn ($line) => trim(preg_replace('/^\s*(?:[-*]|\d+[\.)])\s*/', '', $line)))
            ->filter()
            ->unique(fn ($line) => mb_strtolower($line))
            ->reject(fn ($line) => in_array(mb_strtolower($line), $existing, true))
            ->each(fn ($line) => $skema->kriterias()->create([
                'nama' => $line,
                'bobot' => 1,
            ]));
    }
}

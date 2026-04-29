<?php

namespace App\Http\Controllers;

use App\Models\Asesor;
use Illuminate\Http\Request;

class AsesorController extends Controller
{
    public function index()
    {
        $asesor = Asesor::all();
        return view('asesor.index', compact('asesor'));
    }

    public function create()
    {
        return view('asesor.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kompetensi' => 'required|string|max:255',
            'no_hp' => 'required|string|max:50',
        ]);

        Asesor::create($request->all());

        return redirect()->route('asesor.index')->with('success', 'Data asesor berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $asesor = Asesor::findOrFail($id);
        return view('asesor.edit', compact('asesor'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kompetensi' => 'required|string|max:255',
            'no_hp' => 'required|string|max:50',
        ]);

        $asesor = Asesor::findOrFail($id);
        $asesor->update($request->all());

        return redirect()->route('asesor.index')->with('success', 'Data asesor berhasil diupdate.');
    }

    public function destroy($id)
    {
        if (auth()->user()->role !== 'superadmin') {
            abort(403);
        }

        Asesor::destroy($id);

        return back()->with('success', 'Data asesor berhasil dihapus.');
    }
}

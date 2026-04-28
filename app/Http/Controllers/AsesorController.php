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
            'nama' => 'required',
            'kompetensi' => 'required'
        ]);

        Asesor::create($request->all());

        return redirect('/asesor')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $asesor = Asesor::findOrFail($id);
        return view('asesor.edit', compact('asesor'));
    }

    public function update(Request $request, $id)
    {
        $asesor = Asesor::findOrFail($id);
        $asesor->update($request->all());

        return redirect('/asesor')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        Asesor::destroy($id);

        return redirect('/asesor')->with('success', 'Data berhasil dihapus');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Skema;
use Illuminate\Http\Request;

class SkemaController extends Controller
{
    public function index()
    {
        $skema = Skema::all();
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
        ]);

        Skema::create($request->all());

        return redirect()->route('skema.index')->with('success', 'Data skema berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $skema = Skema::findOrFail($id);
        return view('skema.edit', compact('skema'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_skema' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $skema = Skema::findOrFail($id);
        $skema->update($request->all());

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
}

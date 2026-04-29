<?php

namespace App\Http\Controllers;

use App\Models\Asesi;
use App\Models\Skema;
use Illuminate\Http\Request;

class AsesiController extends Controller
{
    public function index()
    {
        $asesi = Asesi::with('skema')->get();
        return view('asesi.index', compact('asesi'));
    }

    public function create()
    {
        $skema = Skema::all();
        return view('asesi.create', compact('skema'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:50',
            'email' => 'required|email|max:255',
            'no_hp' => 'required|string|max:50',
            'alamat' => 'required|string',
            'skema_id' => 'required|exists:skemas,id',
        ]);

        Asesi::create($request->all());

        return redirect()->route('asesi.index')->with('success', 'Data asesi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $asesi = Asesi::findOrFail($id);
        $skema = Skema::all();

        return view('asesi.edit', compact('asesi', 'skema'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:50',
            'email' => 'required|email|max:255',
            'no_hp' => 'required|string|max:50',
            'alamat' => 'required|string',
            'skema_id' => 'required|exists:skemas,id',
        ]);

        $asesi = Asesi::findOrFail($id);
        $asesi->update($request->all());

        return redirect()->route('asesi.index')->with('success', 'Data asesi berhasil diupdate.');
    }

    public function destroy($id)
    {
        if (auth()->user()->role !== 'superadmin') {
            abort(403);
        }

        Asesi::destroy($id);

        return back()->with('success', 'Data asesi berhasil dihapus.');
    }
}

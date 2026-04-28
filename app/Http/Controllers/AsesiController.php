<?php

namespace App\Http\Controllers;

use App\Models\Asesi;
use App\Models\Skema; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AsesiController extends Controller
{
    public function index()
    {
        $asesi = Asesi::all();
        return view('asesi.index', compact('asesi'));
    }

    public function create()
    {
        $skema = Skema::all(); // WAJIB ADA
        return view('asesi.create', compact('skema')); // WAJIB ADA
    }

    public function store(Request $request)
    {
        Asesi::create($request->all());
        return redirect('/asesi');
    }

    public function edit($id)
    {
        $asesi = Asesi::findOrFail($id);
        return view('asesi.edit', compact('asesi'));
    }

    public function update(Request $request, $id)
    {
        $asesi = Asesi::findOrFail($id);
        $asesi->update($request->all());
        return redirect('/asesi');
    }

   public function destroy($id)
    {
    // 🔒 BATASI HANYA SUPERADMIN
        if (auth::user()->role !== 'superadmin') {
        abort(403);
    }

    $data = \App\Models\User::findOrFail($id);
    $data->delete();

    return back()->with('success', 'Data berhasil dihapus');
    }
}
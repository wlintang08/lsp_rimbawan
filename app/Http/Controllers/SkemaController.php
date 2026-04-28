<?php

namespace App\Http\Controllers;

use App\Models\Skema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        Skema::create($request->all());

        return redirect('/skema');
    }

    public function edit($id)
    {
        $skema = Skema::findOrFail($id);

        return view('skema.edit', compact('skema'));
    }

    public function update(Request $request, $id)
    {
        $skema = Skema::findOrFail($id);
        $skema->update($request->all());

        return redirect('/skema');
    }

    public function destroy($id)
    {
        if (auth::user()->role !== 'superadmin') {
        abort(403);
    }

    \App\Models\Skema::destroy($id);

    return back();
    }
}

<?php

namespace App\Http\Controllers\Asesi;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PendaftaranController extends Controller
{
    public function index(Request $request)
    {
        $query = Pendaftaran::with('skema')
            ->where('user_id', Auth::id());

        if ($request->filled('search')) {
            $query->whereHas('skema', function ($q) use ($request) {
                $q->where('nama_skema', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $data = $query->latest()->paginate(10);

        return view('asesi.pendaftaran.index', compact('data'));
    }
}

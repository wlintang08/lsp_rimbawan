<?php

namespace App\Http\Controllers\Asesi;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Auth;

class PendaftaranController extends Controller
{
 public function index()
    {
        $data = \App\Models\Pendaftaran::with('skema')
            ->where('user_id', Auth::id())
            ->get();

        return view('asesi.pendaftaran.index', compact('data'));
    }
}
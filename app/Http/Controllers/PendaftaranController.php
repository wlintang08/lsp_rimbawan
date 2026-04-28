<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Skema;
use Illuminate\Support\Facades\Auth;

class PendaftaranController extends Controller
{
    public function dashboard()
    {
        $pendaftaran = Pendaftaran::with('skema')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        // ✅ ambil notifikasi
        $notifikasi = $pendaftaran->whereNotNull('notifikasi');

        return view('asesi.dashboard', compact('pendaftaran','notifikasi'));
    }

    public function skemaList()
    {
        $skema = Skema::all();

        $pendaftaran = Pendaftaran::where('user_id', Auth::id())
            ->get()
            ->keyBy('skema_id');

        return view('asesi.skema', compact('skema', 'pendaftaran'));
    }

    public function daftar($id)
    {
        Skema::findOrFail($id);

        // cek apakah sudah pernah daftar
        $cek = Pendaftaran::where('user_id', Auth::id())
            ->where('skema_id', $id)
            ->first();

        if ($cek) {
            return back()->with('error', 'Anda sudah mendaftar skema ini');
        }

        // simpan ke database
        Pendaftaran::create([
            'user_id' => Auth::id(),
            'skema_id' => $id,
            'status' => 'pending'
        ]);

        return back()->with('success', 'Berhasil mendaftar');
    }
}
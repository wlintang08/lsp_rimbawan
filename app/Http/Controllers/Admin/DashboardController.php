<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // =====================
        // STATISTIK UTAMA
        // =====================
        $totalAsesi = User::where('role', 'asesi')->count();
        $totalPendaftaran = Pendaftaran::count();

        $totalLulus = Pendaftaran::where('status', 'lulus')->count();
        $totalTidakLulus = Pendaftaran::where('status', 'tidak_lulus')->count();
        $totalDitolak = Pendaftaran::where('status', 'ditolak')->count();
        $totalPending = Pendaftaran::where('status', 'pending')->count();

        // =====================
        // CHART PER BULAN (2 VERSI)
        // =====================

        // Versi 1 (untuk Chart.js array biasa)
        $perBulan = Pendaftaran::select(
                DB::raw('MONTH(created_at) as bulan'),
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        // Versi 2 (langsung key-value, lebih simpel)
        $chart = Pendaftaran::select(
                DB::raw('MONTH(created_at) as bulan'),
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('bulan')
            ->pluck('total', 'bulan');

        // =====================
        // DISTRIBUSI STATUS
        // =====================
        $statusChart = Pendaftaran::select(
                'status',
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('status')
            ->get();

        // =====================
        // TOP SKEMA
        // =====================
        $topSkema = Pendaftaran::select(
                'skema_id',
                DB::raw('COUNT(*) as total')
            )
            ->with('skema')
            ->groupBy('skema_id')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalAsesi',
            'totalPendaftaran',
            'totalLulus',
            'totalTidakLulus',
            'totalDitolak',
            'totalPending',
            'perBulan',
            'chart',
            'statusChart',
            'topSkema'
        ));
    }
}
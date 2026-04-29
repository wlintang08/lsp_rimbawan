<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Pendaftaran;

// CONTROLLERS
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PendaftaranController as AdminPendaftaranController;
use App\Http\Controllers\Admin\AuditLogController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\Asesi\PendaftaranController as AsesiPendaftaranController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AsesiController;
use App\Http\Controllers\AsesorController;
use App\Http\Controllers\SkemaController;
use App\Http\Controllers\SertifikatController;
use App\Http\Controllers\Asesor\DashboardController as AsesorDashboardController;

// ======================
// ROOT
// ======================
Route::get('/', function () {

    if (Auth::check()) {

        if (Auth::user()->role === 'superadmin' || Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if (Auth::user()->role === 'asesi') {
            return redirect()->route('asesi.dashboard');
        }

        if (Auth::user()->role === 'asesor') {
            return redirect('/asesor/dashboard'); // nanti kita buat
        }
    }

    return redirect()->route('login');
});


// ======================
// ADMIN + SUPERADMIN
// ======================
Route::middleware(['auth','role:admin,superadmin'])->prefix('admin')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

    // CRUD
    Route::resource('asesi', AsesiController::class);
    Route::resource('asesor', AsesorController::class);
    Route::resource('skema', SkemaController::class);

    // PENDAFTARAN
    Route::get('/pendaftaran', [AdminPendaftaranController::class, 'index'])
        ->name('admin.pendaftaran');

    Route::patch('/pendaftaran/{id}', [AdminPendaftaranController::class, 'updateStatus'])
        ->name('admin.pendaftaran.update');

    Route::get('/pendaftaran/export-excel', [AdminPendaftaranController::class, 'exportExcel'])
        ->name('admin.pendaftaran.export.excel');

    Route::get('/pendaftaran/export-pdf', [AdminPendaftaranController::class, 'exportPdf'])
        ->name('admin.pendaftaran.export.pdf');

    Route::get('/laporan', [AdminPendaftaranController::class, 'laporanPdf'])
        ->name('admin.laporan');

    // AUDIT LOG
    Route::get('/audit-log', [AuditLogController::class, 'index'])
        ->name('admin.audit');
});

// ======================
// ASESOR
// ======================
Route::middleware(['auth','role:asesor'])->prefix('asesor')->group(function () {

    Route::get('/dashboard', [AsesorDashboardController::class, 'index'])
        ->name('asesor.dashboard');

    Route::post('/nilai/{id}', [AsesorDashboardController::class, 'nilai'])
        ->name('asesor.nilai');
    
    Route::get('/nilai/{id}', [AsesorDashboardController::class, 'formNilai'])
        ->name('asesor.nilai.form');
});


// ======================
// ASESI
// ======================
Route::middleware(['auth','role:asesi'])->prefix('asesi')->group(function () {

    Route::get('/dashboard', [PendaftaranController::class, 'dashboard'])
        ->name('asesi.dashboard');

    Route::get('/skema-list', [PendaftaranController::class, 'skemaList'])
        ->name('asesi.skema');

    Route::post('/daftar/{id}', [PendaftaranController::class, 'daftar'])
        ->name('asesi.daftar');

    Route::get('/pendaftaran-saya', [AsesiPendaftaranController::class, 'index'])
        ->name('asesi.pendaftaran');
});


// ======================
// PROFILE
// ======================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// ======================
// SERTIFIKAT
// ======================
Route::middleware('auth')->group(function () {
    Route::get('/sertifikat/{id}', [SertifikatController::class, 'cetak'])
        ->name('sertifikat.cetak');
});


// ======================
// VERIFY (PUBLIC)
// ======================
Route::get('/verify/{id}', function ($id) {
    $data = Pendaftaran::with('user','skema')->findOrFail($id);
    return view('verify', compact('data'));
})->name('sertifikat.verify');


// ======================
// NOTIFIKASI
// ======================
Route::post('/notifikasi/read', function () {

    \App\Models\Pendaftaran::where('user_id', Auth::id())
        ->whereNotNull('notifikasi')
        ->update(['is_read' => true]);

    return response()->json(['success' => true]);

})->middleware('auth')->name('notifikasi.read');


// ======================
// AUTH
// ======================
require __DIR__.'/auth.php';


Route::middleware('auth')->get('/dashboard', function () {
    $user = Auth::user();

    if ($user->role === 'superadmin' || $user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    if ($user->role === 'asesor') {
        return redirect()->route('asesor.dashboard');
    }

    return redirect()->route('asesi.dashboard');
})->name('dashboard');

Route::middleware(['auth', 'role:admin,superadmin'])->group(function () {
    Route::redirect('/asesi', '/admin/asesi');
    Route::redirect('/asesi/create', '/admin/asesi/create');
    Route::redirect('/asesor', '/admin/asesor');
    Route::redirect('/asesor/create', '/admin/asesor/create');
    Route::redirect('/skema', '/admin/skema');
    Route::redirect('/skema/create', '/admin/skema/create');
});

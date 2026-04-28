<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Asesi\PendaftaranController as AsesiPendaftaranController;
use App\Http\Controllers\Admin\PendaftaranController as AdminPendaftaranController;
use App\Http\Controllers\AsesiController;
use App\Http\Controllers\AsesorController;
use App\Http\Controllers\SkemaController;
use App\Http\Controllers\SertifikatController;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Auth;
// ROOT
Route::get('/', function () {

    if (auth::check()) {

        if (auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if (auth::user()->role === 'asesi') {
            return redirect()->route('asesi.dashboard');
        }
    }

    return redirect()->route('login');
});

// ======================
// ADMIN
// ======================
Route::middleware(['auth','role:admin'])->prefix('admin')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

    Route::resource('asesi', AsesiController::class);
    Route::resource('asesor', AsesorController::class);
    Route::resource('skema', SkemaController::class);

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

Route::post('/notifikasi/read', function () {

    \App\Models\Pendaftaran::where('user_id', auth::id())
        ->whereNotNull('notifikasi')
        ->update(['is_read' => true]);

    return response()->json(['success' => true]);

})->middleware('auth')->name('notifikasi.read');

// AUTH
require __DIR__.'/auth.php';
<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RpsController;
use App\Http\Controllers\DosenWaliController;
use App\Http\Controllers\Admin\MataKuliahController;

Route::get('/', function () {
    return view('welcome');
});

// Rute untuk menampilkan halaman "menunggu verifikasi" setelah registrasi
Route::get('/verification-pending', function () {
    return view('auth.verification-pending');
})->name('verification.pending');


Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('dashboard');

// Rute untuk mengelola profil pengguna
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Grup untuk Mahasiswa
Route::middleware(['auth', 'role:mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    Route::get('/rps/create', [RpsController::class, 'create'])->name('rps.create');
    Route::post('/rps/store', [RpsController::class, 'store'])->name('rps.store');
    Route::get('/rps/jadwal', [RpsController::class, 'jadwal'])->name('rps.jadwal');
    Route::get('/rps/edit', [RpsController::class, 'edit'])->name('rps.edit');
    Route::delete('/rps/drop/{mataKuliahId}', [RpsController::class, 'dropMataKuliah'])->name('rps.drop');
    Route::post('/rps/resubmit', [RpsController::class, 'resubmit'])->name('rps.resubmit');
});

// Grup untuk Dosen Wali
Route::middleware(['auth', 'role:dosen'])->prefix('dosen')->name('dosen.')->group(function () {
    // Rute untuk validasi RPS
    Route::get('/validasi', [DosenWaliController::class, 'index'])->name('validasi.index');
    Route::get('/validasi/{id}', [DosenWaliController::class, 'show'])->name('validasi.show');
    Route::post('/validasi/update/{id}', [DosenWaliController::class, 'updateStatus'])->name('validasi.update');

    // --- MULAI BLOK KODE BARU ---
    // Rute untuk verifikasi pendaftar baru
    Route::get('/verifikasi/list', [DosenWaliController::class, 'verificationList'])->name('verifikasi.list');
    Route::get('/verifikasi/approve/{user}', [DosenWaliController::class, 'showApproveForm'])->name('verifikasi.approve.form');
    Route::post('/verifikasi/approve/{user}', [DosenWaliController::class, 'approveUser'])->name('verifikasi.approve.store');
    Route::post('/verifikasi/reject/{user}', [DosenWaliController::class, 'rejectUser'])->name('verifikasi.reject');
    // --- AKHIR BLOK KODE BARU ---
});

// Grup untuk Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('matakuliah', MataKuliahController::class);
});


// PASTIKAN BARIS INI ADA DAN TIDAK DI DALAM KOMENTAR
require __DIR__.'/auth.php';


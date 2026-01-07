<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController; // Opsional jika mau pakai
use App\Http\Controllers\PenilaianController;

// Controllers Admin
use App\Http\Controllers\Admin\JurusanController;
use App\Http\Controllers\Admin\InstansiController;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\PembimbingIndustriController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\PlacementController;

// Controllers Siswa & Industri
use App\Http\Controllers\Siswa\LogbookController;
use App\Http\Controllers\Industri\ValidasiLogbookController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman Depan (Redirect ke Login)
Route::get('/', function () {
    return view('welcome');
});

// Dashboard Utama (Semua user login masuk sini dulu untuk dicek role-nya)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Group Route yang butuh Login
Route::middleware('auth')->group(function () {

    // =================================================================
    // 1. GROUP ADMIN (Hanya bisa diakses role:admin)
    // =================================================================
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {

        // Dashboard Admin
        Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');


        // Fitur Verifikasi Siswa (Action Button di Dashboard)
        Route::post('/siswa/{id}/verify', [DashboardController::class, 'verifySiswa'])->name('siswa.verify');
        Route::delete('/siswa/{id}/reject', [DashboardController::class, 'rejectSiswa'])->name('siswa.reject');

        // Master Data (Resource Controller)
        Route::resource('jurusan', JurusanController::class);
        Route::resource('instansi', InstansiController::class);
        Route::resource('guru', GuruController::class);
        Route::resource('pembimbing', PembimbingIndustriController::class); // Mentor Lapangan
        Route::resource('siswa', SiswaController::class); // CRUD Data Siswa Resmi

        // Manajemen Penempatan Magang
        Route::resource('placement', PlacementController::class)->only(['index', 'create', 'store', 'destroy']);
    });

    // =================================================================
    // 2. GROUP SISWA (Hanya bisa diakses role:siswa)
    // =================================================================
    Route::middleware('role:siswa')->prefix('siswa')->name('siswa.')->group(function () {

        // Logbook Harian
        Route::get('/logbook', [LogbookController::class, 'index'])->name('logbook.history');
        Route::get('/logbook/create', [LogbookController::class, 'create'])->name('logbook.create');
        Route::post('/logbook', [LogbookController::class, 'store'])->name('logbook.store');
        Route::get('/logbook/{id}/edit', [LogbookController::class, 'edit'])->name('logbook.edit');
        Route::put('/logbook/{id}', [LogbookController::class, 'update'])->name('logbook.update');
        Route::delete('/logbook/{id}', [LogbookController::class, 'destroy'])->name('logbook.destroy');
    });

    // =================================================================
    // 3. GROUP INDUSTRI / MENTOR (Hanya bisa diakses role:industri)
    // =================================================================
    Route::middleware('role:industri')->prefix('industri')->name('industri.')->group(function () {

        // Validasi Logbook
        Route::get('/validasi-logbook', [ValidasiLogbookController::class, 'index'])->name('logbook.index');
        Route::patch('/validasi-logbook/{id}', [ValidasiLogbookController::class, 'update'])->name('logbook.update');

        // Input Nilai (Mentor)
        Route::get('/penilaian/{placement_id}', [PenilaianController::class, 'create'])->name('penilaian.create');
        Route::post('/penilaian/{placement_id}', [PenilaianController::class, 'store'])->name('penilaian.store');
    });

    // =================================================================
    // 4. GROUP GURU (Hanya bisa diakses role:guru)
    // =================================================================
    Route::middleware('role:guru')->prefix('guru')->name('guru.')->group(function () {

        // Input Nilai (Guru) - Route sama dengan industri tapi prefix beda
        Route::get('/penilaian/{placement_id}', [PenilaianController::class, 'create'])->name('penilaian.create');
        Route::post('/penilaian/{placement_id}', [PenilaianController::class, 'store'])->name('penilaian.store');
    });

    // Profile Routes (Bawaan Breeze - Opsional)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); // Matikan agar siswa tidak hapus akun sendiri
});

require __DIR__.'/auth.php';

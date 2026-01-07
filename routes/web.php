<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PenilaianController;

// Controllers Admin
use App\Http\Controllers\Admin\JurusanController;
use App\Http\Controllers\Admin\InstansiController;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\PembimbingIndustriController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\PlacementController;

// Controllers Siswa, Industri dan Guru
use App\Http\Controllers\Siswa\LogbooksController;
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

        Route::post('/siswa/{id}/verify', [SiswaController::class, 'verify'])->name('siswa.verify');

        // Master Data (Resource Controller)
        Route::resource('jurusan', JurusanController::class);
        Route::resource('instansi', InstansiController::class);
        Route::resource('guru', GuruController::class);
        Route::resource('pembimbing', PembimbingIndustriController::class);
        Route::resource('siswa', SiswaController::class);
        Route::resource('placement', PlacementController::class);

        // Manajemen Penempatan Magang
        Route::resource('placement', PlacementController::class)->only(['index', 'create', 'store', 'destroy']);
    });

    // =================================================================
    // 2. GROUP SISWA (Hanya bisa diakses role:siswa)
    // =================================================================
    Route::middleware('role:siswa')->prefix('siswa')->name('siswa.')->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


        Route::get('/logbook', [LogbooksController::class, 'index'])->name('logbook.history');
        Route::get('/logbook/create', [LogbooksController::class, 'create'])->name('logbook.create');
        Route::post('/logbook', [LogbooksController::class, 'store'])->name('logbook.store');
        Route::get('/logbook/{id}/edit', [LogbooksController::class, 'edit'])->name('logbook.edit');
        Route::put('/logbook/{id}', [LogbooksController::class, 'update'])->name('logbook.update');
        Route::delete('/logbook/{id}', [LogbooksController::class, 'destroy'])->name('logbook.destroy');
    });

    // =================================================================
    // 3. GROUP INDUSTRI / MENTOR (Hanya bisa diakses role:industri)
    // =================================================================
    Route::middleware('role:industri')->prefix('industri')->name('industri.')->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Validasi Logbook
        Route::get('/validasi', [ValidasiLogbookController::class, 'index'])->name('validasi.index');
        Route::get('/validasi/{id}', [ValidasiLogbookController::class, 'show'])->name('validasi.show');
        Route::put('/validasi/{id}', [ValidasiLogbookController::class, 'update'])->name('validasi.update');

        Route::get('/penilaian', [PenilaianController::class, 'index'])->name('penilaian.index');
        Route::get('/penilaian/{placement_id}', [PenilaianController::class, 'create'])->name('penilaian.create');
        Route::post('/penilaian/{placement_id}', [PenilaianController::class, 'store'])->name('penilaian.store');
    });

    // =================================================================
    // 4. GROUP GURU (Hanya bisa diakses role:guru)
    // =================================================================
    Route::middleware('role:guru')->prefix('guru')->name('guru.')->group(function () {

        // Dashboard Guru
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Penilaian Guru (Lengkapi Index, Create, Store)
        Route::get('/penilaian', [PenilaianController::class, 'index'])->name('penilaian.index'); // <-- WAJIB ADA
        Route::get('/penilaian/{placement_id}', [PenilaianController::class, 'create'])->name('penilaian.create');
        Route::post('/penilaian/{placement_id}', [PenilaianController::class, 'store'])->name('penilaian.store');
    });

    // Profile Routes (Bawaan Breeze - Opsional)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); // Matikan agar siswa tidak hapus akun sendiri
});

require __DIR__ . '/auth.php';

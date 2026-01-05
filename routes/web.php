<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LogbookController;
use App\Http\Controllers\VerifikasiLogbookController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
});

    // --- RUTE SISWA ---
Route::middleware(['auth', 'role:siswa'])->prefix('siswa')->name('siswa.')->group(function () {
    
    // Dashboard Siswa (Sudah dibahas sebelumnya)
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'siswa'])->name('dashboard');

    // FITUR LOGBOOK
    Route::get('/logbook', [App\Http\Controllers\Siswa\LogbookController::class, 'index'])->name('logbook.history'); // List/History
    Route::get('/logbook/input', [App\Http\Controllers\Siswa\LogbookController::class, 'create'])->name('logbook.input'); // Form Input
    Route::post('/logbook', [App\Http\Controllers\Siswa\LogbookController::class, 'store'])->name('logbook.store'); // Proses Simpan
    
    // Edit & Hapus
    Route::get('/logbook/{id}/edit', [App\Http\Controllers\Siswa\LogbookController::class, 'edit'])->name('logbook.edit');
    Route::put('/logbook/{id}', [App\Http\Controllers\Siswa\LogbookController::class, 'update'])->name('logbook.update'); // Pakai PUT
    Route::delete('/logbook/{id}', [App\Http\Controllers\Siswa\LogbookController::class, 'destroy'])->name('logbook.destroy');

    // Profil (Jika ada)
    Route::get('/profile', function(){ return view('siswa.profile'); })->name('profile');
});

// --- RUTE INDUSTRI (MENTOR) ---
Route::middleware(['auth', 'role:industri'])->prefix('industri')->name('industri.')->group(function () {
    
    // Dashboard Industri
    Route::get('/dashboard', function() { return view('industri.dashboard'); })->name('dashboard');

    // FITUR VALIDASI
    Route::get('/validasi', [App\Http\Controllers\Industri\ValidasiLogbookController::class, 'index'])->name('validasi.index');
    Route::patch('/validasi/{id}', [App\Http\Controllers\Industri\ValidasiLogbookController::class, 'update'])->name('validasi.update');

});

});

require __DIR__.'/auth.php';

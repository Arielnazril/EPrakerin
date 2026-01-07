<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

// Route::middleware('guest')->group(function () {
//     Route::get('register', [RegisteredUserController::class, 'create'])
//                 ->name('register');

//     Route::post('register', [RegisteredUserController::class, 'store']);

//     Route::get('login', [AuthenticatedSessionController::class, 'create'])
//                 ->name('login');

//     Route::post('login', [AuthenticatedSessionController::class, 'store']);

//     Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
//                 ->name('password.request');

//     Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
//                 ->name('password.email');

//     Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
//                 ->name('password.reset');

//     Route::post('reset-password', [NewPasswordController::class, 'store'])
//                 ->name('password.store');
// });

Route::middleware('guest')->group(function () {

    // 1. Halaman Daftar (Register Siswa)
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);

    // 2. Halaman Login Utama (Siswa)
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    // 3. Halaman Login Guru (Custom View)
    Route::get('login/guru', function () {
        return view('auth.login-guru');
    })->name('login.guru');

    // 4. Halaman Login Industri (Custom View)
    Route::get('login/industri', function () {
        return view('auth.login-industri');
    })->name('login.industri');

    // --- PROSES LOGIN (Satu Pintu untuk Semua) ---
    Route::post('login', [AuthenticatedSessionController::class, 'store'])
                ->name('login.store'); // Kita namakan route prosesnya login.store

    Route::get('login/admin', function () {
    return view('auth.login-admin');
})->name('login.admin');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});

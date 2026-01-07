<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();

        // CEK 1: Apakah ini SISWA dan statusnya PENDING?
        if ($user->role === 'siswa' && $user->status_akun === 'pending') {

            // Tendang keluar (Logout paksa)
            Auth::guard('web')->logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            // Balik ke halaman login dengan pesan KUNING (status_pending)
            return redirect()->route('login')
                ->with('status_pending', 'Akun Anda sedang menunggu verifikasi Admin. Mohon bersabar.');
        }

        $role = $request->user()->role;

        if ($role === 'admin') {
            return redirect()->intended('/dashboard');
        } elseif ($role === 'guru') {
            return redirect()->intended('/dashboard');
        } elseif ($role === 'industri') {
            return redirect()->intended('/dashboard');
        }

        // Default siswa
        return redirect()->intended('/dashboard');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}

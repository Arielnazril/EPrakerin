<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Placement;
use App\Models\Logbook;
use App\Models\User;
use App\Models\Instansi;

class DashboardController extends Controller
{
    /**
     * Redirector: Menentukan user ini harus ke dashboard mana.
     */
    public function index()
    {
        $role = Auth::user()->role;

        if ($role === 'admin') {
            return $this->adminDashboard();
        } elseif ($role === 'siswa') {
            return $this->siswaDashboard();
        } elseif ($role === 'guru') {
            return $this->guruDashboard();
        } elseif ($role === 'industri') {
            return $this->industriDashboard();
        }

        return abort(403, 'Role tidak dikenali');
    }

    // --- DASHBOARD ADMIN ---
    private function adminDashboard()
    {
        // Hitung statistik untuk Admin
        $totalSiswa = User::where('role', 'siswa')->count();
        $totalGuru = User::where('role', 'guru')->count();
        $totalIndustri = Instansi::count();
        $siswaMagang = Placement::where('status', 'aktif')->count();

        return view('admin.dashboard', compact('totalSiswa', 'totalGuru', 'totalIndustri', 'siswaMagang'));
    }

    // --- DASHBOARD SISWA ---
    private function siswaDashboard()
    {
        $userId = Auth::id();
        
        // 1. Cek Status Magang (Placement)
        $placement = Placement::with(['instansi', 'mentor', 'guru'])
                              ->where('siswa_id', $userId)
                              ->where('status', 'aktif')
                              ->first();

        // 2. Cek Statistik Logbook Siswa
        $logbookSummary = [
            'total' => Logbook::where('user_id', $userId)->count(),
            'pending' => Logbook::where('user_id', $userId)->where('status', 'pending')->count(),
            'disetujui' => Logbook::where('user_id', $userId)->where('status', 'disetujui')->count(),
        ];

        return view('dashboard.siswa', compact('placement', 'logbookSummary'));
    }

    // --- DASHBOARD GURU ---
    private function guruDashboard()
    {
        $guruId = Auth::id();

        // Ambil daftar siswa yang dibimbing guru ini
        $siswaBimbingan = Placement::where('guru_id', $guruId)
                                   ->with(['siswa', 'instansi'])
                                   ->where('status', 'aktif')
                                   ->get();

        return view('dashboard.guru', compact('siswaBimbingan'));
    }

    // --- DASHBOARD INDUSTRI (MENTOR) ---
    private function industriDashboard()
    {
        $mentorId = Auth::id();

        // Ambil daftar siswa yang dimonitor mentor ini
        $siswaMagang = Placement::where('mentor_id', $mentorId)
                                ->with('siswa')
                                ->where('status', 'aktif')
                                ->get();

        // Hitung Logbook yang butuh verifikasi (Pending)
        // Ambil ID siswa dulu
        $siswaIds = $siswaMagang->pluck('siswa_id');
        
        $logbookPending = Logbook::whereIn('user_id', $siswaIds)
                                 ->where('status', 'pending')
                                 ->count();

        return view('dashboard.industri', compact('siswaMagang', 'logbookPending'));
    }
}
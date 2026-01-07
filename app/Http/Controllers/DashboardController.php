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
     * Redirector Utama: Menentukan user ini harus ke dashboard mana.
     * Diakses lewat route: /dashboard
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

    // =========================================================================
    // 1. DASHBOARD ADMIN
    // =========================================================================
    private function adminDashboard()
    {
        // A. Statistik Ringkas (Untuk Kartu di Atas)
        $totalSiswa = User::where('role', 'siswa')->count();
        $totalGuru = User::where('role', 'guru')->count();
        $totalIndustri = Instansi::count();
        $siswaMagang = Placement::where('status', 'aktif')->count();

        // B. Data Siswa Pending (PENTING: Untuk Tabel Verifikasi Pendaftaran)
        $siswaPending = User::where('role', 'siswa')
                            ->where('status_akun', 'pending')
                            ->with('jurusan')
                            ->latest()
                            ->get();

        return view('admin.dashboard', compact(
            'totalSiswa',
            'totalGuru',
            'totalIndustri',
            'siswaMagang',
            'siswaPending' // Variabel ini dikirim ke view untuk tabel validasi
        ));
    }

    /**
     * ACTION: Verifikasi Siswa (Tombol 'Terima' di Dashboard Admin)
     */
    public function verifySiswa($id)
    {
        $siswa = User::findOrFail($id);

        // Pastikan hanya siswa yang bisa diverifikasi
        if ($siswa->role !== 'siswa') {
            return back()->with('error', 'User ini bukan siswa!');
        }

        $siswa->update(['status_akun' => 'aktif']);

        return back()->with('success', 'Akun siswa ' . $siswa->name . ' berhasil diaktifkan.');
    }

    /**
     * ACTION: Tolak Siswa (Tombol 'Tolak' di Dashboard Admin)
     */
    public function rejectSiswa($id)
    {
        $siswa = User::findOrFail($id);

        // Hapus permanen jika ditolak (asumsi data sampah/spam)
        $siswa->delete();

        return back()->with('success', 'Pendaftaran siswa ditolak dan data dihapus.');
    }


    // =========================================================================
    // 2. DASHBOARD SISWA
    // =========================================================================
    private function siswaDashboard()
    {
        $user = Auth::user();

        // Cek Status Akun dulu (Double protection selain middleware)
        if ($user->status_akun !== 'aktif') {
            Auth::guard('web')->logout();
            return redirect()->route('login')->with('error', 'Akun Anda belum diaktifkan Admin.');
        }

        // 1. Cek Info Tempat Magang
        $placement = Placement::with(['instansi', 'mentor', 'guru'])
                              ->where('siswa_id', $user->id)
                              ->where('status', 'aktif')
                              ->first();

        // 2. Statistik Logbook Pribadi
        $logbookSummary = [
            'total' => Logbook::where('user_id', $user->id)->count(),
            'pending' => Logbook::where('user_id', $user->id)->where('status', 'pending')->count(),
            'disetujui' => Logbook::where('user_id', $user->id)->where('status', 'disetujui')->count(),
        ];

        return view('dashboard.siswa', compact('placement', 'logbookSummary'));
    }


    // =========================================================================
    // 3. DASHBOARD GURU
    // =========================================================================
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


    // =========================================================================
    // 4. DASHBOARD INDUSTRI (MENTOR)
    // =========================================================================
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Placement;
use App\Models\Penilaian;
use Illuminate\Support\Facades\Auth;

class PenilaianController extends Controller
{
    /**
     * Menampilkan daftar siswa yang bisa dinilai.
     * Otomatis membedakan view antara Guru dan Mentor.
     */
    public function index()
    {
        $user = Auth::user();
        $placements = [];

        // 1. LOGIKA UNTUK MENTOR INDUSTRI
        if ($user->role == 'industri') {
            $placements = Placement::where('mentor_id', $user->id)
                                   ->where('status', 'aktif')
                                   ->with(['siswa', 'instansi'])
                                   ->get();

            return view('industri.penilaian.index', compact('placements'));
        }

        // 2. LOGIKA UNTUK GURU SEKOLAH
        elseif ($user->role == 'guru') {
            $placements = Placement::where('guru_id', $user->id)
                                   ->where('status', 'aktif')
                                   ->with(['siswa', 'instansi'])
                                   ->get();

            return view('guru.penilaian.index', compact('placements'));
        }

        abort(403); // Akses ditolak jika bukan guru/industri
    }

    /**
     * Form Input Nilai
     */
    public function create($placement_id)
    {
        $user = Auth::user();
        $placement = Placement::with('siswa')->findOrFail($placement_id);

        // Cek apakah User ini SUDAH menilai siswa ini sebelumnya?
        $existingNilai = Penilaian::where('placement_id', $placement_id)
                                  ->where('penilai_id', $user->id)
                                  ->first();

        // Tentukan route redirect jika sudah nilai
        $redirectRoute = ($user->role == 'guru') ? 'guru.penilaian.index' : 'industri.penilaian.index';

        if ($existingNilai) {
            return redirect()->route($redirectRoute)
                             ->with('error', 'Siswa ini sudah Anda nilai sebelumnya.');
        }

        // Tampilkan View sesuai Role
        if ($user->role == 'guru') {
            return view('guru.penilaian.create', compact('placement'));
        } else {
            return view('industri.penilaian.create', compact('placement'));
        }
    }

    /**
     * Simpan Nilai ke Database
     */
    public function store(Request $request, $placement_id)
    {
        $request->validate([
            'aspek_teknis' => 'required|numeric|min:0|max:100',
            'aspek_non_teknis' => 'required|numeric|min:0|max:100',
            'catatan' => 'nullable|string',
        ]);

        // Simpan Data
        Penilaian::create([
            'placement_id' => $placement_id,
            'penilai_id' => Auth::id(), // ID User yang sedang login (Guru/Mentor)
            'aspek_teknis' => $request->aspek_teknis,
            'aspek_non_teknis' => $request->aspek_non_teknis,
            'nilai_akhir' => ($request->aspek_teknis + $request->aspek_non_teknis) / 2,
            'catatan' => $request->catatan,
        ]);

        // Tentukan Redirect Sesuai Role (INI PERBAIKANNYA)
        $redirectRoute = (Auth::user()->role == 'guru') ? 'guru.penilaian.index' : 'industri.penilaian.index';

        return redirect()->route($redirectRoute)
                         ->with('success', 'Nilai berhasil disimpan untuk siswa ' . $request->nama_siswa);
    }
}

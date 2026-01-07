<?php

namespace App\Http\Controllers\Industri;

use App\Http\Controllers\Controller;
use App\Models\Logbook;
use App\Models\Placement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ValidasiLogbookController extends Controller
{
    /**
     * Menampilkan daftar logbook siswa yang MEMBUTUHKAN validasi.
     */
    public function index()
    {
        $mentorId = Auth::id();

        // 1. Cari siapa saja siswa yang dibimbing oleh Mentor ini
        $siswaIds = Placement::where('mentor_id', $mentorId)
                             ->where('status', 'aktif')
                             ->pluck('siswa_id');

        // 2. Ambil logbook dari siswa-siswa tersebut
        $logbooks = Logbook::with('siswa') // Ganti 'siswa' jadi 'user' jika relasi di model Logbook namanya 'user'
                            ->whereIn('user_id', $siswaIds)
                            ->orderBy('tanggal', 'desc')
                            ->orderBy('status', 'asc')
                            ->get();


        return view('industri.validasi.index', compact('logbooks')); // JANGAN LUPA compact('logbooks')
    }

    /**
     * Menampilkan Detail Logbook (INI YANG KURANG TADINYA)
     */
    public function show($id)
    {
        $mentorId = Auth::id();

        // Security: Pastikan siswa ini beneran bimbingan mentor ini
        $siswaIds = Placement::where('mentor_id', $mentorId)->pluck('siswa_id');

        // Cari logbook
        $logbook = Logbook::with('siswa')->whereIn('user_id', $siswaIds)->findOrFail($id);

        return view('industri.validasi.show', compact('logbook'));
    }

    /**
     * Proses Validasi (Setujui / Tolak).
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:disetujui,ditolak',
            'catatan' => 'nullable|string',
        ]);

        $mentorId = Auth::id();
        $siswaIds = Placement::where('mentor_id', $mentorId)->pluck('siswa_id');

        $logbook = Logbook::whereIn('user_id', $siswaIds)->findOrFail($id);

        $logbook->update([
            'status' => $request->status,
            'catatan_pembimbing' => $request->catatan,
            'validated_by' => $mentorId,
            'validated_at' => now(),
        ]);

        return redirect()->route('industri.validasi.index')->with('success', 'Logbook berhasil divalidasi.');
    }
}

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
                             ->pluck('siswa_id'); // Ambil array ID siswa

        // 2. Ambil logbook dari siswa-siswa tersebut
        $logbooks = Logbook::with('siswa') // Load relasi siswa biar muncul namanya
                            ->whereIn('user_id', $siswaIds)
                            ->orderBy('tanggal', 'desc')
                            ->orderBy('status', 'asc') // Tampilkan yang 'pending' duluan
                            ->paginate(10);

        return view('industri.logbook.index', compact('logbooks'));
    }

    /**
     * Proses Validasi (Setujui / Tolak).
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'status' => 'required|in:disetujui,ditolak',
            'catatan' => 'nullable|string',
        ]);

        // Ambil logbook, tapi pastikan logbook itu milik siswa bimbingannya
        // (Security check agar mentor A tidak meng-ACC siswa mentor B)
        $mentorId = Auth::id();
        $siswaIds = Placement::where('mentor_id', $mentorId)->pluck('siswa_id');

        $logbook = Logbook::whereIn('user_id', $siswaIds)->findOrFail($id);

        // Update Status
        $logbook->update([
            'status' => $request->status,
            'catatan_pembimbing' => $request->catatan,
            'validated_by' => $mentorId,
            'validated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Logbook berhasil divalidasi: ' . ucfirst($request->status));
    }
}
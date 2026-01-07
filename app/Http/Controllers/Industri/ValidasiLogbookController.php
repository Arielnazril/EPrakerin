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

        $siswaIds = Placement::where('mentor_id', $mentorId)
                             ->where('status', 'aktif')
                             ->pluck('siswa_id');

        $logbooks = Logbook::with('siswa')
                            ->whereIn('user_id', $siswaIds)
                            ->orderBy('tanggal', 'desc')
                            ->orderBy('status', 'asc')
                            ->get();


        return view('industri.validasi.index', compact('logbooks'));
    }

    /**
     * Menampilkan Detail Logbook (INI YANG KURANG TADINYA)
     */
    public function show($id)
    {
        $mentorId = Auth::id();

        $siswaIds = Placement::where('mentor_id', $mentorId)->pluck('siswa_id');

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

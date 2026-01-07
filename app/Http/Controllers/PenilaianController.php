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
     */
    public function index()
    {
        $user = Auth::user();
        $placements = [];
        $placementsHistory = [];

        if ($user->role == 'industri') {
            $placements = Placement::where('mentor_id', $user->id)
                ->where('status', 'aktif')
                ->with(['siswa', 'instansi'])
                ->get();
            $placementsHistory = Placement::where('mentor_id', $user->id)
                ->where('status', 'selesai')
                ->with(['siswa', 'instansi'])
                ->latest()
                ->get();

            return view('industri.penilaian.index', compact('placements', 'placementsHistory'));
        }

        // 2. GURU SEKOLAH
        elseif ($user->role == 'guru') {

            $placements = Placement::where('guru_id', $user->id)
                ->where('status', 'aktif')
                ->with(['siswa', 'instansi', 'nilaiMentor', 'nilaiGuru'])
                ->get();

            $placementsHistory = Placement::where('guru_id', $user->id)
                ->where('status', 'selesai')
                ->with(['siswa', 'instansi', 'nilaiMentor', 'nilaiGuru'])
                ->latest()
                ->get();

            return view('guru.penilaian.index', compact('placements', 'placementsHistory'));
        }

        abort(403);
    }

    /**
     * Form Input Nilai BARU
     */
    public function create($placement_id)
    {
        $user = Auth::user();
        $placement = Placement::with('siswa')->findOrFail($placement_id);

        $existingNilai = Penilaian::where('placement_id', $placement_id)
            ->where('penilai_id', $user->id)
            ->first();

        if ($existingNilai) {
            $redirectRoute = ($user->role == 'guru') ? 'guru.penilaian.edit' : 'industri.penilaian.edit';
            return redirect()->route($redirectRoute, $existingNilai->id)
                ->with('info', 'Anda sudah memberikan nilai. Silakan edit jika ingin mengubah.');
        }

        if ($user->role == 'guru') {
            return view('guru.penilaian.create', compact('placement'));
        } else {
            return view('industri.penilaian.create', compact('placement'));
        }
    }

    /**
     * Simpan Nilai BARU
     */
    public function store(Request $request, $placement_id)
    {
        $request->validate([
            'aspek_teknis' => 'required|numeric|min:0|max:100',
            'aspek_non_teknis' => 'required|numeric|min:0|max:100',
            'catatan' => 'nullable|string',
        ]);

        Penilaian::create([
            'placement_id' => $placement_id,
            'penilai_id' => Auth::id(),
            'aspek_teknis' => $request->aspek_teknis,
            'aspek_non_teknis' => $request->aspek_non_teknis,
            'nilai_akhir' => ($request->aspek_teknis + $request->aspek_non_teknis) / 2,
            'catatan' => $request->catatan,
        ]);

        $redirectRoute = (Auth::user()->role == 'guru') ? 'guru.penilaian.index' : 'industri.penilaian.index';

        return redirect()->route($redirectRoute)
            ->with('success', 'Nilai berhasil disimpan.');
    }

    /**
     * Form EDIT Nilai
     */
    public function edit($id)
    {
        $user = Auth::user();

        $penilaian = Penilaian::with(['placement.siswa'])->findOrFail($id);

        if ($penilaian->penilai_id != $user->id) {
            abort(403, 'Anda tidak berhak mengedit nilai ini.');
        }

        if ($user->role == 'guru') {
            return view('guru.penilaian.edit', compact('penilaian'));
        } else {
            return view('industri.penilaian.edit', compact('penilaian'));
        }
    }

    /**
     * Proses UPDATE Nilai
     */
    public function update(Request $request, $id)
    {
        $penilaian = Penilaian::findOrFail($id);

        $placement = Placement::find($penilaian->placement_id);

        if ($placement->is_completed) {
            return back()->with('error', 'Nilai sudah dikunci Admin (Final). Tidak dapat diedit lagi.');
        }

        if ($penilaian->penilai_id != Auth::id()) {
            abort(403);
        }

        $request->validate([
            'aspek_teknis' => 'required|numeric|min:0|max:100',
            'aspek_non_teknis' => 'required|numeric|min:0|max:100',
            'catatan' => 'nullable|string',
        ]);

        $penilaian->update([
            'aspek_teknis' => $request->aspek_teknis,
            'aspek_non_teknis' => $request->aspek_non_teknis,
            'nilai_akhir' => ($request->aspek_teknis + $request->aspek_non_teknis) / 2,
            'catatan' => $request->catatan,
        ]);

        $redirectRoute = (Auth::user()->role == 'guru') ? 'guru.penilaian.index' : 'industri.penilaian.index';

        return redirect()->route($redirectRoute)
            ->with('success', 'Nilai berhasil diperbarui!');
    }
}

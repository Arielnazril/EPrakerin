<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Placement;
use App\Models\User;
use App\Models\Instansi;
use Illuminate\Http\Request;
use App\Models\Penilaian;

class PlacementController extends Controller
{

    public function index()
    {
        $placements = Placement::with(['siswa', 'guru', 'instansi', 'mentor'])->latest()->get();
        return view('admin.placement.index', compact('placements'));
    }

    public function create()
    {

        $siswaTerdaftar = Placement::pluck('siswa_id')->toArray();
        $siswas = User::where('role', 'siswa')->whereNotIn('id', $siswaTerdaftar)->get();

        $gurus = User::where('role', 'guru')->get();
        $instansis = Instansi::all();

        $mentors = User::where('role', 'industri')->get();

        return view('admin.placement.create', compact('siswas', 'gurus', 'instansis', 'mentors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:users,id',
            'guru_id' => 'required|exists:users,id',
            'instansi_id' => 'required|exists:instansis,id',
            'mentor_id' => 'nullable|exists:users,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
        ]);

        if ($request->mentor_id) {
            $cekMentor = User::find($request->mentor_id);
            if ($cekMentor->instansi_id != $request->instansi_id) {
                return back()->with('error', 'Mentor tidak sesuai instansi!');
            }
        }

        Placement::create([
            'siswa_id' => $request->siswa_id,
            'guru_id' => $request->guru_id,
            'instansi_id' => $request->instansi_id,
            'mentor_id' => $request->mentor_id,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status' => 'aktif'
        ]);

        User::where('id', $request->siswa_id)->update(['instansi_id' => $request->instansi_id]);

        return redirect()->route('admin.placement.index')->with('success', 'Berhasil menentukan tempat magang & mentor siswa!');
    }

    public function edit($id)
    {
        $placement = Placement::findOrFail($id);
        $gurus = User::where('role', 'guru')->get();

        $mentors = User::where('role', 'industri')
            ->where('instansi_id', $placement->instansi_id)
            ->get();

        return view('admin.placement.edit', compact('placement', 'gurus', 'mentors'));
    }

    public function update(Request $request, $id)
    {
        $placement = Placement::findOrFail($id);

        $request->validate([
            'guru_id' => 'required|exists:users,id',
            'mentor_id' => 'required|exists:users,id',
        ]);

        $placement->update([
            'guru_id' => $request->guru_id,
            'mentor_id' => $request->mentor_id,
        ]);

        return redirect()->route('admin.placement.index')->with('success', 'Data Pembimbing berhasil diperbarui!');
    }

    public function destroy($id)
    {

        $placement = Placement::findOrFail($id);

        User::where('id', $placement->siswa_id)->update(['instansi_id' => null]);

        $placement->delete();

        return back()->with('success', 'Data penempatan dibatalkan/dihapus');
    }

    /**
     * Halaman Rekapitulasi Nilai (Admin View)
     */
    public function rekap()
    {

        $placements = Placement::with(['siswa', 'instansi', 'guru'])
            ->latest()
            ->get();

        return view('admin.placement.rekap', compact('placements'));
    }

    /**
     * [BARU] Aksi Finalisasi / Kunci Nilai
     */
    public function finalize($id)
    {
        $placement = Placement::findOrFail($id);

        $nilaiMentor = \App\Models\Penilaian::where('placement_id', $id)
            ->whereHas('penilai', fn($q) => $q->where('role', 'industri'))
            ->first();

        $nilaiGuru = \App\Models\Penilaian::where('placement_id', $id)
            ->whereHas('penilai', fn($q) => $q->where('role', 'guru'))
            ->first();

        if (!$nilaiMentor || !$nilaiGuru) {
            return back()->with('error', 'Gagal Finalisasi! Pastikan Mentor DAN Guru sudah memberi nilai.');
        }

        $nilaiAkhir = ($nilaiMentor->nilai_akhir + $nilaiGuru->nilai_akhir) / 2;

        $placement->update([
            'nilai_akhir_total' => $nilaiAkhir,
            'is_completed' => true,
            'status' => 'selesai'
        ]);

        return back()->with('success', 'Nilai berhasil dikunci. Siswa dinyatakan lulus magang.');
    }
}

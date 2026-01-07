<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Placement;
use App\Models\User;
use App\Models\Instansi;
use Illuminate\Http\Request;

class PlacementController extends Controller
{
    // Lihat siapa magang di mana
    public function index()
    {
        $placements = Placement::with(['siswa', 'guru', 'instansi', 'mentor'])->latest()->get();
        return view('admin.placement.index', compact('placements'));
    }

    // Form penentuan pembimbing
    public function create()
    {
        // 1. Ambil Siswa yang BELUM punya tempat magang (supaya gak ganda)
        // Kita cek id siswa mana saja yang sudah ada di tabel placements
        $siswaTerdaftar = Placement::pluck('siswa_id')->toArray();
        $siswas = User::where('role', 'siswa')->whereNotIn('id', $siswaTerdaftar)->get();

        // 2. Ambil data pendukung
        $gurus = User::where('role', 'guru')->get();
        $instansis = Instansi::all();

        // Ambil mentor (nanti idealnya difilter pakai Javascript pas pilih Instansi)
        $mentors = User::where('role', 'industri')->get();

        return view('admin.placement.create', compact('siswas', 'gurus', 'instansis', 'mentors'));
    }

    // Simpan hasil penentuan
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

        // Opsional: Validasi apakah Mentor benar kerja di Instansi itu?
        if ($request->mentor_id) {
            $cekMentor = User::find($request->mentor_id);
            if($cekMentor->instansi_id != $request->instansi_id) {
                return back()->with('error', 'Mentor tidak sesuai instansi!');
            }
        }

        // Simpan Penempatan
        Placement::create([
            'siswa_id' => $request->siswa_id,
            'guru_id' => $request->guru_id,
            'instansi_id' => $request->instansi_id,
            'mentor_id' => $request->mentor_id,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status' => 'aktif'
        ]);

        // Opsional: Update kolom instansi_id di tabel users (siswa) agar sinkron
        User::where('id', $request->siswa_id)->update(['instansi_id' => $request->instansi_id]);

        return redirect()->route('admin.placement.index')->with('success', 'Berhasil menentukan tempat magang & mentor siswa!');
    }

    // Form Edit untuk menambahkan Mentor belakangan
    public function edit($id)
    {
        $placement = Placement::findOrFail($id);
        $gurus = User::where('role', 'guru')->get();

        // Ambil mentor HANYA dari instansi tempat siswa magang
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
            'mentor_id' => 'required|exists:users,id', // Saat update, mentor WAJIB diisi
        ]);

        $placement->update([
            'guru_id' => $request->guru_id,
            'mentor_id' => $request->mentor_id,
        ]);

        return redirect()->route('admin.placement.index')->with('success', 'Data Pembimbing berhasil diperbarui!');
    }

    public function destroy($id)
    {
        // Jika data placement dihapus, siswa jadi "belum magang" lagi
        $placement = Placement::findOrFail($id);

        // Kosongkan instansi di user siswa juga
        User::where('id', $placement->siswa_id)->update(['instansi_id' => null]);

        $placement->delete();

        return back()->with('success', 'Data penempatan dibatalkan/dihapus');
    }
}

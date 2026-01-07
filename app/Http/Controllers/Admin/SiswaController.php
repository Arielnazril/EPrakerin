<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    // 1. HALAMAN UTAMA (INDEX)
    public function index()
    {
        // Ambil Siswa Pending (Untuk Tabel Verifikasi)
        $siswaPending = User::where('role', 'siswa')
                            ->where('status_akun', 'pending')
                            ->with('jurusan')
                            ->latest()
                            ->get();

        // Ambil Siswa Aktif (Untuk Tabel Data Utama)
        $siswaAktif = User::where('role', 'siswa')
                          ->where('status_akun', 'aktif')
                          ->with('jurusan')
                          ->latest()
                          ->get();

        // Kita kirim dua variabel ini ke View
        return view('admin.master.siswa.index', compact('siswaPending', 'siswaAktif'));
    }

    // 2. PROSES VERIFIKASI (TERIMA SISWA)
    public function verify($id)
    {
        $siswa = User::findOrFail($id);

        // Ubah status jadi aktif
        $siswa->update(['status_akun' => 'aktif']);

        return back()->with('success', 'Akun siswa ' . $siswa->name . ' berhasil diaktifkan.');
    }

    // 3. HALAMAN EDIT
    public function edit($id)
    {
        $siswa = User::findOrFail($id);
        $jurusans = Jurusan::all();
        return view('admin.master.siswa.edit', compact('siswa', 'jurusans'));
    }

    // 4. PROSES UPDATE DATA
    public function update(Request $request, $id)
    {
        $siswa = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'jurusan_id' => 'required',
            'nomor_identitas' => 'required',
        ]);

        $data = [
            'name' => $request->name,
            'nomor_identitas' => $request->nomor_identitas,
            'jurusan_id' => $request->jurusan_id,
            'no_hp' => $request->no_hp,
        ];

        // Update password hanya jika diisi
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $siswa->update($data);

        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    // 5. HAPUS SISWA (Tolak / Hapus Permanen)
    public function destroy($id)
    {
        $siswa = User::findOrFail($id);
        $siswa->delete();

        return back()->with('success', 'Data siswa berhasil dihapus.');
    }
}

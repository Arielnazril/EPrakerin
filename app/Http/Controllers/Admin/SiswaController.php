<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{

    public function index()
    {

        $siswaPending = User::where('role', 'siswa')
                            ->where('status_akun', 'pending')
                            ->with('jurusan')
                            ->latest()
                            ->get();

        $siswaAktif = User::where('role', 'siswa')
                          ->where('status_akun', 'aktif')
                          ->with('jurusan')
                          ->latest()
                          ->get();

        return view('admin.master.siswa.index', compact('siswaPending', 'siswaAktif'));
    }

    public function verify($id)
    {
        $siswa = User::findOrFail($id);

        $siswa->update(['status_akun' => 'aktif']);

        return back()->with('success', 'Akun siswa ' . $siswa->name . ' berhasil diaktifkan.');
    }

    public function edit($id)
    {
        $siswa = User::findOrFail($id);
        $jurusans = Jurusan::all();
        return view('admin.master.siswa.edit', compact('siswa', 'jurusans'));
    }

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

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $siswa->update($data);

        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $siswa = User::findOrFail($id);
        $siswa->delete();

        return back()->with('success', 'Data siswa berhasil dihapus.');
    }
}

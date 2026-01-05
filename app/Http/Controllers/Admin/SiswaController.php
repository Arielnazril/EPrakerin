<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class SiswaController extends Controller
{
    // Lihat daftar siswa yang sudah register
    public function index()
    {
        $siswas = User::where('role', 'siswa')->with('jurusan')->latest()->get();
        return view('admin.master.siswa.index', compact('siswas'));
    }

    // Admin bisa edit kalau siswa salah input nama/jurusan saat register
    public function edit($id)
    {
        $siswa = User::where('role', 'siswa')->findOrFail($id);
        $jurusans = Jurusan::all();
        return view('admin.master.siswa.edit', compact('siswa', 'jurusans'));
    }

    public function update(Request $request, $id)
    {
        $siswa = User::findOrFail($id);
        
        $request->validate([
            'name' => 'required',
            'jurusan_id' => 'required',
            'nomor_identitas' => 'required', // NIS
        ]);

        $data = [
            'name' => $request->name,
            'nomor_identitas' => $request->nomor_identitas,
            'jurusan_id' => $request->jurusan_id,
            'no_hp' => $request->no_hp,
        ];

        // Jika admin mau reset password siswa
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $siswa->update($data);
        return redirect()->route('admin.siswa.index')->with('success', 'Data Siswa diperbarui');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return back()->with('success', 'Siswa dihapus');
    }
}
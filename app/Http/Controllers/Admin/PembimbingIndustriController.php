<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Instansi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PembimbingIndustriController extends Controller
{
    // Menampilkan daftar mentor yang sudah dibuat Admin
    public function index()
    {
        $mentors = User::where('role', 'industri')->with('instansi')->latest()->get();
        return view('admin.master.pembimbing.index', compact('mentors'));
    }

    // Form buat akun mentor baru
    public function create()
    {
        // Admin harus pilih mentor ini kerja di PT mana
        $instansis = Instansi::all(); 
        return view('admin.master.pembimbing.create', compact('instansis'));
    }

    // Proses simpan akun mentor
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:users,username',
            'password' => 'required|string|min:6',
            'instansi_id' => 'required|exists:instansis,id', // Wajib link ke perusahaan
            'no_hp' => 'nullable|string',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->username . '@industri.com', // Email dummy
            'password' => Hash::make($request->password),
            'role' => 'industri',
            'instansi_id' => $request->instansi_id, // Kunci: Mentor ini milik PT X
            'no_hp' => $request->no_hp,
        ]);

        return redirect()->route('admin.pembimbing.index')->with('success', 'Akun Mentor berhasil dibuat!');
    }

    public function edit($id)
    {
        $mentor = User::where('role', 'industri')->findOrFail($id);
        $instansis = Instansi::all();
        return view('admin.master.pembimbing.edit', compact('mentor', 'instansis'));
    }

    public function update(Request $request, $id)
    {
        $mentor = User::findOrFail($id);
        
        $request->validate([
            'name' => 'required',
            'username' => ['required', Rule::unique('users', 'username')->ignore($id)],
            'instansi_id' => 'required',
        ]);

        $data = [
            'name' => $request->name,
            'username' => $request->username,
            'instansi_id' => $request->instansi_id,
            'no_hp' => $request->no_hp,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $mentor->update($data);

        return redirect()->route('admin.pembimbing.index')->with('success', 'Data Mentor diperbarui');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return back()->with('success', 'Akun Mentor dihapus');
    }
}
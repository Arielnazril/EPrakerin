<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class GuruController extends Controller
{
    public function index()
    {
        $gurus = User::where('role', 'guru')->latest()->get();
        return view('admin.master.guru.index', compact('gurus'));
    }

    public function create()
    {
        return view('admin.master.guru.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nip' => 'required|string|unique:users,username',
            'password' => 'required|string|min:6',
            'no_hp' => 'nullable|string',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->nip,
            'email' => $request->nip . '@guru.smk',
            'password' => Hash::make($request->password),
            'role' => 'guru',
            'nomor_identitas' => $request->nip,
            'no_hp' => $request->no_hp,
        ]);

        return redirect()->route('admin.guru.index')->with('success', 'Guru berhasil ditambahkan');
    }

    public function edit($id)
    {
        $guru = User::where('role', 'guru')->findOrFail($id);
        return view('admin.master.guru.edit', compact('guru'));
    }

    public function update(Request $request, $id)
    {
        $guru = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'nip' => ['required', Rule::unique('users', 'username')->ignore($id)],
        ]);

        $data = [
            'name' => $request->name,
            'username' => $request->nip,
            'nomor_identitas' => $request->nip,
            'no_hp' => $request->no_hp,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $guru->update($data);
        return redirect()->route('admin.guru.index')->with('success', 'Data Guru diperbarui');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return back()->with('success', 'Guru dihapus');
    }
}

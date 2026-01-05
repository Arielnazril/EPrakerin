<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Instansi;
use Illuminate\Http\Request;

class InstansiController extends Controller
{
    public function index()
    {
        $instansis = Instansi::latest()->get();
        return view('admin.master.instansi.index', compact('instansis'));
    }

    public function create()
    {
        return view('admin.master.instansi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'alamat' => 'required|string',
            'email_perusahaan' => 'nullable|email',
            'telepon' => 'nullable|string',
            'website' => 'nullable|url',
        ]);

        Instansi::create($request->all());
        return redirect()->route('admin.instansi.index')->with('success', 'Data Perusahaan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $instansi = Instansi::findOrFail($id);
        return view('admin.master.instansi.edit', compact('instansi'));
    }

    public function update(Request $request, $id)
    {
        $instansi = Instansi::findOrFail($id);
        $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'alamat' => 'required|string',
        ]);

        $instansi->update($request->all());
        return redirect()->route('admin.instansi.index')->with('success', 'Data Perusahaan diperbarui');
    }

    public function destroy($id)
    {
        Instansi::findOrFail($id)->delete();
        return back()->with('success', 'Data Perusahaan dihapus');
    }
}
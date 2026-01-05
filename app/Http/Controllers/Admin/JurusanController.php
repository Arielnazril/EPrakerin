<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function index()
    {
        $jurusans = Jurusan::all();
        return view('admin.master.jurusan.index', compact('jurusans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jurusan' => 'required|string|max:255',
            'kode_jurusan' => 'required|string|max:10|unique:jurusans',
        ]);

        Jurusan::create($request->all());
        return back()->with('success', 'Jurusan berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $jurusan = Jurusan::findOrFail($id);
        $request->validate([
            'nama_jurusan' => 'required|string|max:255',
            'kode_jurusan' => 'required|string|max:10|unique:jurusans,kode_jurusan,'.$id,
        ]);

        $jurusan->update($request->all());
        return back()->with('success', 'Jurusan berhasil diperbarui');
    }

    public function destroy($id)
    {
        Jurusan::findOrFail($id)->delete();
        return back()->with('success', 'Jurusan berhasil dihapus');
    }
}
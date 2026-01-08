<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Logbook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LogbooksController extends Controller
{
    /**
     * Menampilkan riwayat logbook siswa login.
     */
    public function index()
    {

        $logbooks = Logbook::where('user_id', Auth::id())
                            ->orderBy('tanggal', 'desc')
                            ->orderBy('jam_masuk', 'desc')
                            ->get();

        return view('siswa.logbook.history', compact('logbooks'));
    }

    /**
     * Menampilkan form input logbook baru.
     */
    public function create()
    {
        return view('siswa.logbook.input');
    }

    /**
     * Menyimpan data logbook ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jam_masuk' => 'required',
            'jam_keluar' => 'required|after:jam_masuk',
            'kegiatan' => 'required|string|min:10',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);

        $data = [
            'user_id' => Auth::id(),
            'tanggal' => $request->tanggal,
            'jam_masuk' => $request->jam_masuk,
            'jam_keluar' => $request->jam_keluar,
            'kegiatan' => $request->kegiatan,
            'status' => 'pending',
        ];

        if ($request->hasFile('foto')) {

            $path = $request->file('foto')->store('logbooks', 'public');
            $data['foto'] = $path;
        }

        Logbook::create($data);

        return redirect()->route('siswa.logbook.history')
                         ->with('success', 'Logbook berhasil disimpan! Menunggu verifikasi mentor.');
    }

    /**
     * Menampilkan form edit (Hanya jika status masih Pending).
     */
    public function edit($id)
    {
        $logbook = Logbook::where('user_id', Auth::id())->findOrFail($id);

        if ($logbook->status !== 'pending') {
            return redirect()->route('siswa.logbook.history')
                             ->with('error', 'Logbook yang sudah dinilai tidak bisa diedit.');
        }

        return view('siswa.logbook.edit', compact('logbook'));
    }

    /**
     * Update data logbook.
     */
    public function update(Request $request, $id)
    {
        $logbook = Logbook::where('user_id', Auth::id())->findOrFail($id);

        if ($logbook->status !== 'pending') {
            abort(403, 'Tidak diizinkan mengedit logbook yang sudah divalidasi.');
        }

        $request->validate([
            'tanggal' => 'required|date',
            'jam_masuk' => 'required',
            'jam_keluar' => 'required|after:jam_masuk',
            'kegiatan' => 'required|string',
            'foto' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['tanggal', 'jam_masuk', 'jam_keluar', 'kegiatan']);

        if ($request->hasFile('foto')) {
            if ($logbook->foto && Storage::disk('public')->exists($logbook->foto)) {
                Storage::disk('public')->delete($logbook->foto);
            }
            $data['foto'] = $request->file('foto')->store('logbooks', 'public');
        }

        $logbook->update($data);

        return redirect()->route('siswa.logbook.history')
                         ->with('success', 'Logbook berhasil diperbarui.');
    }

    /**
     * Hapus logbook.
     */
    public function destroy($id)
    {
        $logbook = Logbook::where('user_id', Auth::id())->findOrFail($id);

        if ($logbook->foto && Storage::disk('public')->exists($logbook->foto)) {
            Storage::disk('public')->delete($logbook->foto);
        }

        $logbook->delete();

        return redirect()->route('siswa.logbook.history')
                         ->with('success', 'Logbook berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Placement;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenilaianController extends Controller
{
    /**
     * Menampilkan Form Penilaian.
     * Bisa diakses oleh Guru atau Mentor Industri.
     */
    public function create($placement_id)
    {
        $placement = Placement::with(['siswa', 'instansi'])->findOrFail($placement_id);
        $user = Auth::user();

        // Cek Hak Akses: Hanya Guru atau Mentor yang terkait dengan placement ini yang boleh menilai
        if ($user->role == 'guru' && $placement->guru_id != $user->id) {
            abort(403, 'Anda bukan pembimbing siswa ini.');
        }
        if ($user->role == 'industri' && $placement->mentor_id != $user->id) {
            abort(403, 'Anda bukan mentor siswa ini.');
        }

        // Cek apakah sudah ada penilaian sebelumnya?
        $penilaian = Penilaian::where('placement_id', $placement_id)->first();

        return view('penilaian.form', compact('placement', 'penilaian'));
    }

    /**
     * Menyimpan Nilai.
     */
    public function store(Request $request, $placement_id)
    {
        $placement = Placement::findOrFail($placement_id);
        $user = Auth::user();

        // Validasi Role
        if (!in_array($user->role, ['guru', 'industri'])) {
            abort(403);
        }

        // Cari atau Buat row penilaian baru
        $penilaian = Penilaian::firstOrNew(['placement_id' => $placement_id]);

        if ($user->role == 'industri') {
            // Mentor Industri mengisi detail_nilai_industri
            // Input dari form diharapkan array, misal: name="nilai[kedisiplinan]", name="nilai[skill]"
            $dataNilai = $request->input('nilai'); // Array
            $penilaian->detail_nilai_industri = json_encode($dataNilai); // Simpan sebagai JSON
        } 
        elseif ($user->role == 'guru') {
            // Guru mengisi detail_nilai_guru
            $dataNilai = $request->input('nilai');
            $penilaian->detail_nilai_guru = json_encode($dataNilai);
        }

        // Hitung Rata-rata Sementara (Opsional, bisa dibuat otomatis saat save)
        $penilaian->rata_rata_akhir = $this->hitungRataRata($penilaian);
        
        $penilaian->save();

        return redirect()->back()->with('success', 'Nilai berhasil disimpan!');
    }

    /**
     * Helper menghitung rata-rata dari JSON.
     */
    private function hitungRataRata($penilaian)
    {
        $total = 0;
        $count = 0;

        // Decode JSON ke Array
        $nilaiIndustri = json_decode($penilaian->detail_nilai_industri, true) ?? [];
        $nilaiGuru = json_decode($penilaian->detail_nilai_guru, true) ?? [];

        // Gabungkan semua nilai
        $semuaNilai = array_merge(array_values($nilaiIndustri), array_values($nilaiGuru));

        if (empty($semuaNilai)) return 0;

        // Hitung
        foreach ($semuaNilai as $n) {
            $total += (float)$n;
            $count++;
        }

        return $count > 0 ? $total / $count : 0;
    }
}
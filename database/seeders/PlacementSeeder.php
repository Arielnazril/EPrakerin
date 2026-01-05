<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Placement;
use Carbon\Carbon;

class PlacementSeeder extends Seeder
{
    public function run(): void
    {
        // Plotting Siswa Ahmad (ID 5) ke Telkom (ID 1), Mentor Sarah (ID 3), Guru Budi (ID 2)
        Placement::create([
            'siswa_id' => 5, // Ahmad
            'guru_id' => 2,  // Pak Budi
            'mentor_id' => 3, // Kak Sarah
            'instansi_id' => 1, // PT Telkom
            'tanggal_mulai' => Carbon::now()->subMonth(), // Mulai sebulan lalu
            'tanggal_selesai' => Carbon::now()->addMonths(2), // Selesai 2 bulan lagi
            'status' => 'aktif'
        ]);

        // Plotting Siswa Budi (ID 6) ke Tech (ID 2), Mentor Doni (ID 4), Guru Budi (ID 2)
        Placement::create([
            'siswa_id' => 6, // Budi
            'guru_id' => 2,  // Pak Budi
            'mentor_id' => 4, // Mas Doni
            'instansi_id' => 2, // CV Tech
            'tanggal_mulai' => Carbon::now()->subDays(5),
            'tanggal_selesai' => Carbon::now()->addMonths(3),
            'status' => 'aktif'
        ]);
    }
}
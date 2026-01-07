<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Placement;
use App\Models\User;
use App\Models\Instansi;
use Carbon\Carbon;

class PlacementSeeder extends Seeder
{
    public function run(): void
    {
        $siswaAhmad = User::where('email', 'ahmad@siswa.sch.id')->first();

        $guruBudi = User::where('email', 'budi@sekolah.sch.id')->first();

        $mentorTelkom = User::where('username', 'mentor_telkom')->first();
        $instansiTelkom = Instansi::where('nama_perusahaan', 'PT. Telkom Indonesia')->first();

        if ($siswaAhmad && $guruBudi && $mentorTelkom && $instansiTelkom) {
            Placement::create([
                'siswa_id' => $siswaAhmad->id,
                'guru_id' => $guruBudi->id,
                'mentor_id' => $mentorTelkom->id,
                'instansi_id' => $instansiTelkom->id,
                'tanggal_mulai' => Carbon::now()->subMonth(),
                'tanggal_selesai' => Carbon::now()->addMonths(2),
                'status' => 'aktif'
            ]);
        }
    }
}

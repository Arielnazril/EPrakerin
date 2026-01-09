<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Instansi;
use App\Models\Placement;
use App\Models\Logbook;
use App\Models\Penilaian;
use Carbon\Carbon;
use Illuminate\Validation\Rules\In;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            JurusanSeeder::class,
            InstansiSeeder::class,
        ]);

        $this->call([
            UserSeeder::class,
        ]);

        $this->call([
            PlacementSeeder::class,
        ]);

        echo "Data Dummy Mentor...\n";
        $instansis = Instansi::factory(4)->create()->each(function ($instansi) {
            User::factory()->industri()->create([
                'instansi_id' => $instansi->id,
                'name' => 'Mentor ' . $instansi->nama_perusahaan
            ]);
        });

        echo "Data Dummy Guru\n";
        $gurus = User::factory(3)->guru()->create();

        // Gabungkan Guru Lama + Guru Baru untuk dipilih acak nanti
        $allGurus = User::where('role', 'guru')->get();


        echo "Data Dummy Siswa\n";

        User::factory(10)->siswa()->create([
            'status_akun' => 'aktif'
        ])->each(function ($siswa) use ($instansis, $allGurus) {

            $instansi = $instansis->random();
            $mentor = User::where('role', 'industri')->where('instansi_id', $instansi->id)->first();
            $guru = $allGurus->random();

            $placement = Placement::create([
                'siswa_id' => $siswa->id,
                'guru_id' => $guru->id,
                'mentor_id' => $mentor->id,
                'instansi_id' => $instansi->id,
                'tanggal_mulai' => Carbon::now()->subMonths(1), // Mulai sebulan lalu
                'tanggal_selesai' => Carbon::now()->addMonths(2),
                'status' => 'aktif'
            ]);

            $siswa->update(['instansi_id' => $instansi->id]);

            Logbook::create([
                'user_id' => $siswa->id,
                'tanggal' => Carbon::now()->subDays(1),
                'kegiatan' => 'Membuat desain UI untuk aplikasi mobile.',
                'foto' => 'dummy.jpg',
                'status' => 'disetujui'
            ]);
        });

        User::factory(10)->siswa()->create([
            'status_akun' => 'aktif'
        ])->each(function ($siswa) use ($instansis, $allGurus) {

            $instansi = $instansis->random();
            $mentor = User::where('role', 'industri')->where('instansi_id', $instansi->id)->first();
            $guru = $allGurus->random();

            $placement = Placement::create([
                'siswa_id' => $siswa->id,
                'guru_id' => $guru->id,
                'mentor_id' => $mentor->id,
                'instansi_id' => $instansi->id,
                'tanggal_mulai' => Carbon::now()->subMonths(4),
                'tanggal_selesai' => Carbon::now()->subMonths(1),
                'status' => 'selesai',
                'is_completed' => true,
                'nilai_akhir_total' => rand(80, 95)
            ]);

            $siswa->update(['instansi_id' => $instansi->id]);

            Penilaian::create([
                'placement_id' => $placement->id,
                'penilai_id' => $mentor->id,
                'aspek_teknis' => 85,
                'aspek_non_teknis' => 90,
                'nilai_akhir' => 87.5,
                'catatan' => 'Sangat rajin dan kompeten.'
            ]);

            Penilaian::create([
                'placement_id' => $placement->id,
                'penilai_id' => $guru->id,
                'aspek_teknis' => 80,
                'aspek_non_teknis' => 85,
                'nilai_akhir' => 82.5,
                'catatan' => 'Laporan lengkap.'
            ]);
        });

        User::factory(10)->siswa()->create([
            'status_akun' => 'pending',
            'instansi_id' => null
        ]);

        echo "SELESAI! Database penuh dengan data dummy.\n";
    }
}

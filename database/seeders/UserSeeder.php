<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $password = Hash::make('password');
        
        User::create([
            'name' => 'Administrator Sekolah',
            'username' => 'admin',
            'email' => 'admin@sekolah.sch.id',
            'password' => $password,
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Peno Fahmi (Admin)',
            'username' => 'elhal8n',
            'email' => 'penofahmi@gmail.com',
            'password' => $password,
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Budi Santoso S.Pd',
            'username' => 'guru1',
            'email' => 'budi@sekolah.sch.id',
            'password' => $password,
            'role' => 'guru',
            'nomor_identitas' => '198501012010011001',
            'no_hp' => '081234567890',
        ]);

        User::create([
            'name' => 'Peno S.Kom',
            'username' => 'guru2',
            'email' => 'peno.guru@sekolah.sch.id',
            'password' => $password,
            'role' => 'guru',
            'nomor_identitas' => '221220095',
            'no_hp' => '081234567891',
        ]);

        User::create([
            'name' => 'Pak Mentor Telkom',
            'username' => 'mentor_telkom',
            'email' => 'mentor@telkom.co.id',
            'password' => $password,
            'role' => 'industri',
            'nomor_identitas' => 'NIK-TELKOM-001',
            'instansi_id' => 1,
            'no_hp' => '08987654321',
        ]);

        User::create([
            'name' => 'Ibu Mentor Tech',
            'username' => 'mentor_tech',
            'email' => 'mentor@techsolusi.com',
            'password' => $password,
            'role' => 'industri',
            'nomor_identitas' => 'NIK-TECH-002',
            'instansi_id' => 2,
            'no_hp' => '08987654322',
        ]);

        // 4. SISWA
        User::create([
            'name' => 'Ahmad Siswa RPL',
            'username' => '102030',
            'email' => 'ahmad@siswa.sch.id',
            'password' => $password,
            'role' => 'siswa',
            'jurusan_id' => 1,
            'nomor_identitas' => '102030',
            'status_akun' => 'aktif',
            'instansi_id' => 1,
            'kelas' => 'XII RPL 1',
            'no_hp' => '08520000001'
        ]);

        User::create([
            'name' => 'Budi Siswa TKJ',
            'username' => '102031',
            'email' => 'budi@siswa.sch.id',
            'password' => $password,
            'role' => 'siswa',
            'jurusan_id' => 2,
            'nomor_identitas' => '102031',
            'status_akun' => 'pending',
            'kelas' => 'XII TKJ 2',
            'no_hp' => '08520000002'
        ]);
    }
}

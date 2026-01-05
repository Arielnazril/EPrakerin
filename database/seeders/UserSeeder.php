<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. ADMIN
        User::create([
            'name' => 'Administrator Sekolah',
            'username' => 'admin',
            'email' => 'admin@sekolah.sch.id',
            'password' => Hash::make('password'), // Password default
            'role' => 'admin',
        ]);

        // 2. GURU PEMBIMBING
        User::create([
            'name' => 'Pak Budi Santoso',
            'username' => '198501012010011001', // NIP
            'email' => 'budi@sekolah.sch.id',
            'password' => Hash::make('password'),
            'role' => 'guru',
            'nomor_identitas' => '198501012010011001', // NIP
            'no_hp' => '081234567890'
        ]);

        // 3. MENTOR INDUSTRI (PT. Telkom - ID 1)
        User::create([
            'name' => 'Kak Sarah (Mentor Telkom)',
            'username' => 'mentor_telkom',
            'email' => 'sarah@telkom.co.id',
            'password' => Hash::make('password'),
            'role' => 'industri',
            'instansi_id' => 1, // Link ke PT. Telkom
            'no_hp' => '08987654321'
        ]);

        // 4. MENTOR INDUSTRI (CV. Tech - ID 2)
        User::create([
            'name' => 'Mas Doni (Mentor Tech)',
            'username' => 'mentor_tech',
            'email' => 'doni@tech.com',
            'password' => Hash::make('password'),
            'role' => 'industri',
            'instansi_id' => 2, // Link ke CV Tech
            'no_hp' => '0855555555'
        ]);

        // 5. SISWA RPL (Magang di Telkom)
        User::create([
            'name' => 'Ahmad Siswa RPL',
            'username' => '102030', // NIS
            'email' => 'ahmad@siswa.sch.id',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'jurusan_id' => 1, // RPL
            'nomor_identitas' => '102030', // NIS
        ]);

        // 6. SISWA TKJ (Magang di CV Tech)
        User::create([
            'name' => 'Budi Siswa TKJ',
            'username' => '102031', // NIS
            'email' => 'budi@siswa.sch.id',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'jurusan_id' => 2, // TKJ
            'nomor_identitas' => '102031', // NIS
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Instansi;

class InstansiSeeder extends Seeder
{
    public function run(): void
    {
        Instansi::create([
            'nama_perusahaan' => 'PT. Telkom Indonesia',
            'alamat' => 'Jl. Japati No. 1, Bandung',
            'email_perusahaan' => 'hrd@telkom.co.id',
            'telepon' => '022-123456',
            'website' => 'www.telkom.co.id'
        ]);

        Instansi::create([
            'nama_perusahaan' => 'CV. Tech Solusi',
            'alamat' => 'Jl. Merdeka No. 45, Jakarta',
            'email_perusahaan' => 'contact@techsolusi.com',
            'telepon' => '021-987654',
            'website' => 'www.techsolusi.com'
        ]);
    }
}
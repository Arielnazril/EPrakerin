<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jurusan;

class JurusanSeeder extends Seeder
{
    public function run(): void
    {
        Jurusan::create([
            'nama_jurusan' => 'Rekayasa Perangkat Lunak',
            'kode_jurusan' => 'RPL'
        ]);

        Jurusan::create([
            'nama_jurusan' => 'Teknik Komputer Jaringan',
            'kode_jurusan' => 'TKJ'
        ]);
        
        Jurusan::create([
            'nama_jurusan' => 'Multimedia / DKV',
            'kode_jurusan' => 'MM'
        ]);
    }
}
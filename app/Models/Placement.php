<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Placement extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Ubah string tanggal jadi objek Carbon biar gampang diformat
    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];

    // Relasi ke Siswa
    public function siswa()
    {
        return $this->belongsTo(User::class, 'siswa_id');
    }
    public function instansi()
    {
        return $this->belongsTo(Instansi::class, 'instansi_id');
    }
    // Relasi ke Guru Pembimbing
    public function guru()
    {
        return $this->belongsTo(User::class, 'guru_id');
    }

    // Relasi ke Mentor Industri
    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }
    
    // Relasi ke Nilai Akhir
    public function penilaian()
    {
        return $this->hasOne(Penilaian::class);
    }
}
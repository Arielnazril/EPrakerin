<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relasi ke Data Penempatan
    public function placement()
    {
        return $this->belongsTo(Placement::class);
    }

    // Relasi ke Pemberi Nilai (Mentor/Guru)
    public function penilai()
    {
        return $this->belongsTo(User::class, 'penilai_id');
    }
}

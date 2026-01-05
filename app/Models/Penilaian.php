<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // PENTING: Otomatis ubah JSON di database jadi Array di PHP
    protected $casts = [
        'detail_nilai_industri' => 'array',
        'detail_nilai_guru' => 'array',
    ];

    // Relasi ke Placement (Penempatan)
    public function placement()
    {
        return $this->belongsTo(Placement::class);
    }
}
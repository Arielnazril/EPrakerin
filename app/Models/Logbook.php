<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logbook extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tanggal',
        'jam_masuk',
        'jam_keluar',
        'kegiatan',
        'foto',
        'status',
        'validated_by',
        'validated_at',
        'catatan_pembimbing'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'validated_at' => 'datetime',
    ];

    // Relasi ke Siswa (User)
    public function siswa()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke Mentor (User)
    public function validator()
    {
        return $this->belongsTo(User::class, 'validated_by');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Placement extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'is_completed' => 'boolean',
    ];

    public function siswa()
    {
        return $this->belongsTo(User::class, 'siswa_id');
    }
    public function instansi()
    {
        return $this->belongsTo(Instansi::class, 'instansi_id');
    }

    public function guru()
    {
        return $this->belongsTo(User::class, 'guru_id');
    }

    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }

    public function penilaians()
    {
        return $this->hasMany(Penilaian::class);
    }

    public function nilaiMentor()
    {
        return $this->hasOne(Penilaian::class)->ofMany([], function ($query) {
            $query->whereHas('penilai', function($q){
                $q->where('role', 'industri');
            });
        });
    }

    public function nilaiGuru()
    {
        return $this->hasOne(Penilaian::class)->ofMany([], function ($query) {
            $query->whereHas('penilai', function($q){
                $q->where('role', 'guru');
            });
        });
    }
}

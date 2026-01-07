<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;

    protected $fillable = [
        'placement_id',
        'penilai_id',
        'aspek_teknis',
        'aspek_non_teknis',
        'nilai_akhir',
        'catatan'
    ];

    public function placement()
    {
        return $this->belongsTo(Placement::class);
    }

    public function penilai()
    {
        return $this->belongsTo(User::class, 'penilai_id');
    }
}

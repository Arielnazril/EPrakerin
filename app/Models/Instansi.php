<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    use HasFactory;

    protected $guarded = ['id']; // Semua kolom bisa diisi kecuali ID

    // Relasi: Satu Instansi punya banyak Mentor (User)
    public function mentors()
    {
        return $this->hasMany(User::class, 'instansi_id');
    }
}
<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Instansi;
use App\Models\Penilaian;
use App\Models\Placement;
use App\Models\Jurusan;
use App\Models\Logbook;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role',
        'status_akun',
        'nomor_identitas',
        'no_hp',
        'instansi_id',
        'jurusan_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function penilaian_industri() {
        return $this->hasOne(Penilaian::class, 'siswa_id');
    }

    // --- RELASI KE DATA MASTER ---

    // Jika user adalah Siswa, dia punya Jurusan
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_id');
    }

    // Jika user adalah Mentor Industri, dia punya Instansi
    public function instansi()
    {
        return $this->belongsTo(Instansi::class, 'instansi_id');
    }

    // --- RELASI KE MAGANG (PLACEMENT) ---
    // Karena satu tabel User dipakai banyak role, relasinya kita pisah biar jelas

    // 1. Relasi untuk SISWA melihat tempat magangnya
    public function placement_siswa()
    {
        return $this->hasOne(Placement::class, 'siswa_id');
    }

    // 2. Relasi untuk GURU melihat siapa saja siswa bimbingannya
    public function placements_guru()
    {
        return $this->hasMany(Placement::class, 'guru_id');
    }

    // 3. Relasi untuk MENTOR melihat siapa siswa yang diajar
    public function placements_mentor()
    {
        return $this->hasMany(Placement::class, 'mentor_id');
    }

    // --- RELASI KE LOGBOOK ---
    public function logbooks()
    {
        return $this->hasMany(Logbook::class, 'user_id');
    }
}

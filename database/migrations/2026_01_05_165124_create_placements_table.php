<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('placements', function (Blueprint $table) {
            $table->id();
            
            // Siapa Siswanya?
            $table->foreignId('siswa_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('instansi_id')->constrained('instansis');
            // Siapa Guru Pembimbing Sekolahnya?
            $table->foreignId('guru_id')->constrained('users');
            
            // Siapa Mentor Lapangannya? (Akun user role 'industri')
            $table->foreignId('mentor_id')->constrained('users');
            
            // Periode Magang
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            
            // Status Magang
            $table->enum('status', ['aktif', 'selesai', 'dibatalkan'])->default('aktif');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('placements');
    }
};
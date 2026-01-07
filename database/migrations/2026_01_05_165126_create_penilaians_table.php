<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penilaians', function (Blueprint $table) {
            $table->id();

            // Relasi ke tabel placements (Siswa mana yang dinilai)
            $table->foreignId('placement_id')->constrained('placements')->onDelete('cascade');

            // Relasi ke tabel users (Siapa yang menilai: Mentor/Guru)
            // INI KOLOM YANG SEBELUMNYA HILANG
            $table->foreignId('penilai_id')->constrained('users')->onDelete('cascade');

            // Data Nilai (Sesuai Controller)
            $table->integer('aspek_teknis'); // 0-100
            $table->integer('aspek_non_teknis'); // 0-100
            $table->decimal('nilai_akhir', 5, 2); // Contoh: 85.50
            $table->text('catatan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penilaians');
    }
};

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
            
            // Terhubung ke tabel placement agar jelas ini nilai untuk periode magang yang mana
            $table->foreignId('placement_id')->constrained('placements')->onDelete('cascade');
            
            // Aspek Nilai Industri (Disimpan dalam JSON agar fleksibel jika kriteria berubah)
            // Contoh isi: {"kedisiplinan": 90, "tanggung_jawab": 85, "skill": 80}
            $table->json('detail_nilai_industri')->nullable();
            
            // Aspek Nilai Guru
            // Contoh isi: {"laporan": 85, "presentasi": 90}
            $table->json('detail_nilai_guru')->nullable();
            
            $table->float('rata_rata_akhir')->default(0);
            $table->text('catatan_akhir')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penilaians');
    }
};
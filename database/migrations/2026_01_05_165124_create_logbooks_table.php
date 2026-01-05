<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('logbooks', function (Blueprint $table) {
            $table->id();
            
            // Terhubung ke User (Siswa)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            // Detail Kegiatan
            $table->date('tanggal');
            $table->time('jam_masuk')->nullable();
            $table->time('jam_keluar')->nullable();
            $table->text('kegiatan'); // Deskripsi
            $table->string('foto')->nullable(); // Bukti foto
            
            // Validasi (Biasanya oleh Mentor Industri)
            $table->enum('status', ['pending', 'disetujui', 'ditolak'])->default('pending');
            $table->foreignId('validated_by')->nullable()->constrained('users'); // Siapa yang validasi
            $table->dateTime('validated_at')->nullable(); // Kapan validasi
            $table->text('catatan_pembimbing')->nullable(); // Feedback

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('logbooks');
    }
};
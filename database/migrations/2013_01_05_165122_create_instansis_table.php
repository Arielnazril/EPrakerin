<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('instansis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_perusahaan'); // Contoh: PT. Telkom
            $table->text('alamat');
            $table->string('email_perusahaan')->nullable();
            $table->string('telepon')->nullable();
            $table->string('website')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('instansis');
    }
};
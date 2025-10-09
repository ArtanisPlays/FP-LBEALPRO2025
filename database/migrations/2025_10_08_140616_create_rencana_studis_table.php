<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_xxxxxx_create_rencana_studis_table.php
    public function up(): void
    {
        Schema::create('rencana_studis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->constrained()->onDelete('cascade');
            $table->string('tahun_akademik'); // Contoh: "2024/2025"
            $table->integer('semester');
            $table->enum('status', ['draft', 'diajukan', 'disetujui', 'ditolak', 'revisi'])->default('draft');
            $table->text('catatan_dosen')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rencana_studis');
    }
};

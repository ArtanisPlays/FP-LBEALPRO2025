<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Mengubah kolom status untuk menambahkan nilai enum baru
        Schema::table('rencana_studis', function (Blueprint $table) {
            $table->enum('status', [
                'draft', 
                'diajukan', 
                'disetujui', 
                'ditolak', 
                'revisi', 
                'perlu_persetujuan' // <-- Status baru
            ])->default('draft')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Mengembalikan ke state semula jika di-rollback
        Schema::table('rencana_studis', function (Blueprint $table) {
            $table->enum('status', [
                'draft', 
                'diajukan', 
                'disetujui', 
                'ditolak', 
                'revisi'
            ])->default('draft')->change();
        });
    }
};

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
        // This pivot table connects a course to its prerequisite course.
        Schema::create('matakuliah_prasyarat', function (Blueprint $table) {
            $table->id();
            // The course that has a prerequisite
            $table->foreignId('mata_kuliah_id')->constrained('mata_kuliahs')->onDelete('cascade');
            // The course that IS the prerequisite
            $table->foreignId('prasyarat_id')->constrained('mata_kuliahs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matakuliah_prasyarat');
    }
};

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
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama pengurus
            $table->string('position'); // Jabatan (contoh: Ketua Umum)
            $table->string('period'); // Periode jabatan (contoh: 2024-2025)
            $table->string('photo')->nullable(); // Foto pengurus
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};

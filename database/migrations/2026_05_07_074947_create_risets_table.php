<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('risets', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('category');
            $table->string('author')->nullable();
            $table->date('release_date')->nullable();
            $table->string('file_size')->nullable();
            $table->string('file_path')->nullable(); // Untuk menyimpan path PDF
            $table->string('status')->default('Publik'); // Publik, Draft, Terbatas
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('risets');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lombas', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('category');
            $table->string('organizer');
            $table->date('registration_deadline');
            $table->date('event_date')->nullable();
            $table->string('level')->nullable();
            $table->string('prize')->nullable();
            $table->text('description')->nullable();
            $table->string('registration_link')->nullable();
            $table->string('contact')->nullable();
            $table->string('status')->default('Buka');
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lombas');
    }
};
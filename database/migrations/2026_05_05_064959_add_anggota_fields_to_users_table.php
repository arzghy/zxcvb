<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Menambahkan kolom baru setelah kolom email
            $table->string('nim')->nullable()->after('email');
            $table->string('divisi')->nullable()->after('nim');
            $table->string('angkatan')->nullable()->after('divisi');
            $table->string('whatsapp')->nullable()->after('angkatan');
            $table->string('status')->default('aktif')->after('whatsapp');
            $table->string('jabatan')->default('anggota')->after('status');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Rollback jika terjadi kesalahan
            $table->dropColumn(['nim', 'divisi', 'angkatan', 'whatsapp', 'status', 'jabatan']);
        });
    }
};
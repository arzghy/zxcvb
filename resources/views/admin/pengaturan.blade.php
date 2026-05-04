@extends('layouts.admin')

@section('page-title', 'Pengaturan')
@section('page-breadcrumb', 'Konfigurasi Sistem')

@section('content')
<div class="section-header flex items-center justify-between mb-5 mt-2 gap-3 flex-wrap">
    <div>
        <div class="section-title text-lg font-bold text-gray-900">Pengaturan</div>
        <div class="section-sub text-sm text-gray-500">Konfigurasi sistem dashboard</div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
    <!-- Pengaturan Umum -->
    <div class="card p-6">
        <div class="font-bold text-base mb-4 text-gray-900">⚙️ Pengaturan Umum</div>
        
        <div class="mb-3.5">
            <label class="block text-xs font-semibold text-gray-500 mb-1">Nama Organisasi</label>
            <input class="inp" value="KSPM SV IPB">
        </div>
        <div class="mb-3.5">
            <label class="block text-xs font-semibold text-gray-500 mb-1">Email Admin</label>
            <input class="inp" type="email" value="admin@kspmsvipb.ac.id">
        </div>
        <div class="mb-3.5">
            <label class="block text-xs font-semibold text-gray-500 mb-1">Tagline</label>
            <input class="inp" value="Kelompok Studi Pasar Modal SV IPB">
        </div>
        
        <div class="mt-5">
            <button class="btn btn-primary" onclick="alert('Pengaturan berhasil disimpan!')">💾 Simpan Pengaturan</button>
        </div>
    </div>
    
    <!-- Keamanan Akun -->
    <div class="card p-6">
        <div class="font-bold text-base mb-4 text-gray-900">🔐 Keamanan Akun</div>
        
        <div class="mb-3.5">
            <label class="block text-xs font-semibold text-gray-500 mb-1">Username Admin</label>
            <input class="inp" value="admin_kspm">
        </div>
        <div class="mb-3.5">
            <label class="block text-xs font-semibold text-gray-500 mb-1">Password Baru</label>
            <input class="inp" type="password" placeholder="••••••••">
        </div>
        <div class="mb-3.5">
            <label class="block text-xs font-semibold text-gray-500 mb-1">Konfirmasi Password</label>
            <input class="inp" type="password" placeholder="••••••••">
        </div>
        
        <div class="mt-5">
            <button class="btn btn-warn bg-amber-500 hover:bg-amber-600 text-white" onclick="alert('Password berhasil diubah!')">🔒 Ubah Password</button>
        </div>
    </div>
</div>
@endsection
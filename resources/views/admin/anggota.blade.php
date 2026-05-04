@extends('layouts.admin')

@section('page-title', 'Manajemen Anggota')
@section('page-breadcrumb', 'Kelola Data Anggota')

@section('content')
<div class="section-header flex items-center justify-between mb-6 mt-2 gap-3 flex-wrap">
    <div>
        <div class="section-title text-lg font-bold text-gray-900">Manajemen Anggota</div>
        <div class="section-sub text-sm text-gray-500" id="anggota-count">Total 247 anggota terdaftar</div>
    </div>
    <div class="flex gap-2 flex-wrap">
        <div class="search-bar relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm transition-colors duration-300 pointer-events-none search-icon">🔍</span>
            <input class="inp inp-sm pl-9 hover:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all shadow-sm" placeholder="Cari anggota...">
        </div>
        <select class="inp inp-sm w-auto hover:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all cursor-pointer shadow-sm">
            <option value="">Semua Divisi</option>
            <option>Administration</option><option>Education</option><option>Media Creative</option>
            <option>Public Relation</option><option>Investment Gallery</option><option>Analyze Trading</option>
        </select>
        <button class="btn btn-primary btn-sm hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300" onclick="document.getElementById('modal-anggota').classList.add('open')">+ Tambah</button>
    </div>
</div>

<div class="card overflow-hidden hover:shadow-lg transition-shadow duration-300">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse text-sm">
            <thead>
                <tr class="text-gray-500 uppercase tracking-wider border-b border-gray-200 bg-gray-50">
                    <th class="px-4 py-3">Nama</th><th class="px-4 py-3">NIM</th><th class="px-4 py-3">Divisi</th>
                    <th class="px-4 py-3">Angkatan</th><th class="px-4 py-3">Status</th><th class="px-4 py-3">Kontak</th><th class="px-4 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b border-gray-50 hover:bg-blue-50 transition-colors duration-200 group cursor-pointer">
                    <td class="px-4 py-3">
                        <div class="flex items-center gap-2.5">
                            <div class="w-9 h-9 rounded-full bg-gradient-to-br from-blue-600 to-blue-400 flex items-center justify-center text-white font-bold text-xs shrink-0 group-hover:shadow-md group-hover:scale-105 transition-all duration-300">AP</div>
                            <div>
                                <div class="font-semibold text-gray-900 group-hover:text-blue-700 transition-colors">Andi Prasetyo</div>
                                <div class="text-[0.72rem] text-gray-500">Koordinator</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-3 font-mono text-[0.8rem] text-gray-700">J0401211001</td>
                    <td class="px-4 py-3"><span class="bg-blue-100 text-blue-800 px-2.5 py-0.5 rounded-full text-[0.7rem] font-semibold group-hover:bg-blue-200 transition-colors">Analyze Trading</span></td>
                    <td class="px-4 py-3 text-[0.85rem] text-gray-700">2021</td>
                    <td class="px-4 py-3"><span class="bg-green-100 text-green-800 px-2.5 py-0.5 rounded-full text-[0.7rem] font-semibold">Aktif</span></td>
                    <td class="px-4 py-3 text-[0.78rem] text-gray-500">085612341234</td>
                    <td class="px-4 py-3 text-right">
                        <button class="btn btn-ghost btn-icon btn-sm text-blue-600 hover:bg-blue-100 hover:scale-110 transition-transform">✏️</button>
                        <button class="btn btn-ghost btn-icon btn-sm text-red-500 ml-1 hover:bg-red-100 hover:scale-110 transition-transform">🗑️</button>
                    </td>
                </tr>
                <tr class="border-b border-gray-50 hover:bg-blue-50 transition-colors duration-200 group cursor-pointer">
                    <td class="px-4 py-3">
                        <div class="flex items-center gap-2.5">
                            <div class="w-9 h-9 rounded-full bg-gradient-to-br from-emerald-500 to-emerald-400 flex items-center justify-center text-white font-bold text-xs shrink-0 group-hover:shadow-md group-hover:scale-105 transition-all duration-300">SD</div>
                            <div>
                                <div class="font-semibold text-gray-900 group-hover:text-emerald-700 transition-colors">Sari Dewi Putri</div>
                                <div class="text-[0.72rem] text-gray-500">Staff</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-3 font-mono text-[0.8rem] text-gray-700">J0401221034</td>
                    <td class="px-4 py-3"><span class="bg-emerald-100 text-emerald-800 px-2.5 py-0.5 rounded-full text-[0.7rem] font-semibold group-hover:bg-emerald-200 transition-colors">Education</span></td>
                    <td class="px-4 py-3 text-[0.85rem] text-gray-700">2022</td>
                    <td class="px-4 py-3"><span class="bg-green-100 text-green-800 px-2.5 py-0.5 rounded-full text-[0.7rem] font-semibold">Aktif</span></td>
                    <td class="px-4 py-3 text-[0.78rem] text-gray-500">081234567890</td>
                    <td class="px-4 py-3 text-right">
                        <button class="btn btn-ghost btn-icon btn-sm text-blue-600 hover:bg-blue-100 hover:scale-110 transition-transform">✏️</button>
                        <button class="btn btn-ghost btn-icon btn-sm text-red-500 ml-1 hover:bg-red-100 hover:scale-110 transition-transform">🗑️</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<!-- Modal Tambah Anggota di sini (Sama dengan sebelumnya) -->
@endsection
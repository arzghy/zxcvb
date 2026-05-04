@extends('layouts.admin')

@section('page-title', 'Open Recruitment')
@section('page-breadcrumb', 'Kelola Rekrutmen Anggota')

@section('content')
<div class="section-header flex items-center justify-between mb-5 mt-2 gap-3 flex-wrap">
    <div>
        <div class="section-title text-lg font-bold text-gray-900">Open Recruitment</div>
        <div class="section-sub text-sm text-gray-500">Kelola periode & data rekrutmen anggota KSPM</div>
    </div>
    <button class="btn btn-primary btn-sm" onclick="document.getElementById('modal-rekrutmen').classList.add('open')">+ Buka Rekrutmen Baru</button>
</div>

<!-- Status Banner -->
<div class="bg-gradient-to-br from-blue-900 to-blue-700 rounded-2xl p-5 flex items-center justify-between flex-wrap gap-3 mb-5">
    <div class="flex items-center gap-3.5">
        <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center text-xl shrink-0">🎯</div>
        <div>
            <div class="text-white font-bold text-[0.95rem]">Open Recruitment KSPM SV IPB 2025/2026</div>
            <div class="text-white/70 text-xs mt-0.5">Dibuka: 2025-03-01 · Ditutup: 2025-04-15 · Kuota: 50 orang</div>
        </div>
    </div>
    <div class="flex gap-2">
        <button class="btn bg-white/20 text-white border border-white/30 hover:bg-white/30 btn-sm text-xs">🔗 Link Form</button>
        <button class="btn btn-warn btn-sm text-xs">✏️ Edit</button>
        <button class="btn btn-danger btn-sm text-xs" onclick="alert('Rekrutmen ditutup!')">🔒 Tutup</button>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-5 mb-5">
    <!-- Pengaturan Rekrutmen Aktif -->
    <div class="card p-6">
        <div class="font-bold mb-4 text-gray-900">⚙️ Pengaturan Rekrutmen Aktif</div>
        <div class="flex flex-col gap-2.5">
            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                <span class="text-xs text-gray-500">Status</span>
                <span class="bg-green-100 text-green-800 px-2.5 py-0.5 rounded-full text-[0.7rem] font-semibold">● Aktif</span>
            </div>
            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                <span class="text-xs text-gray-500">Dibuka</span><span class="text-sm font-semibold">2025-03-01</span>
            </div>
            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                <span class="text-xs text-gray-500">Ditutup</span><span class="text-sm font-semibold">2025-04-15</span>
            </div>
            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                <span class="text-xs text-gray-500">Kuota</span><span class="text-sm font-semibold">50 orang</span>
            </div>
            <div class="py-2 border-b border-gray-100">
                <div class="text-xs text-gray-500 mb-1">Deskripsi</div>
                <div class="text-[0.82rem] leading-relaxed">Bergabunglah bersama kami! KSPM SV IPB membuka rekrutmen anggota baru untuk periode kepengurusan 2025/2026.</div>
            </div>
            <div class="py-2">
                <div class="text-xs text-gray-500 mb-1">Link Form</div>
                <a href="#" class="text-[0.82rem] text-blue-600 hover:underline">https://forms.gle/example</a>
            </div>
        </div>
    </div>
    
    <!-- Statistik Pendaftar -->
    <div class="card p-6">
        <div class="font-bold mb-4 text-gray-900">📊 Statistik Pendaftar</div>
        <div class="grid grid-cols-2 gap-3">
            <div class="stat-card text-center !p-3">
                <div class="text-[0.65rem] text-gray-500 mb-1 font-bold">TOTAL DAFTAR</div>
                <div class="mono text-2xl font-extrabold text-blue-600">5</div>
            </div>
            <div class="stat-card text-center !p-3">
                <div class="text-[0.65rem] text-gray-500 mb-1 font-bold">LOLOS SELEKSI</div>
                <div class="mono text-2xl font-extrabold text-emerald-500">1</div>
            </div>
            <div class="stat-card text-center !p-3">
                <div class="text-[0.65rem] text-gray-500 mb-1 font-bold">TAHAP WAWANCARA</div>
                <div class="mono text-2xl font-extrabold text-amber-500">1</div>
            </div>
            <div class="stat-card text-center !p-3">
                <div class="text-[0.65rem] text-gray-500 mb-1 font-bold">TIDAK LOLOS</div>
                <div class="mono text-2xl font-extrabold text-red-500">1</div>
            </div>
        </div>
    </div>
</div>

<!-- Tabel Pendaftar -->
<div class="card overflow-hidden">
    <div class="p-4 border-b border-gray-200 flex items-center justify-between flex-wrap gap-3">
        <div class="font-bold text-gray-900">📋 Data Pendaftar</div>
        <div class="flex gap-2 flex-wrap">
            <div class="search-bar relative">
                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm">🔍</span>
                <input class="inp inp-sm pl-9" placeholder="Cari pendaftar...">
            </div>
            <select class="inp inp-sm" style="width:auto">
                <option value="">Semua Divisi</option>
                <option>Administration</option><option>Education</option><option>Media Creative</option>
                <option>Public Relation</option><option>Investment Gallery</option><option>Analyze Trading</option>
            </select>
            <select class="inp inp-sm" style="width:auto">
                <option value="">Semua Status</option>
                <option>Menunggu</option><option>Lolos Berkas</option><option>Wawancara</option>
                <option>Diterima</option><option>Tidak Lolos</option>
            </select>
            <button class="btn btn-outline border-blue-600 text-blue-700 bg-white btn-sm" onclick="document.getElementById('modal-pendaftar').classList.add('open')">+ Tambah Manual</button>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse text-sm">
            <thead>
                <tr class="text-gray-500 uppercase tracking-wider border-b border-gray-200 bg-gray-50">
                    <th class="px-4 py-3">Nama</th>
                    <th class="px-4 py-3">NIM</th>
                    <th class="px-4 py-3">Pilihan Divisi</th>
                    <th class="px-4 py-3">Tanggal Daftar</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- Pendaftar 1 -->
                <tr class="border-b border-gray-50 hover:bg-blue-50 transition">
                    <td class="px-4 py-3">
                        <div class="font-semibold text-gray-900">Budi Santoso</div>
                        <div class="text-xs text-gray-500">budi@apps.ipb.ac.id</div>
                    </td>
                    <td class="px-4 py-3 font-mono text-[0.8rem]">J0401251001</td>
                    <td class="px-4 py-3">
                        <span class="bg-blue-100 text-blue-800 px-2.5 py-0.5 rounded-full text-[0.68rem] font-semibold">Analyze Trading</span>
                        <span class="bg-gray-100 text-gray-600 px-2.5 py-0.5 rounded-full text-[0.65rem] font-semibold ml-1">Education</span>
                    </td>
                    <td class="px-4 py-3 font-mono text-[0.8rem]">2025-03-05</td>
                    <td class="px-4 py-3">
                        <select class="inp inp-sm" style="width:auto;font-size:.75rem">
                            <option>Menunggu</option><option>Lolos Berkas</option><option>Wawancara</option><option selected>Diterima</option><option>Tidak Lolos</option>
                        </select>
                    </td>
                    <td class="px-4 py-3 text-right whitespace-nowrap">
                        <button class="btn btn-ghost btn-icon btn-sm text-blue-600">✏️</button>
                        <button class="btn btn-ghost btn-icon btn-sm text-red-500 ml-1">🗑️</button>
                    </td>
                </tr>
                <!-- Pendaftar 2 -->
                <tr class="border-b border-gray-50 hover:bg-blue-50 transition">
                    <td class="px-4 py-3">
                        <div class="font-semibold text-gray-900">Dewi Lestari</div>
                        <div class="text-xs text-gray-500">dewilestari@apps.ipb.ac.id</div>
                    </td>
                    <td class="px-4 py-3 font-mono text-[0.8rem]">J0401251002</td>
                    <td class="px-4 py-3">
                        <span class="bg-blue-100 text-blue-800 px-2.5 py-0.5 rounded-full text-[0.68rem] font-semibold">Media Creative</span>
                    </td>
                    <td class="px-4 py-3 font-mono text-[0.8rem]">2025-03-06</td>
                    <td class="px-4 py-3">
                        <select class="inp inp-sm" style="width:auto;font-size:.75rem">
                            <option>Menunggu</option><option selected>Lolos Berkas</option><option>Wawancara</option><option>Diterima</option><option>Tidak Lolos</option>
                        </select>
                    </td>
                    <td class="px-4 py-3 text-right whitespace-nowrap">
                        <button class="btn btn-ghost btn-icon btn-sm text-blue-600">✏️</button>
                        <button class="btn btn-ghost btn-icon btn-sm text-red-500 ml-1">🗑️</button>
                    </td>
                </tr>
                <!-- Pendaftar 3 -->
                <tr class="border-b border-gray-50 hover:bg-blue-50 transition">
                    <td class="px-4 py-3">
                        <div class="font-semibold text-gray-900">Fitri Handayani</div>
                        <div class="text-xs text-gray-500">fitri@apps.ipb.ac.id</div>
                    </td>
                    <td class="px-4 py-3 font-mono text-[0.8rem]">J0401251004</td>
                    <td class="px-4 py-3">
                        <span class="bg-blue-100 text-blue-800 px-2.5 py-0.5 rounded-full text-[0.68rem] font-semibold">Investment Gallery</span>
                    </td>
                    <td class="px-4 py-3 font-mono text-[0.8rem]">2025-03-08</td>
                    <td class="px-4 py-3">
                        <select class="inp inp-sm" style="width:auto;font-size:.75rem">
                            <option>Menunggu</option><option>Lolos Berkas</option><option selected>Wawancara</option><option>Diterima</option><option>Tidak Lolos</option>
                        </select>
                    </td>
                    <td class="px-4 py-3 text-right whitespace-nowrap">
                        <button class="btn btn-ghost btn-icon btn-sm text-blue-600">✏️</button>
                        <button class="btn btn-ghost btn-icon btn-sm text-red-500 ml-1">🗑️</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- MODAL BUKA REKRUTMEN -->
<div class="modal-overlay fixed inset-0 bg-black/50 z-50 hidden items-center justify-center p-4" id="modal-rekrutmen">
    <div class="modal bg-white rounded-2xl p-7 w-full max-w-2xl max-h-[90vh] overflow-y-auto relative">
        <div class="modal-header flex items-center justify-between mb-5 pb-3.5 border-b border-gray-200">
            <div class="modal-title text-base font-bold text-gray-900">Buka Rekrutmen Baru</div>
            <button class="w-8 h-8 rounded-lg bg-gray-100 text-gray-500 hover:bg-red-100 hover:text-red-500 transition flex items-center justify-center" onclick="document.getElementById('modal-rekrutmen').classList.remove('open')">✕</button>
        </div>
        
        <div class="mb-3.5">
            <label class="block text-xs font-semibold text-gray-500 mb-1">Nama / Judul Rekrutmen*</label>
            <input class="inp" placeholder="Open Recruitment KSPM SV IPB 2025/2026">
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-3.5">
            <div><label class="block text-xs font-semibold text-gray-500 mb-1">Tanggal Buka*</label><input type="date" class="inp"></div>
            <div><label class="block text-xs font-semibold text-gray-500 mb-1">Tanggal Tutup*</label><input type="date" class="inp"></div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-3.5">
            <div><label class="block text-xs font-semibold text-gray-500 mb-1">Kuota Total</label><input type="number" class="inp" placeholder="50"></div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1">Status</label>
                <select class="inp">
                    <option>Aktif</option><option>Draft</option><option>Ditutup</option>
                </select>
            </div>
        </div>
        <div class="mb-3.5">
            <label class="block text-xs font-semibold text-gray-500 mb-1">Deskripsi / Persyaratan Umum</label>
            <textarea class="inp" rows="3" placeholder="Tuliskan persyaratan dan informasi rekrutmen..."></textarea>
        </div>
        <div class="mb-3.5">
            <label class="block text-xs font-semibold text-gray-500 mb-1">Link Formulir Pendaftaran</label>
            <input class="inp" placeholder="https://forms.gle/...">
        </div>
        <div class="mb-3.5">
            <label class="block text-xs font-semibold text-gray-500 mb-1">Poster Rekrutmen</label>
            <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:bg-blue-50 transition cursor-pointer">
                <div class="text-4xl mb-2">🎯</div>
                <div class="font-semibold text-gray-500 text-sm">Upload poster rekrutmen</div>
                <div class="text-xs text-gray-400 mt-1">JPG/PNG · maks 3MB</div>
            </div>
        </div>
        
        <div class="mt-5 pt-4 border-t border-gray-200 flex justify-end gap-2.5">
            <button class="btn btn-ghost" onclick="document.getElementById('modal-rekrutmen').classList.remove('open')">Batal</button>
            <button class="btn btn-primary" onclick="alert('Rekrutmen disimpan & dipublikasikan!'); document.getElementById('modal-rekrutmen').classList.remove('open')">🎯 Simpan & Publikasikan</button>
        </div>
    </div>
</div>

<!-- MODAL TAMBAH PENDAFTAR -->
<div class="modal-overlay fixed inset-0 bg-black/50 z-50 hidden items-center justify-center p-4" id="modal-pendaftar">
    <div class="modal bg-white rounded-2xl p-7 w-full max-w-2xl max-h-[90vh] overflow-y-auto relative">
        <div class="modal-header flex items-center justify-between mb-5 pb-3.5 border-b border-gray-200">
            <div class="modal-title text-base font-bold text-gray-900">Tambah Pendaftar</div>
            <button class="w-8 h-8 rounded-lg bg-gray-100 text-gray-500 hover:bg-red-100 hover:text-red-500 transition flex items-center justify-center" onclick="document.getElementById('modal-pendaftar').classList.remove('open')">✕</button>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-3.5">
            <div><label class="block text-xs font-semibold text-gray-500 mb-1">Nama Lengkap*</label><input class="inp" placeholder="Nama lengkap pendaftar"></div>
            <div><label class="block text-xs font-semibold text-gray-500 mb-1">NIM*</label><input class="inp" placeholder="J0X00000000"></div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-3.5">
            <div><label class="block text-xs font-semibold text-gray-500 mb-1">Email</label><input class="inp" placeholder="nama@apps.ipb.ac.id"></div>
            <div><label class="block text-xs font-semibold text-gray-500 mb-1">WhatsApp</label><input class="inp" placeholder="08xxxxxxxxxx"></div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-3.5">
            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1">Pilihan Divisi 1*</label>
                <select class="inp">
                    <option value="">Pilih Divisi</option>
                    <option>Administration</option><option>Education</option><option>Media Creative</option>
                    <option>Public Relation</option><option>Investment Gallery</option><option>Analyze Trading</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1">Pilihan Divisi 2</label>
                <select class="inp">
                    <option value="">Tidak ada</option>
                    <option>Administration</option><option>Education</option><option>Media Creative</option>
                    <option>Public Relation</option><option>Investment Gallery</option><option>Analyze Trading</option>
                </select>
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-3.5">
            <div><label class="block text-xs font-semibold text-gray-500 mb-1">Tanggal Daftar</label><input type="date" class="inp"></div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1">Status Seleksi</label>
                <select class="inp">
                    <option>Menunggu</option><option>Lolos Berkas</option><option>Wawancara</option><option>Diterima</option><option>Tidak Lolos</option>
                </select>
            </div>
        </div>
        <div class="mb-3.5">
            <label class="block text-xs font-semibold text-gray-500 mb-1">Catatan Admin</label>
            <textarea class="inp" rows="2" placeholder="Catatan proses seleksi..."></textarea>
        </div>
        
        <div class="mt-5 pt-4 border-t border-gray-200 flex justify-end gap-2.5">
            <button class="btn btn-ghost" onclick="document.getElementById('modal-pendaftar').classList.remove('open')">Batal</button>
            <button class="btn btn-primary" onclick="alert('Pendaftar disimpan!'); document.getElementById('modal-pendaftar').classList.remove('open')">💾 Simpan</button>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
/* Style pembantu agar modal berfungsi saat display:flex disematkan */
.modal-overlay.open { display: flex !important; }
</style>
@endpush
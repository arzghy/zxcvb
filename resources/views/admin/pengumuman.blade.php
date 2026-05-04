@extends('layouts.admin')

@section('page-title', 'Pengumuman')
@section('page-breadcrumb', 'Kelola Pengumuman')

@section('content')
<div class="section-header flex items-center justify-between mb-5 mt-2 gap-3 flex-wrap">
    <div>
        <div class="section-title text-lg font-bold text-gray-900">Pengumuman</div>
        <div class="section-sub text-sm text-gray-500">Kelola pengumuman untuk anggota</div>
    </div>
    <button class="btn btn-primary btn-sm" onclick="document.getElementById('modal-pengumuman').classList.add('open')">+ Buat Pengumuman</button>
</div>

<div id="pengumuman-list" class="flex flex-col gap-3">
    <!-- Pengumuman Item 1 -->
    <div class="card" style="padding:20px;position:relative">
        <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:12px;margin-bottom:10px">
            <div style="display:flex;align-items:center;gap:10px">
                <span class="bg-green-100 text-green-800 px-2.5 py-0.5 rounded-full text-xs font-semibold">Rekrutmen</span>
                <span class="bg-slate-100 text-slate-600 px-2.5 py-0.5 rounded-full text-[0.65rem] font-semibold flex items-center gap-1">Publik</span>
            </div>
            <div class="flex gap-1.5">
                <button class="btn btn-ghost btn-icon btn-sm text-blue-600">✏️</button>
                <button class="btn btn-ghost btn-icon btn-sm text-red-500">🗑️</button>
            </div>
        </div>
        <div class="font-bold text-[0.95rem] mb-1.5 text-gray-900">Rekrutmen Anggota Baru KSPM 2025</div>
        <div class="text-[0.85rem] text-gray-500 leading-relaxed mb-2.5">KSPM SV IPB membuka rekrutmen anggota baru periode 2025. Daftar sekarang dan bergabunglah dengan kami!</div>
        <div class="text-[0.72rem] text-gray-400 font-mono">2025-03-01 s/d 2025-04-01</div>
    </div>

    <!-- Pengumuman Item 2 -->
    <div class="card" style="padding:20px;position:relative">
        <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:12px;margin-bottom:10px">
            <div style="display:flex;align-items:center;gap:10px">
                <span class="bg-red-100 text-red-800 px-2.5 py-0.5 rounded-full text-xs font-semibold">Penting</span>
                <span class="bg-slate-100 text-slate-600 px-2.5 py-0.5 rounded-full text-[0.65rem] font-semibold flex items-center gap-1">Semua Anggota</span>
            </div>
            <div class="flex gap-1.5">
                <button class="btn btn-ghost btn-icon btn-sm text-blue-600">✏️</button>
                <button class="btn btn-ghost btn-icon btn-sm text-red-500">🗑️</button>
            </div>
        </div>
        <div class="font-bold text-[0.95rem] mb-1.5 text-gray-900">Pengumuman Anggota Lolos Seleksi</div>
        <div class="text-[0.85rem] text-gray-500 leading-relaxed mb-2.5">Selamat kepada anggota yang lolos seleksi tahap akhir. Cek nama kalian di website resmi KSPM.</div>
        <div class="text-[0.72rem] text-gray-400 font-mono">2025-03-10 s/d 2025-03-20</div>
    </div>

    <!-- Pengumuman Item 3 -->
    <div class="card" style="padding:20px;position:relative">
        <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:12px;margin-bottom:10px">
            <div style="display:flex;align-items:center;gap:10px">
                <span class="bg-blue-100 text-blue-800 px-2.5 py-0.5 rounded-full text-xs font-semibold">Info</span>
                <span class="bg-slate-100 text-slate-600 px-2.5 py-0.5 rounded-full text-[0.65rem] font-semibold flex items-center gap-1">Semua Anggota</span>
            </div>
            <div class="flex gap-1.5">
                <button class="btn btn-ghost btn-icon btn-sm text-blue-600">✏️</button>
                <button class="btn btn-ghost btn-icon btn-sm text-red-500">🗑️</button>
            </div>
        </div>
        <div class="font-bold text-[0.95rem] mb-1.5 text-gray-900">Jadwal SPM Batch 2 Diperbarui</div>
        <div class="text-[0.85rem] text-gray-500 leading-relaxed mb-2.5">Jadwal Sekolah Pasar Modal Batch 2 telah diperbarui. Harap konfirmasi kehadiran.</div>
        <div class="text-[0.72rem] text-gray-400 font-mono">2025-03-08 s/d 2025-03-15</div>
    </div>
</div>

<!-- MODAL BUAT PENGUMUMAN -->
<div class="modal-overlay fixed inset-0 bg-black/50 z-50 hidden items-center justify-center p-4" id="modal-pengumuman">
    <div class="modal bg-white rounded-2xl p-7 w-full max-w-lg max-h-[90vh] overflow-y-auto relative">
        <div class="modal-header flex items-center justify-between mb-5 pb-3.5 border-b border-gray-200">
            <div class="modal-title text-base font-bold text-gray-900">Buat Pengumuman</div>
            <button class="w-8 h-8 rounded-lg bg-gray-100 text-gray-500 hover:bg-red-100 hover:text-red-500 transition flex items-center justify-center" onclick="document.getElementById('modal-pengumuman').classList.remove('open')">✕</button>
        </div>
        
        <div class="mb-3.5">
            <label class="block text-xs font-semibold text-gray-500 mb-1">Judul Pengumuman*</label>
            <input class="inp" placeholder="Judul pengumuman">
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-3.5">
            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1">Tipe</label>
                <select class="inp">
                    <option>Info</option><option>Penting</option><option>Rekrutmen</option><option>Kegiatan</option><option>Lomba</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1">Target</label>
                <select class="inp">
                    <option>Semua Anggota</option><option>Staff</option><option>Publik</option>
                </select>
            </div>
        </div>
        <div class="mb-3.5">
            <label class="block text-xs font-semibold text-gray-500 mb-1">Isi Pengumuman*</label>
            <textarea class="inp" placeholder="Tulis isi pengumuman di sini..." style="min-height:120px"></textarea>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-3.5">
            <div><label class="block text-xs font-semibold text-gray-500 mb-1">Tanggal Mulai</label><input type="date" class="inp"></div>
            <div><label class="block text-xs font-semibold text-gray-500 mb-1">Tanggal Berakhir</label><input type="date" class="inp"></div>
        </div>
        
        <div class="mt-5 pt-4 border-t border-gray-200 flex justify-end gap-2.5">
            <button class="btn btn-ghost" onclick="document.getElementById('modal-pengumuman').classList.remove('open')">Batal</button>
            <button class="btn btn-primary" onclick="alert('Pengumuman dipublish!'); document.getElementById('modal-pengumuman').classList.remove('open')">📢 Publish</button>
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
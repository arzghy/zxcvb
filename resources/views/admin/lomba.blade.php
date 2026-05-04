@extends('layouts.admin')

@section('page-title', 'Info Lomba')
@section('page-breadcrumb', 'Kelola Kompetisi')

@section('content')
<div class="section-header flex items-center justify-between mb-5 mt-2 gap-3 flex-wrap">
    <div>
        <div class="section-title text-lg font-bold text-gray-900">Info Lomba</div>
        <div class="section-sub text-sm text-gray-500">Kelola & publikasikan informasi lomba untuk anggota</div>
    </div>
    <div class="flex gap-2 flex-wrap">
        <div class="search-bar relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm">🔍</span>
            <input class="inp inp-sm pl-9" id="lomba-search" placeholder="Cari lomba...">
        </div>
        <select class="inp inp-sm" id="lomba-filter" style="width:auto">
            <option value="">Semua Kategori</option>
            <option>Analisis Saham</option>
            <option>Business Plan</option>
            <option>Essay</option>
            <option>Karya Ilmiah</option>
            <option>Debat</option>
        </select>
        <button class="btn btn-primary btn-sm" onclick="document.getElementById('modal-lomba').classList.add('open')">+ Tambah Lomba</button>
    </div>
</div>

<div id="lomba-grid" style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:16px">
    <!-- Lomba Item 1 -->
    <div class="card p-5 relative overflow-hidden transition-all hover:border-blue-600 hover:shadow-lg hover:-translate-y-1">
        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-blue-600 to-blue-400"></div>
        <span class="absolute top-4 right-4"><span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-semibold">Buka</span></span>
        
        <div class="flex items-center gap-2 mb-3">
            <span class="text-2xl">🏆</span>
            <span class="bg-blue-100 text-blue-800 px-2.5 py-0.5 rounded-full text-[0.68rem] font-semibold">Analisis Saham</span>
        </div>
        <div class="font-bold text-[0.95rem] mb-1 pr-16 text-gray-900">Kompetisi Analisis Saham BEI 2025</div>
        <div class="text-[0.78rem] text-gray-500 mb-3">Bursa Efek Indonesia</div>
        
        <div class="flex flex-col gap-1.5 mb-3.5 text-[0.78rem]">
            <div class="flex gap-2"><span>📅</span><span>Deadline: <strong>01 April 2025</strong></span></div>
            <div class="flex gap-2"><span>🌍</span><span>Tingkat: <strong>Nasional</strong></span></div>
            <div class="flex gap-2"><span>💰</span><span>Hadiah: <strong>Rp 50.000.000</strong></span></div>
        </div>
        
        <div class="text-[0.78rem] text-gray-500 mb-3.5 leading-relaxed">Kompetisi analisis saham tingkat nasional yang diselenggarakan BEI untuk mahasiswa se-Indonesia...</div>
        
        <div class="flex gap-2 flex-wrap mt-auto">
            <a href="#" target="_blank" class="btn btn-primary btn-sm text-xs">🔗 Daftar</a>
            <button class="btn btn-outline border-blue-600 text-blue-700 bg-white btn-sm text-xs">✏️ Edit</button>
            <button class="btn btn-ghost text-red-500 hover:bg-red-50 btn-sm text-xs">🗑️</button>
        </div>
    </div>

    <!-- Lomba Item 2 -->
    <div class="card p-5 relative overflow-hidden transition-all hover:border-blue-600 hover:shadow-lg hover:-translate-y-1">
        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-blue-600 to-blue-400"></div>
        <span class="absolute top-4 right-4"><span class="bg-amber-100 text-amber-800 px-2 py-1 rounded-full text-xs font-semibold">Segera Tutup</span></span>
        
        <div class="flex items-center gap-2 mb-3">
            <span class="text-2xl">🏆</span>
            <span class="bg-blue-100 text-blue-800 px-2.5 py-0.5 rounded-full text-[0.68rem] font-semibold">Business Plan</span>
        </div>
        <div class="font-bold text-[0.95rem] mb-1 pr-16 text-gray-900">INVEST! Business Plan Competition</div>
        <div class="text-[0.78rem] text-gray-500 mb-3">FEB Universitas Indonesia</div>
        
        <div class="flex flex-col gap-1.5 mb-3.5 text-[0.78rem]">
            <div class="flex gap-2"><span>📅</span><span>Deadline: <strong>25 Maret 2025</strong></span></div>
            <div class="flex gap-2"><span>🌍</span><span>Tingkat: <strong>Nasional</strong></span></div>
            <div class="flex gap-2"><span>💰</span><span>Hadiah: <strong>Rp 30.000.000</strong></span></div>
        </div>
        
        <div class="text-[0.78rem] text-gray-500 mb-3.5 leading-relaxed">Kompetisi business plan dengan tema finansial dan investasi untuk mahasiswa S1 seluruh Indonesia...</div>
        
        <div class="flex gap-2 flex-wrap mt-auto">
            <a href="#" target="_blank" class="btn btn-primary btn-sm text-xs">🔗 Daftar</a>
            <button class="btn btn-outline border-blue-600 text-blue-700 bg-white btn-sm text-xs">✏️ Edit</button>
            <button class="btn btn-ghost text-red-500 hover:bg-red-50 btn-sm text-xs">🗑️</button>
        </div>
    </div>

    <!-- Lomba Item 3 -->
    <div class="card p-5 relative overflow-hidden transition-all hover:border-blue-600 hover:shadow-lg hover:-translate-y-1">
        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-blue-600 to-blue-400"></div>
        <span class="absolute top-4 right-4"><span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-semibold">Buka</span></span>
        
        <div class="flex items-center gap-2 mb-3">
            <span class="text-2xl">🏆</span>
            <span class="bg-blue-100 text-blue-800 px-2.5 py-0.5 rounded-full text-[0.68rem] font-semibold">Essay</span>
        </div>
        <div class="font-bold text-[0.95rem] mb-1 pr-16 text-gray-900">Essay Competition Pasar Modal 2025</div>
        <div class="text-[0.78rem] text-gray-500 mb-3">OJK</div>
        
        <div class="flex flex-col gap-1.5 mb-3.5 text-[0.78rem]">
            <div class="flex gap-2"><span>📅</span><span>Deadline: <strong>01 Mei 2025</strong></span></div>
            <div class="flex gap-2"><span>🌍</span><span>Tingkat: <strong>Nasional</strong></span></div>
            <div class="flex gap-2"><span>💰</span><span>Hadiah: <strong>Rp 15.000.000</strong></span></div>
        </div>
        
        <div class="text-[0.78rem] text-gray-500 mb-3.5 leading-relaxed">Lomba essay bertema literasi keuangan dan pasar modal untuk mahasiswa...</div>
        
        <div class="flex gap-2 flex-wrap mt-auto">
            <a href="#" target="_blank" class="btn btn-primary btn-sm text-xs">🔗 Daftar</a>
            <button class="btn btn-outline border-blue-600 text-blue-700 bg-white btn-sm text-xs">✏️ Edit</button>
            <button class="btn btn-ghost text-red-500 hover:bg-red-50 btn-sm text-xs">🗑️</button>
        </div>
    </div>
</div>

<!-- MODAL TAMBAH LOMBA -->
<div class="modal-overlay fixed inset-0 bg-black/50 z-50 hidden items-center justify-center p-4" id="modal-lomba">
    <div class="modal bg-white rounded-2xl p-7 w-full max-w-2xl max-h-[90vh] overflow-y-auto relative">
        <div class="modal-header flex items-center justify-between mb-5 pb-3.5 border-b border-gray-200">
            <div class="modal-title text-base font-bold text-gray-900">Tambah Info Lomba</div>
            <button class="w-8 h-8 rounded-lg bg-gray-100 text-gray-500 hover:bg-red-100 hover:text-red-500 transition flex items-center justify-center" onclick="document.getElementById('modal-lomba').classList.remove('open')">✕</button>
        </div>
        
        <div class="mb-3.5">
            <label class="block text-xs font-semibold text-gray-500 mb-1">Nama Lomba*</label>
            <input class="inp" placeholder="Nama kompetisi / lomba">
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-3.5">
            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1">Kategori*</label>
                <select class="inp">
                    <option>Analisis Saham</option><option>Business Plan</option><option>Essay</option>
                    <option>Karya Ilmiah</option><option>Debat</option><option>Trading Competition</option><option>Lainnya</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1">Penyelenggara*</label>
                <input class="inp" placeholder="Nama institusi">
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-3.5">
            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1">Deadline Pendaftaran*</label>
                <input type="date" class="inp">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1">Tanggal Pelaksanaan</label>
                <input type="date" class="inp">
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-3.5">
            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1">Tingkat</label>
                <select class="inp">
                    <option>Nasional</option><option>Internasional</option><option>Regional</option><option>Kampus</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1">Total Hadiah</label>
                <input class="inp" placeholder="Rp 10.000.000">
            </div>
        </div>
        <div class="mb-3.5">
            <label class="block text-xs font-semibold text-gray-500 mb-1">Deskripsi / Ketentuan</label>
            <textarea class="inp" placeholder="Jelaskan persyaratan, ketentuan, dan informasi penting lainnya..." rows="3"></textarea>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-3.5">
            <div><label class="block text-xs font-semibold text-gray-500 mb-1">Link Pendaftaran</label><input class="inp" placeholder="https://..."></div>
            <div><label class="block text-xs font-semibold text-gray-500 mb-1">Kontak Panitia</label><input class="inp" placeholder="WA/email panitia"></div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-3.5">
            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1">Status</label>
                <select class="inp">
                    <option>Buka</option><option>Segera Tutup</option><option>Tutup</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1">Tampil di Homepage</label>
                <select class="inp">
                    <option value="1">Ya, publikasikan</option><option value="0">Tidak</option>
                </select>
            </div>
        </div>
        <div class="mt-5 pt-4 border-t border-gray-200 flex justify-end gap-2.5">
            <button class="btn btn-ghost" onclick="document.getElementById('modal-lomba').classList.remove('open')">Batal</button>
            <button class="btn btn-primary" onclick="alert('Info lomba disimpan!'); document.getElementById('modal-lomba').classList.remove('open')">🏆 Simpan Lomba</button>
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
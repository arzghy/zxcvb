@extends('layouts.admin')

@section('page-title', 'Kamus Investasi')
@section('page-breadcrumb', 'Manajemen Istilah')

@section('content')
<div class="section-header flex items-center justify-between mb-5 mt-2 gap-3 flex-wrap">
    <div>
        <div class="section-title text-lg font-bold text-gray-900">Kamus Investasi</div>
        <div class="section-sub text-sm text-gray-500">Kelola istilah-istilah pasar modal</div>
    </div>
    <div class="flex gap-2 flex-wrap">
        <div class="search-bar relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm">🔍</span>
            <input class="inp inp-sm pl-9" placeholder="Cari istilah...">
        </div>
        <button class="btn btn-primary btn-sm" onclick="document.getElementById('modal-kamus').classList.add('open')">+ Tambah Istilah</button>
    </div>
</div>

<div class="card overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse text-sm">
            <thead>
                <tr class="text-gray-500 uppercase tracking-wider border-b border-gray-200 bg-gray-50">
                    <th class="px-4 py-3">Istilah</th>
                    <th class="px-4 py-3">Definisi</th>
                    <th class="px-4 py-3">Kategori</th>
                    <th class="px-4 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b border-gray-50 hover:bg-blue-50 transition">
                    <td class="px-4 py-3 font-bold text-blue-700">Saham</td>
                    <td class="px-4 py-3 text-[0.83rem] text-gray-500 leading-relaxed max-w-md">Bukti kepemilikan seseorang atau badan usaha terhadap suatu perusahaan yang telah go public.</td>
                    <td class="px-4 py-3"><span class="bg-gray-100 text-gray-600 px-2.5 py-0.5 rounded-full text-xs font-semibold">Umum</span></td>
                    <td class="px-4 py-3 text-right whitespace-nowrap">
                        <button class="btn btn-ghost btn-icon btn-sm text-blue-600">✏️</button>
                        <button class="btn btn-ghost btn-icon btn-sm text-red-500 ml-1">🗑️</button>
                    </td>
                </tr>
                <tr class="border-b border-gray-50 hover:bg-blue-50 transition">
                    <td class="px-4 py-3 font-bold text-blue-700">Dividen</td>
                    <td class="px-4 py-3 text-[0.83rem] text-gray-500 leading-relaxed max-w-md">Pembagian keuntungan perusahaan kepada pemegang saham sesuai jumlah saham yang dimiliki.</td>
                    <td class="px-4 py-3"><span class="bg-orange-100 text-orange-800 px-2.5 py-0.5 rounded-full text-xs font-semibold">Fundamental</span></td>
                    <td class="px-4 py-3 text-right whitespace-nowrap">
                        <button class="btn btn-ghost btn-icon btn-sm text-blue-600">✏️</button>
                        <button class="btn btn-ghost btn-icon btn-sm text-red-500 ml-1">🗑️</button>
                    </td>
                </tr>
                <tr class="border-b border-gray-50 hover:bg-blue-50 transition">
                    <td class="px-4 py-3 font-bold text-blue-700">IPO</td>
                    <td class="px-4 py-3 text-[0.83rem] text-gray-500 leading-relaxed max-w-md">Initial Public Offering — penawaran saham perdana kepada publik untuk pertama kalinya.</td>
                    <td class="px-4 py-3"><span class="bg-gray-100 text-gray-600 px-2.5 py-0.5 rounded-full text-xs font-semibold">Umum</span></td>
                    <td class="px-4 py-3 text-right whitespace-nowrap">
                        <button class="btn btn-ghost btn-icon btn-sm text-blue-600">✏️</button>
                        <button class="btn btn-ghost btn-icon btn-sm text-red-500 ml-1">🗑️</button>
                    </td>
                </tr>
                <tr class="border-b border-gray-50 hover:bg-blue-50 transition">
                    <td class="px-4 py-3 font-bold text-blue-700">PER</td>
                    <td class="px-4 py-3 text-[0.83rem] text-gray-500 leading-relaxed max-w-md">Price to Earnings Ratio — rasio harga saham terhadap laba per saham. Digunakan untuk menilai valuasi.</td>
                    <td class="px-4 py-3"><span class="bg-orange-100 text-orange-800 px-2.5 py-0.5 rounded-full text-xs font-semibold">Fundamental</span></td>
                    <td class="px-4 py-3 text-right whitespace-nowrap">
                        <button class="btn btn-ghost btn-icon btn-sm text-blue-600">✏️</button>
                        <button class="btn btn-ghost btn-icon btn-sm text-red-500 ml-1">🗑️</button>
                    </td>
                </tr>
                <tr class="border-b border-gray-50 hover:bg-blue-50 transition">
                    <td class="px-4 py-3 font-bold text-blue-700">Support</td>
                    <td class="px-4 py-3 text-[0.83rem] text-gray-500 leading-relaxed max-w-md">Level harga di mana permintaan cukup kuat untuk menghentikan penurunan harga saham.</td>
                    <td class="px-4 py-3"><span class="bg-blue-100 text-blue-800 px-2.5 py-0.5 rounded-full text-xs font-semibold">Teknikal</span></td>
                    <td class="px-4 py-3 text-right whitespace-nowrap">
                        <button class="btn btn-ghost btn-icon btn-sm text-blue-600">✏️</button>
                        <button class="btn btn-ghost btn-icon btn-sm text-red-500 ml-1">🗑️</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- MODAL TAMBAH KAMUS -->
<div class="modal-overlay fixed inset-0 bg-black/50 z-50 hidden items-center justify-center p-4" id="modal-kamus">
    <div class="modal bg-white rounded-2xl p-7 w-full max-w-md relative">
        <div class="modal-header flex items-center justify-between mb-5 pb-3.5 border-b border-gray-200">
            <div class="modal-title text-base font-bold text-gray-900">Tambah Istilah</div>
            <button class="w-8 h-8 rounded-lg bg-gray-100 text-gray-500 hover:bg-red-100 hover:text-red-500 transition flex items-center justify-center" onclick="document.getElementById('modal-kamus').classList.remove('open')">✕</button>
        </div>
        
        <div class="mb-3.5">
            <label class="block text-xs font-semibold text-gray-500 mb-1">Istilah*</label>
            <input class="inp" placeholder="Nama istilah investasi">
        </div>
        <div class="mb-3.5">
            <label class="block text-xs font-semibold text-gray-500 mb-1">Definisi*</label>
            <textarea class="inp" rows="3" placeholder="Penjelasan singkat dan jelas..."></textarea>
        </div>
        <div class="mb-3.5">
            <label class="block text-xs font-semibold text-gray-500 mb-1">Kategori</label>
            <select class="inp">
                <option>Fundamental</option><option>Teknikal</option><option>Umum</option><option>Obligasi</option><option>Reksa Dana</option>
            </select>
        </div>
        
        <div class="mt-5 pt-4 border-t border-gray-200 flex justify-end gap-2.5">
            <button class="btn btn-ghost" onclick="document.getElementById('modal-kamus').classList.remove('open')">Batal</button>
            <button class="btn btn-primary" onclick="alert('Istilah ditambahkan!'); document.getElementById('modal-kamus').classList.remove('open')">📖 Simpan</button>
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
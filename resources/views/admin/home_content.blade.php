@extends('layouts.admin')

@section('page-title', 'Home Content Editor')
@section('page-breadcrumb', 'Kelola Konten Landing Page')

@section('content')
<div class="section-header flex items-center justify-between mb-5 mt-2 gap-3 flex-wrap">
    <div>
        <div class="section-title text-lg font-bold text-gray-900">Home Content Editor</div>
        <div class="section-sub text-sm text-gray-500">Kelola konten hero section, ticker, dan statistik di landing page</div>
    </div>
    <button class="btn btn-primary btn-sm" onclick="alert('Perubahan berhasil disimpan!')">💾 Simpan Semua Perubahan</button>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-5 mb-5">
    <!-- Hero Section -->
    <div class="card p-6">
        <div class="font-bold text-base mb-4 text-gray-900">🦸 Hero Section</div>
        <div class="mb-3.5">
            <label class="block text-xs font-semibold text-gray-500 mb-1">Eyebrow / Tagline Kecil</label>
            <input class="inp" value="The Biggest Capital Market Community in SV IPB University" placeholder="Tagline kecil di atas judul">
        </div>
        <div class="mb-3.5">
            <label class="block text-xs font-semibold text-gray-500 mb-1">Judul Utama (H1)</label>
            <input class="inp" value="Kelompok Studi Pasar Modal SV IPB" placeholder="Judul utama hero">
        </div>
        <div class="mb-3.5">
            <label class="block text-xs font-semibold text-gray-500 mb-1">Deskripsi Hero</label>
            <textarea class="inp" style="min-height:100px">Explore in-depth market analysis, curated watchlist, and comprehensive market research with our dedicated team. Stay informed about the dynamic world of capital markets through our insightful content.</textarea>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div><label class="block text-xs font-semibold text-gray-500 mb-1">Tombol Utama (CTA 1)</label><input class="inp" value="Events →" placeholder="Teks tombol"></div>
            <div><label class="block text-xs font-semibold text-gray-500 mb-1">Tombol Sekunder (CTA 2)</label><input class="inp" value="Research →" placeholder="Teks tombol"></div>
        </div>
    </div>

    <!-- Hero Stats -->
    <div class="card p-6">
        <div class="font-bold text-base mb-4 text-gray-900">📊 Statistik Hero</div>
        <div class="grid grid-cols-2 gap-4 mb-3.5">
            <div><label class="block text-xs font-semibold text-gray-500 mb-1">Stat 1 — Angka</label><input class="inp" value="500+" placeholder="500+"></div>
            <div><label class="block text-xs font-semibold text-gray-500 mb-1">Stat 1 — Label</label><input class="inp" value="Anggota & Alumni" placeholder="Anggota & Alumni"></div>
        </div>
        <div class="grid grid-cols-2 gap-4 mb-3.5">
            <div><label class="block text-xs font-semibold text-gray-500 mb-1">Stat 2 — Angka</label><input class="inp" value="6" placeholder="6"></div>
            <div><label class="block text-xs font-semibold text-gray-500 mb-1">Stat 2 — Label</label><input class="inp" value="Divisi Aktif" placeholder="Divisi Aktif"></div>
        </div>
        <div class="grid grid-cols-2 gap-4 mb-3.5">
            <div><label class="block text-xs font-semibold text-gray-500 mb-1">Stat 3 — Angka</label><input class="inp" value="48+" placeholder="48+"></div>
            <div><label class="block text-xs font-semibold text-gray-500 mb-1">Stat 3 — Label</label><input class="inp" value="Laporan Riset" placeholder="Laporan Riset"></div>
        </div>
        <div class="grid grid-cols-2 gap-4 mb-3.5">
            <div><label class="block text-xs font-semibold text-gray-500 mb-1">Stat 4 — Angka</label><input class="inp" value="2019" placeholder="2019"></div>
            <div><label class="block text-xs font-semibold text-gray-500 mb-1">Stat 4 — Label</label><input class="inp" value="Berdiri" placeholder="Berdiri"></div>
        </div>
        <div class="mt-2">
            <div style="font-size:.75rem;color:var(--muted);background:var(--blue-pale);padding:10px;border-radius:8px">💡 Perubahan akan tampil di landing page saat pengunjung me-refresh halaman.</div>
        </div>
    </div>
</div>

<!-- Ticker Saham -->
<div class="card mb-5 p-6">
    <div class="section-header flex items-center justify-between mb-5 mt-2 gap-3 flex-wrap">
        <div>
            <div class="font-bold text-gray-900">📈 Ticker Live Market</div>
            <div class="text-[0.78rem] text-gray-500">Saham yang tampil di header ticker bar</div>
        </div>
        <button class="btn btn-primary btn-sm" onclick="document.getElementById('modal-ticker').classList.add('open')">+ Tambah Saham</button>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse text-sm">
            <thead>
                <tr class="text-gray-500 uppercase tracking-wider border-b border-gray-200 bg-gray-50">
                    <th class="px-4 py-3">Kode Saham</th>
                    <th class="px-4 py-3">Harga</th>
                    <th class="px-4 py-3">Perubahan (%)</th>
                    <th class="px-4 py-3">Tren</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b border-gray-50 hover:bg-blue-50 transition">
                    <td class="px-4 py-3"><span class="font-extrabold text-[0.9rem] text-blue-700">IHSG</span></td>
                    <td class="px-4 py-3 font-mono font-semibold">Rp 7.842</td>
                    <td class="px-4 py-3 font-mono font-bold text-green-600">+95.4 (+1.23%)</td>
                    <td class="px-4 py-3"><span class="bg-green-100 text-green-800 px-2.5 py-0.5 rounded-full text-[0.7rem] font-semibold">▲ Naik</span></td>
                    <td class="px-4 py-3"><span class="bg-green-100 text-green-800 px-2.5 py-0.5 rounded-full text-[0.7rem] font-semibold">Aktif</span></td>
                    <td class="px-4 py-3 text-right whitespace-nowrap">
                        <button class="btn btn-ghost btn-icon btn-sm text-blue-600">✏️</button>
                        <button class="btn btn-ghost btn-icon btn-sm text-red-500 ml-1">🗑️</button>
                    </td>
                </tr>
                <tr class="border-b border-gray-50 hover:bg-blue-50 transition">
                    <td class="px-4 py-3"><span class="font-extrabold text-[0.9rem] text-blue-700">BBCA</span></td>
                    <td class="px-4 py-3 font-mono font-semibold">Rp 9.725</td>
                    <td class="px-4 py-3 font-mono font-bold text-green-600">+75 (+0.78%)</td>
                    <td class="px-4 py-3"><span class="bg-green-100 text-green-800 px-2.5 py-0.5 rounded-full text-[0.7rem] font-semibold">▲ Naik</span></td>
                    <td class="px-4 py-3"><span class="bg-green-100 text-green-800 px-2.5 py-0.5 rounded-full text-[0.7rem] font-semibold">Aktif</span></td>
                    <td class="px-4 py-3 text-right whitespace-nowrap">
                        <button class="btn btn-ghost btn-icon btn-sm text-blue-600">✏️</button>
                        <button class="btn btn-ghost btn-icon btn-sm text-red-500 ml-1">🗑️</button>
                    </td>
                </tr>
                <tr class="border-b border-gray-50 hover:bg-blue-50 transition">
                    <td class="px-4 py-3"><span class="font-extrabold text-[0.9rem] text-blue-700">TLKM</span></td>
                    <td class="px-4 py-3 font-mono font-semibold">Rp 3.140</td>
                    <td class="px-4 py-3 font-mono font-bold text-red-600">-20 (-0.63%)</td>
                    <td class="px-4 py-3"><span class="bg-red-100 text-red-800 px-2.5 py-0.5 rounded-full text-[0.7rem] font-semibold">▼ Turun</span></td>
                    <td class="px-4 py-3"><span class="bg-green-100 text-green-800 px-2.5 py-0.5 rounded-full text-[0.7rem] font-semibold">Aktif</span></td>
                    <td class="px-4 py-3 text-right whitespace-nowrap">
                        <button class="btn btn-ghost btn-icon btn-sm text-blue-600">✏️</button>
                        <button class="btn btn-ghost btn-icon btn-sm text-red-500 ml-1">🗑️</button>
                    </td>
                </tr>
                <tr class="border-b border-gray-50 hover:bg-blue-50 transition">
                    <td class="px-4 py-3"><span class="font-extrabold text-[0.9rem] text-blue-700">GOTO</span></td>
                    <td class="px-4 py-3 font-mono font-semibold">Rp 84</td>
                    <td class="px-4 py-3 font-mono font-bold text-green-600">+3 (+3.70%)</td>
                    <td class="px-4 py-3"><span class="bg-green-100 text-green-800 px-2.5 py-0.5 rounded-full text-[0.7rem] font-semibold">▲ Naik</span></td>
                    <td class="px-4 py-3"><span class="bg-green-100 text-green-800 px-2.5 py-0.5 rounded-full text-[0.7rem] font-semibold">Aktif</span></td>
                    <td class="px-4 py-3 text-right whitespace-nowrap">
                        <button class="btn btn-ghost btn-icon btn-sm text-blue-600">✏️</button>
                        <button class="btn btn-ghost btn-icon btn-sm text-red-500 ml-1">🗑️</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Social Media Links -->
<div class="card mb-5 p-6">
    <div class="font-bold mb-4 text-gray-900">🔗 Social Media & Kontak</div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-3.5">
        <div><label class="block text-xs font-semibold text-gray-500 mb-1">📸 Instagram URL</label><input class="inp" value="https://instagram.com/kspmsvipb" placeholder="https://instagram.com/..."></div>
        <div><label class="block text-xs font-semibold text-gray-500 mb-1">💼 LinkedIn URL</label><input class="inp" value="https://linkedin.com/company/kspmsvipb" placeholder="https://linkedin.com/..."></div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-3.5">
        <div><label class="block text-xs font-semibold text-gray-500 mb-1">▶️ YouTube URL</label><input class="inp" value="https://youtube.com/@kspmsvipb" placeholder="https://youtube.com/..."></div>
        <div><label class="block text-xs font-semibold text-gray-500 mb-1">🎵 TikTok URL</label><input class="inp" value="https://tiktok.com/@kspmsvipb" placeholder="https://tiktok.com/..."></div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div><label class="block text-xs font-semibold text-gray-500 mb-1">📧 Email Kontak</label><input class="inp" value="info@kspmsvipb.ac.id" placeholder="email@..."></div>
        <div><label class="block text-xs font-semibold text-gray-500 mb-1">📱 WhatsApp/HP</label><input class="inp" value="081234567890" placeholder="08xxxxxxxxxx"></div>
    </div>
</div>

<!-- SEO & Meta -->
<div class="card p-6">
    <div class="font-bold mb-4 text-gray-900">🔍 SEO & Meta</div>
    <div class="mb-3.5"><label class="block text-xs font-semibold text-gray-500 mb-1">Judul Halaman (Title Tag)</label><input class="inp" value="KSPM SV IPB — Kelompok Studi Pasar Modal" placeholder="Judul tab browser"></div>
    <div><label class="block text-xs font-semibold text-gray-500 mb-1">Deskripsi Meta</label><textarea class="inp" rows="2">Kelompok Studi Pasar Modal Sekolah Vokasi IPB University. Komunitas investasi terbesar di SV IPB dengan 500+ anggota aktif.</textarea></div>
</div>

<!-- MODAL TAMBAH TICKER -->
<div class="modal-overlay fixed inset-0 bg-black/50 z-50 hidden items-center justify-center p-4" id="modal-ticker">
    <div class="modal bg-white rounded-2xl p-7 w-full max-w-sm relative">
        <div class="modal-header flex items-center justify-between mb-5 pb-3.5 border-b border-gray-200">
            <div class="modal-title text-base font-bold text-gray-900">Tambah Saham Ticker</div>
            <button class="w-8 h-8 rounded-lg bg-gray-100 text-gray-500 hover:bg-red-100 hover:text-red-500 transition flex items-center justify-center" onclick="document.getElementById('modal-ticker').classList.remove('open')">✕</button>
        </div>
        
        <div class="grid grid-cols-2 gap-4 mb-3.5">
            <div><label class="block text-xs font-semibold text-gray-500 mb-1">Kode Saham*</label><input class="inp uppercase" placeholder="BBCA"></div>
            <div><label class="block text-xs font-semibold text-gray-500 mb-1">Harga Saat Ini (Rp)</label><input type="number" class="inp" placeholder="9350"></div>
        </div>
        <div class="grid grid-cols-2 gap-4 mb-3.5">
            <div><label class="block text-xs font-semibold text-gray-500 mb-1">Perubahan (Rp)</label><input type="number" class="inp" placeholder="125" step="0.01"></div>
            <div><label class="block text-xs font-semibold text-gray-500 mb-1">Perubahan (%)</label><input type="number" class="inp" placeholder="1.36" step="0.01"></div>
        </div>
        <div class="grid grid-cols-2 gap-4 mb-3.5">
            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1">Tren</label>
                <select class="inp">
                    <option value="up">▲ Naik</option><option value="down">▼ Turun</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1">Status</label>
                <select class="inp">
                    <option>Aktif</option><option>Nonaktif</option>
                </select>
            </div>
        </div>
        <div class="mt-5 pt-4 border-t border-gray-200 flex justify-end gap-2.5">
            <button class="btn btn-ghost" onclick="document.getElementById('modal-ticker').classList.remove('open')">Batal</button>
            <button class="btn btn-primary" onclick="alert('Saham ditambahkan ke ticker!'); document.getElementById('modal-ticker').classList.remove('open')">💾 Simpan</button>
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
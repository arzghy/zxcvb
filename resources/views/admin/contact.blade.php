@extends('layouts.admin')

@section('page-title', 'Contact & Pesan Masuk')
@section('page-breadcrumb', 'Kelola Info Kontak & Pesan')

@section('content')
<div class="section-header flex items-center justify-between mb-5 mt-2 gap-3 flex-wrap">
    <div>
        <div class="section-title text-lg font-bold text-gray-900">Contact & Pesan Masuk</div>
        <div class="section-sub text-sm text-gray-500">Kelola info kontak organisasi dan baca pesan dari pengunjung website</div>
    </div>
    <div class="flex gap-2">
        <button class="btn btn-outline border-blue-600 text-blue-700 bg-white btn-sm" onclick="alert('File CSV akan didownload.')">📥 Export CSV</button>
        <button class="btn btn-primary btn-sm" onclick="alert('Informasi Kontak Berhasil Disimpan!')">💾 Simpan Info Kontak</button>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-5 mb-5">
    <!-- Info Kontak -->
    <div class="card p-6">
        <div class="font-bold text-base mb-4 text-gray-900">📋 Informasi Kontak Organisasi</div>
        
        <div class="mb-3.5">
            <label class="block text-xs font-semibold text-gray-500 mb-1">Email Utama</label>
            <input class="inp" value="info@kspmsvipb.ac.id" placeholder="email@domain.com">
        </div>
        <div class="mb-3.5">
            <label class="block text-xs font-semibold text-gray-500 mb-1">Nomor WhatsApp / HP</label>
            <input class="inp" value="081234567890" placeholder="08xxxxxxxxxx">
        </div>
        <div class="mb-3.5">
            <label class="block text-xs font-semibold text-gray-500 mb-1">Alamat / Lokasi</label>
            <textarea class="inp" rows="2">Kampus SV IPB University, Jl. Kumbang No. 14, Bogor, Jawa Barat 16151</textarea>
        </div>
        <div class="mb-3.5">
            <label class="block text-xs font-semibold text-gray-500 mb-1">Google Maps Embed URL</label>
            <input class="inp" placeholder="https://www.google.com/maps/embed?...">
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-3.5">
            <div><label class="block text-xs font-semibold text-gray-500 mb-1">📸 Instagram</label><input class="inp" value="@kspmsvipb" placeholder="@username"></div>
            <div><label class="block text-xs font-semibold text-gray-500 mb-1">💼 LinkedIn</label><input class="inp" value="KSPM SV IPB" placeholder="Nama halaman"></div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div><label class="block text-xs font-semibold text-gray-500 mb-1">▶️ YouTube</label><input class="inp" value="@kspmsvipb" placeholder="@channel"></div>
            <div><label class="block text-xs font-semibold text-gray-500 mb-1">🎵 TikTok</label><input class="inp" value="@kspmsvipb" placeholder="@username"></div>
        </div>
    </div>
    
    <!-- Statistik Pesan -->
    <div class="card p-6">
        <div class="font-bold text-base mb-4 text-gray-900">📊 Statistik Pesan Masuk</div>
        <div class="grid grid-cols-2 gap-3 mb-5">
            <div class="stat-card text-center !p-3">
                <div class="text-[0.65rem] text-gray-500 mb-1 font-bold">TOTAL PESAN</div>
                <div class="mono text-2xl font-extrabold text-blue-600">3</div>
            </div>
            <div class="stat-card text-center !p-3">
                <div class="text-[0.65rem] text-gray-500 mb-1 font-bold">BELUM DIBACA</div>
                <div class="mono text-2xl font-extrabold text-red-500">2</div>
            </div>
            <div class="stat-card text-center !p-3">
                <div class="text-[0.65rem] text-gray-500 mb-1 font-bold">SUDAH DIBALAS</div>
                <div class="mono text-2xl font-extrabold text-emerald-500">1</div>
            </div>
            <div class="stat-card text-center !p-3">
                <div class="text-[0.65rem] text-gray-500 mb-1 font-bold">BULAN INI</div>
                <div class="mono text-2xl font-extrabold text-sky-500">3</div>
            </div>
        </div>
        <div class="font-semibold text-[0.9rem] mb-3 text-gray-900">Jenis Pertanyaan Terbanyak</div>
        <div class="flex flex-col gap-2">
            <div class="flex justify-between items-center text-[0.82rem] py-1 border-b border-gray-100">
                <span>Informasi Rekrutmen</span>
                <span class="bg-blue-100 text-blue-800 px-2.5 py-0.5 rounded-full text-xs font-semibold">40%</span>
            </div>
            <div class="flex justify-between items-center text-[0.82rem] py-1 border-b border-gray-100">
                <span>Pertanyaan Event</span>
                <span class="bg-amber-100 text-amber-800 px-2.5 py-0.5 rounded-full text-xs font-semibold">28%</span>
            </div>
            <div class="flex justify-between items-center text-[0.82rem] py-1 border-b border-gray-100">
                <span>Kolaborasi/Sponsor</span>
                <span class="bg-purple-100 text-purple-800 px-2.5 py-0.5 rounded-full text-xs font-semibold">20%</span>
            </div>
            <div class="flex justify-between items-center text-[0.82rem] py-1">
                <span>Lainnya</span>
                <span class="bg-gray-100 text-gray-600 px-2.5 py-0.5 rounded-full text-xs font-semibold">12%</span>
            </div>
        </div>
    </div>
</div>

<!-- Tabel Pesan Masuk -->
<div class="card overflow-hidden">
    <div class="p-4 border-b border-gray-200 flex items-center justify-between flex-wrap gap-3">
        <div class="font-bold text-gray-900">📬 Pesan Masuk dari Website</div>
        <div class="flex gap-2 flex-wrap">
            <div class="search-bar relative">
                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm">🔍</span>
                <input class="inp inp-sm pl-9" placeholder="Cari pesan...">
            </div>
            <select class="inp inp-sm" style="width:auto">
                <option value="">Semua Status</option>
                <option>Belum Dibaca</option>
                <option>Sudah Dibaca</option>
                <option>Sudah Dibalas</option>
                <option>Arsip</option>
            </select>
            <button class="btn btn-ghost border-gray-300 text-gray-600 bg-white btn-sm" onclick="alert('Semua pesan ditandai telah dibaca.')">✅ Tandai Semua Dibaca</button>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse text-sm">
            <thead>
                <tr class="text-gray-500 uppercase tracking-wider border-b border-gray-200 bg-gray-50">
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Nama Pengirim</th>
                    <th class="px-4 py-3">Subjek / Topik</th>
                    <th class="px-4 py-3">Pesan</th>
                    <th class="px-4 py-3">Waktu</th>
                    <th class="px-4 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- Pesan 1 (Belum Dibaca) -->
                <tr class="border-b border-gray-50 bg-red-50/40 hover:bg-red-50 transition">
                    <td class="px-4 py-3"><span class="bg-red-100 text-red-800 px-2.5 py-0.5 rounded-full text-[0.65rem] font-semibold">🔴 Belum Dibaca</span></td>
                    <td class="px-4 py-3">
                        <div class="font-bold text-gray-900 text-[0.85rem]">Ahmad Fauzi</div>
                        <div class="text-[0.8rem] text-gray-500">ahmad.fauzi@gmail.com</div>
                    </td>
                    <td class="px-4 py-3 font-semibold text-[0.85rem] text-gray-900 max-w-[160px] truncate">Informasi Open Recruitment</td>
                    <td class="px-4 py-3 text-[0.78rem] text-gray-500 max-w-[200px] truncate">Halo KSPM, saya mahasiswa SV IPB angkatan 2025. Kapan jadwal open re...</td>
                    <td class="px-4 py-3 text-[0.75rem] text-gray-500 whitespace-nowrap">2025-04-18 09:14</td>
                    <td class="px-4 py-3 text-right whitespace-nowrap">
                        <button class="btn btn-primary btn-icon btn-sm text-[0.7rem] px-2.5 py-1" onclick="document.getElementById('modal-pesan').classList.add('open')">👁 Lihat</button>
                        <button class="btn btn-ghost btn-icon btn-sm text-red-500 ml-1">🗑️</button>
                    </td>
                </tr>

                <!-- Pesan 2 (Belum Dibaca) -->
                <tr class="border-b border-gray-50 bg-red-50/40 hover:bg-red-50 transition">
                    <td class="px-4 py-3"><span class="bg-red-100 text-red-800 px-2.5 py-0.5 rounded-full text-[0.65rem] font-semibold">🔴 Belum Dibaca</span></td>
                    <td class="px-4 py-3">
                        <div class="font-bold text-gray-900 text-[0.85rem]">Dewi Lestari</div>
                        <div class="text-[0.8rem] text-gray-500">dewilestari22@gmail.com</div>
                    </td>
                    <td class="px-4 py-3 font-semibold text-[0.85rem] text-gray-900 max-w-[160px] truncate">Tanya-tanya tentang Investalk</td>
                    <td class="px-4 py-3 text-[0.78rem] text-gray-500 max-w-[200px] truncate">Hai! Investalk KSPM itu terbuka untuk umum atau khusus anggota saja?...</td>
                    <td class="px-4 py-3 text-[0.75rem] text-gray-500 whitespace-nowrap">2025-04-15 08:47</td>
                    <td class="px-4 py-3 text-right whitespace-nowrap">
                        <button class="btn btn-primary btn-icon btn-sm text-[0.7rem] px-2.5 py-1" onclick="document.getElementById('modal-pesan').classList.add('open')">👁 Lihat</button>
                        <button class="btn btn-ghost btn-icon btn-sm text-red-500 ml-1">🗑️</button>
                    </td>
                </tr>

                <!-- Pesan 3 (Sudah Dibalas) -->
                <tr class="border-b border-gray-50 hover:bg-blue-50 transition">
                    <td class="px-4 py-3"><span class="bg-green-100 text-green-800 px-2.5 py-0.5 rounded-full text-[0.65rem] font-semibold">Sudah Dibalas</span></td>
                    <td class="px-4 py-3">
                        <div class="font-medium text-gray-900 text-[0.85rem]">Reza Pratama</div>
                        <div class="text-[0.8rem] text-gray-500">reza.pratama@gmail.com</div>
                    </td>
                    <td class="px-4 py-3 font-semibold text-[0.85rem] text-gray-900 max-w-[160px] truncate">Sponsor Acara KSPM</td>
                    <td class="px-4 py-3 text-[0.78rem] text-gray-500 max-w-[200px] truncate">Perkenalkan saya Reza dari PT Investasi Maju. Perusahaan kami tetari...</td>
                    <td class="px-4 py-3 text-[0.75rem] text-gray-500 whitespace-nowrap">2025-04-14 16:20</td>
                    <td class="px-4 py-3 text-right whitespace-nowrap">
                        <button class="btn btn-primary btn-icon btn-sm text-[0.7rem] px-2.5 py-1" onclick="document.getElementById('modal-pesan').classList.add('open')">👁 Lihat</button>
                        <button class="btn btn-ghost btn-icon btn-sm text-red-500 ml-1">🗑️</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- MODAL LIHAT PESAN -->
<div class="modal-overlay fixed inset-0 bg-black/50 z-50 hidden items-center justify-center p-4" id="modal-pesan">
    <div class="modal bg-white rounded-2xl p-7 w-full max-w-2xl max-h-[90vh] overflow-y-auto relative">
        <div class="modal-header flex items-center justify-between mb-5 pb-3.5 border-b border-gray-200">
            <div class="modal-title text-base font-bold text-gray-900">Informasi Open Recruitment</div>
            <button class="w-8 h-8 rounded-lg bg-gray-100 text-gray-500 hover:bg-red-100 hover:text-red-500 transition flex items-center justify-center" onclick="document.getElementById('modal-pesan').classList.remove('open')">✕</button>
        </div>
        
        <div class="bg-blue-50 rounded-xl p-4 mb-4">
            <div class="flex gap-5 flex-wrap">
                <div>
                    <div class="text-[0.68rem] font-bold text-gray-500 uppercase mb-1">Pengirim</div>
                    <div class="text-[0.88rem] font-bold text-blue-700">Ahmad Fauzi</div>
                </div>
                <div>
                    <div class="text-[0.68rem] font-bold text-gray-500 uppercase mb-1">Email</div>
                    <div class="text-[0.88rem]"><a href="#" class="text-blue-600 hover:underline">ahmad.fauzi@gmail.com</a></div>
                </div>
                <div>
                    <div class="text-[0.68rem] font-bold text-gray-500 uppercase mb-1">Waktu</div>
                    <div class="text-[0.85rem]">2025-04-18 09:14</div>
                </div>
                <div>
                    <div class="text-[0.68rem] font-bold text-gray-500 uppercase mb-1">Status</div>
                    <div><span class="bg-red-100 text-red-800 px-2.5 py-0.5 rounded-full text-[0.65rem] font-semibold">Belum Dibaca</span></div>
                </div>
            </div>
        </div>
        
        <div class="mb-4">
            <label class="block text-xs font-semibold text-gray-500 mb-1">Isi Pesan</label>
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 text-[0.9rem] leading-relaxed text-gray-800 min-h-[80px]">
                Halo KSPM, saya mahasiswa SV IPB angkatan 2025. Kapan jadwal open recruitment dibuka? Saya sangat tertarik untuk bergabung terutama di divisi Analyze Trading. Terima kasih.
            </div>
        </div>
        
        <div>
            <label class="block text-xs font-semibold text-gray-500 mb-1">Balasan / Catatan Admin</label>
            <textarea class="inp" rows="3" placeholder="Tulis balasan yang dikirim via email atau sekadar catatan admin..."></textarea>
        </div>
        
        <div class="mt-5 pt-4 border-t border-gray-200 flex justify-end gap-2.5">
            <button class="btn btn-ghost" onclick="document.getElementById('modal-pesan').classList.remove('open')">Tutup</button>
            <button class="btn btn-warn bg-amber-500 hover:bg-amber-600 text-white btn-sm" onclick="alert('Pesan diarsipkan!'); document.getElementById('modal-pesan').classList.remove('open')">📁 Arsipkan</button>
            <button class="btn btn-primary" onclick="alert('Pesan ditandai sudah dibalas!'); document.getElementById('modal-pesan').classList.remove('open')">✉️ Tandai Sudah Dibalas</button>
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
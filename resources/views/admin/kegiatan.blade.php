@extends('layouts.admin')

@section('page-title', 'Kegiatan & Event')
@section('page-breadcrumb', 'Kelola Agenda')

@section('content')
<div class="section-header flex items-center justify-between mb-5 mt-2 gap-3 flex-wrap">
    <div>
        <div class="section-title text-lg font-bold text-gray-900">Kegiatan & Event</div>
        <div class="section-sub text-sm text-gray-500">Kelola semua agenda KSPM</div>
    </div>
    <div class="flex gap-2 flex-wrap">
        <div class="search-bar relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm">🔍</span>
            <input class="inp inp-sm pl-9" placeholder="Cari kegiatan...">
        </div>
        <select class="inp inp-sm" style="width:auto">
            <option value="">Semua Tipe</option>
            <option>Seminar</option>
            <option>Workshop</option>
            <option>Lomba</option>
            <option>Rapat</option>
            <option>Webinar</option>
        </select>
        <button class="btn btn-primary btn-sm" onclick="document.getElementById('modal-kegiatan').classList.add('open')">+ Tambah Kegiatan</button>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-5 mb-5">
    <!-- Calendar UI -->
    <div class="card p-5">
        <div class="flex items-center justify-between mb-4">
            <button class="btn btn-ghost btn-icon btn-sm">◀</button>
            <div class="font-bold text-[0.95rem]">Maret 2026</div>
            <button class="btn btn-ghost btn-icon btn-sm">▶</button>
        </div>
        <div class="grid grid-cols-7 gap-1 text-center mb-1">
            <div class="text-[0.68rem] font-bold text-gray-500 uppercase py-1">Min</div>
            <div class="text-[0.68rem] font-bold text-gray-500 uppercase py-1">Sen</div>
            <div class="text-[0.68rem] font-bold text-gray-500 uppercase py-1">Sel</div>
            <div class="text-[0.68rem] font-bold text-gray-500 uppercase py-1">Rab</div>
            <div class="text-[0.68rem] font-bold text-gray-500 uppercase py-1">Kam</div>
            <div class="text-[0.68rem] font-bold text-gray-500 uppercase py-1">Jum</div>
            <div class="text-[0.68rem] font-bold text-gray-500 uppercase py-1">Sab</div>
        </div>
        <div class="grid grid-cols-7 gap-1 text-center">
            <!-- Offset Hari Pertama Bulan -->
            <div></div><div></div><div></div><div></div><div></div>
            <!-- Tanggal Kalender Sesuai Desain JS -->
            <div class="aspect-square flex flex-col items-center justify-center rounded-lg text-sm hover:bg-blue-50 cursor-pointer transition">1</div>
            <div class="aspect-square flex flex-col items-center justify-center rounded-lg text-sm hover:bg-blue-50 cursor-pointer transition">2</div>
            <div class="aspect-square flex flex-col items-center justify-center rounded-lg text-sm hover:bg-blue-50 cursor-pointer transition relative">
                3
            </div>
            <div class="aspect-square flex flex-col items-center justify-center rounded-lg text-sm bg-blue-600 text-white font-bold cursor-pointer transition relative">
                4 <!-- Today Marker (Sesuai Konteks 4 Mei, kita simulasikan visualisasinya) -->
            </div>
            <div class="aspect-square flex flex-col items-center justify-center rounded-lg text-sm hover:bg-blue-50 cursor-pointer transition relative">
                5 <div class="absolute bottom-1 w-1 h-1 bg-sky-500 rounded-full"></div> <!-- Event Marker -->
            </div>
            <div class="aspect-square flex flex-col items-center justify-center rounded-lg text-sm hover:bg-blue-50 cursor-pointer transition">6</div>
            <div class="aspect-square flex flex-col items-center justify-center rounded-lg text-sm hover:bg-blue-50 cursor-pointer transition">7</div>
            <div class="aspect-square flex flex-col items-center justify-center rounded-lg text-sm hover:bg-blue-50 cursor-pointer transition">8</div>
            <div class="aspect-square flex flex-col items-center justify-center rounded-lg text-sm hover:bg-blue-50 cursor-pointer transition">9</div>
            <div class="aspect-square flex flex-col items-center justify-center rounded-lg text-sm hover:bg-blue-50 cursor-pointer transition relative">
                10 <div class="absolute bottom-1 w-1 h-1 bg-sky-500 rounded-full"></div> <!-- Event Marker -->
            </div>
            <div class="aspect-square flex flex-col items-center justify-center rounded-lg text-sm hover:bg-blue-50 cursor-pointer transition">11</div>
            <div class="aspect-square flex flex-col items-center justify-center rounded-lg text-sm hover:bg-blue-50 cursor-pointer transition">12</div>
            <div class="aspect-square flex flex-col items-center justify-center rounded-lg text-sm hover:bg-blue-50 cursor-pointer transition">13</div>
            <div class="aspect-square flex flex-col items-center justify-center rounded-lg text-sm hover:bg-blue-50 cursor-pointer transition">14</div>
            <div class="aspect-square flex flex-col items-center justify-center rounded-lg text-sm hover:bg-blue-50 cursor-pointer transition relative">
                15 <div class="absolute bottom-1 w-1 h-1 bg-sky-500 rounded-full"></div> <!-- Event Marker -->
            </div>
            <div class="aspect-square flex flex-col items-center justify-center rounded-lg text-sm hover:bg-blue-50 cursor-pointer transition">16</div>
            <div class="aspect-square flex flex-col items-center justify-center rounded-lg text-sm hover:bg-blue-50 cursor-pointer transition">17</div>
            <div class="aspect-square flex flex-col items-center justify-center rounded-lg text-sm hover:bg-blue-50 cursor-pointer transition">18</div>
            <div class="aspect-square flex flex-col items-center justify-center rounded-lg text-sm hover:bg-blue-50 cursor-pointer transition">19</div>
            <div class="aspect-square flex flex-col items-center justify-center rounded-lg text-sm hover:bg-blue-50 cursor-pointer transition">20</div>
            <div class="aspect-square flex flex-col items-center justify-center rounded-lg text-sm hover:bg-blue-50 cursor-pointer transition">21</div>
            <div class="aspect-square flex flex-col items-center justify-center rounded-lg text-sm hover:bg-blue-50 cursor-pointer transition relative">
                22 <div class="absolute bottom-1 w-1 h-1 bg-sky-500 rounded-full"></div> <!-- Event Marker -->
            </div>
            <div class="aspect-square flex flex-col items-center justify-center rounded-lg text-sm hover:bg-blue-50 cursor-pointer transition">23</div>
            <div class="aspect-square flex flex-col items-center justify-center rounded-lg text-sm hover:bg-blue-50 cursor-pointer transition">24</div>
            <div class="aspect-square flex flex-col items-center justify-center rounded-lg text-sm hover:bg-blue-50 cursor-pointer transition">25</div>
            <div class="aspect-square flex flex-col items-center justify-center rounded-lg text-sm hover:bg-blue-50 cursor-pointer transition">26</div>
            <div class="aspect-square flex flex-col items-center justify-center rounded-lg text-sm hover:bg-blue-50 cursor-pointer transition">27</div>
            <div class="aspect-square flex flex-col items-center justify-center rounded-lg text-sm hover:bg-blue-50 cursor-pointer transition">28</div>
            <div class="aspect-square flex flex-col items-center justify-center rounded-lg text-sm hover:bg-blue-50 cursor-pointer transition">29</div>
            <div class="aspect-square flex flex-col items-center justify-center rounded-lg text-sm hover:bg-blue-50 cursor-pointer transition">30</div>
            <div class="aspect-square flex flex-col items-center justify-center rounded-lg text-sm hover:bg-blue-50 cursor-pointer transition">31</div>
        </div>
    </div>

    <!-- Upcoming Events List -->
    <div class="card p-5">
        <div class="font-bold mb-3.5 text-gray-900">Kegiatan Mendatang</div>
        <div class="flex flex-col gap-2.5">
            <!-- Kegiatan 1 -->
            <div class="flex gap-3 p-2.5 rounded-xl border border-gray-200 hover:border-blue-500 transition">
                <div class="text-center w-10 shrink-0 border-r border-gray-100 pr-2">
                    <div class="font-mono font-extrabold text-blue-600 text-lg">15</div>
                    <div class="text-[0.65rem] text-gray-500">Mar</div>
                </div>
                <div>
                    <div class="text-[0.85rem] font-semibold text-gray-900">Sekolah Pasar Modal Batch 2</div>
                    <div class="text-[0.72rem] text-gray-500 mt-0.5">09:00 · Auditorium SV IPB</div>
                </div>
            </div>
            <!-- Kegiatan 2 -->
            <div class="flex gap-3 p-2.5 rounded-xl border border-gray-200 hover:border-blue-500 transition">
                <div class="text-center w-10 shrink-0 border-r border-gray-100 pr-2">
                    <div class="font-mono font-extrabold text-blue-600 text-lg">22</div>
                    <div class="text-[0.65rem] text-gray-500">Mar</div>
                </div>
                <div>
                    <div class="text-[0.85rem] font-semibold text-gray-900">Workshop Analisis Fundamental</div>
                    <div class="text-[0.72rem] text-gray-500 mt-0.5">13:00 · Online (Zoom)</div>
                </div>
            </div>
            <!-- Kegiatan 3 -->
            <div class="flex gap-3 p-2.5 rounded-xl border border-gray-200 hover:border-blue-500 transition">
                <div class="text-center w-10 shrink-0 border-r border-gray-100 pr-2">
                    <div class="font-mono font-extrabold text-blue-600 text-lg">10</div>
                    <div class="text-[0.65rem] text-gray-500">Apr</div>
                </div>
                <div>
                    <div class="text-[0.85rem] font-semibold text-gray-900">Sharing Session: IPO Season</div>
                    <div class="text-[0.72rem] text-gray-500 mt-0.5">14:00 · Ruang 301 SV IPB</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse text-sm">
            <thead>
                <tr class="text-gray-500 uppercase tracking-wider border-b border-gray-200 bg-gray-50">
                    <th class="px-4 py-3">Kegiatan</th>
                    <th class="px-4 py-3">Tipe</th>
                    <th class="px-4 py-3">Tanggal</th>
                    <th class="px-4 py-3">Waktu</th>
                    <th class="px-4 py-3">Tempat</th>
                    <th class="px-4 py-3">PIC</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- Kegiatan Row 1 -->
                <tr class="border-b border-gray-50 hover:bg-blue-50 transition">
                    <td class="px-4 py-3">
                        <div class="font-semibold text-gray-900">Sekolah Pasar Modal Batch 2</div>
                        <div class="text-[0.72rem] text-gray-500">SPM untuk anggota baru angkatan 2024...</div>
                    </td>
                    <td class="px-4 py-3"><span class="bg-purple-100 text-purple-800 px-2.5 py-0.5 rounded-full text-[0.7rem] font-semibold">Seminar</span></td>
                    <td class="px-4 py-3 font-mono text-[0.8rem]">2025-03-15</td>
                    <td class="px-4 py-3 text-[0.8rem]">09:00–12:00</td>
                    <td class="px-4 py-3 text-[0.82rem]">Auditorium SV IPB</td>
                    <td class="px-4 py-3 text-[0.82rem]">Sari Dewi</td>
                    <td class="px-4 py-3"><span class="bg-blue-100 text-blue-800 px-2.5 py-0.5 rounded-full text-[0.7rem] font-semibold">Upcoming</span></td>
                    <td class="px-4 py-3 text-right">
                        <button class="btn btn-ghost btn-icon btn-sm text-blue-600">✏️</button>
                        <button class="btn btn-ghost btn-icon btn-sm text-red-500 ml-1">🗑️</button>
                    </td>
                </tr>
                <!-- Kegiatan Row 2 -->
                <tr class="border-b border-gray-50 hover:bg-blue-50 transition">
                    <td class="px-4 py-3">
                        <div class="font-semibold text-gray-900">Workshop Analisis Fundamental</div>
                        <div class="text-[0.72rem] text-gray-500">Workshop analisis fundamental saham...</div>
                    </td>
                    <td class="px-4 py-3"><span class="bg-cyan-100 text-cyan-800 px-2.5 py-0.5 rounded-full text-[0.7rem] font-semibold">Workshop</span></td>
                    <td class="px-4 py-3 font-mono text-[0.8rem]">2025-03-22</td>
                    <td class="px-4 py-3 text-[0.8rem]">13:00–15:00</td>
                    <td class="px-4 py-3 text-[0.82rem]">Online (Zoom)</td>
                    <td class="px-4 py-3 text-[0.82rem]">Andi Prasetyo</td>
                    <td class="px-4 py-3"><span class="bg-blue-100 text-blue-800 px-2.5 py-0.5 rounded-full text-[0.7rem] font-semibold">Upcoming</span></td>
                    <td class="px-4 py-3 text-right">
                        <button class="btn btn-ghost btn-icon btn-sm text-blue-600">✏️</button>
                        <button class="btn btn-ghost btn-icon btn-sm text-red-500 ml-1">🗑️</button>
                    </td>
                </tr>
                <!-- Kegiatan Row 3 -->
                <tr class="border-b border-gray-50 hover:bg-blue-50 transition">
                    <td class="px-4 py-3">
                        <div class="font-semibold text-gray-900">Rapat Bulanan Pengurus</div>
                        <div class="text-[0.72rem] text-gray-500">Evaluasi program kerja bulan Februari...</div>
                    </td>
                    <td class="px-4 py-3"><span class="bg-gray-100 text-gray-800 px-2.5 py-0.5 rounded-full text-[0.7rem] font-semibold">Rapat</span></td>
                    <td class="px-4 py-3 font-mono text-[0.8rem]">2025-03-05</td>
                    <td class="px-4 py-3 text-[0.8rem]">16:00–18:00</td>
                    <td class="px-4 py-3 text-[0.82rem]">Ruang 201 SV IPB</td>
                    <td class="px-4 py-3 text-[0.82rem]">Rizky Firmansyah</td>
                    <td class="px-4 py-3"><span class="bg-gray-100 text-gray-600 px-2.5 py-0.5 rounded-full text-[0.7rem] font-semibold">Selesai</span></td>
                    <td class="px-4 py-3 text-right">
                        <button class="btn btn-ghost btn-icon btn-sm text-blue-600">✏️</button>
                        <button class="btn btn-ghost btn-icon btn-sm text-red-500 ml-1">🗑️</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- MODAL TAMBAH KEGIATAN -->
<div class="modal-overlay fixed inset-0 bg-black/50 z-50 hidden items-center justify-center p-4" id="modal-kegiatan">
    <div class="modal bg-white rounded-2xl p-7 w-full max-w-2xl max-h-[90vh] overflow-y-auto relative">
        <div class="modal-header flex items-center justify-between mb-5 pb-3.5 border-b border-gray-200">
            <div class="modal-title text-base font-bold text-gray-900">Tambah Kegiatan</div>
            <button class="w-8 h-8 rounded-lg bg-gray-100 text-gray-500 hover:bg-red-100 hover:text-red-500 transition flex items-center justify-center" onclick="document.getElementById('modal-kegiatan').classList.remove('open')">✕</button>
        </div>
        
        <div class="mb-3.5">
            <label class="block text-xs font-semibold text-gray-500 mb-1">Nama Kegiatan*</label>
            <input class="inp" placeholder="Nama kegiatan">
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-3.5">
            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1">Tipe*</label>
                <select class="inp">
                    <option>Seminar</option><option>Workshop</option><option>Lomba</option><option>Rapat</option><option>Webinar</option><option>Diskusi</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1">Tanggal*</label>
                <input type="date" class="inp">
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-3.5">
            <div><label class="block text-xs font-semibold text-gray-500 mb-1">Waktu Mulai</label><input type="time" class="inp"></div>
            <div><label class="block text-xs font-semibold text-gray-500 mb-1">Waktu Selesai</label><input type="time" class="inp"></div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-3.5">
            <div><label class="block text-xs font-semibold text-gray-500 mb-1">Tempat</label><input class="inp" placeholder="Lokasi / Link Zoom"></div>
            <div><label class="block text-xs font-semibold text-gray-500 mb-1">PIC / Penanggungjawab</label><input class="inp" placeholder="Nama PIC"></div>
        </div>
        <div class="mb-3.5">
            <label class="block text-xs font-semibold text-gray-500 mb-1">Deskripsi</label>
            <textarea class="inp" placeholder="Deskripsi singkat kegiatan..." rows="3"></textarea>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-3.5">
            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1">Status</label>
                <select class="inp">
                    <option>Upcoming</option><option>Berlangsung</option><option>Selesai</option><option>Dibatalkan</option>
                </select>
            </div>
            <div><label class="block text-xs font-semibold text-gray-500 mb-1">Kuota Peserta</label><input type="number" class="inp" placeholder="50"></div>
        </div>
        <div class="mt-5 pt-4 border-t border-gray-200 flex justify-end gap-2.5">
            <button class="btn btn-ghost" onclick="document.getElementById('modal-kegiatan').classList.remove('open')">Batal</button>
            <button class="btn btn-primary" onclick="alert('Kegiatan disimpan!'); document.getElementById('modal-kegiatan').classList.remove('open')">💾 Simpan</button>
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
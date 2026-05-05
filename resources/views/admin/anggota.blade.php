@extends('layouts.admin')

@section('content')
<!-- Membungkus seluruh area content dengan background abu-abu kebiruan khas desain -->
<div class="bg-[#f4f7fb] min-h-screen -m-6 p-6">
    <!-- 2. CONTENT HEADER & FILTER TABLE -->
    <div class="flex flex-col md:flex-row justify-between items-end mb-6">
        <div>
            <h2 class="text-[22px] font-bold text-gray-900">Manajemen Anggota</h2>
            <p class="text-[15px] text-gray-500 mt-1">Total {{ number_format($totalAnggota ?? 8) }} anggota terdaftar, menampilkan {{ count($anggotas ?? [1,2,3,4,5,6,7,8]) }}</p>
        </div>
        
        <div class="flex items-center gap-3 mt-4 md:mt-0">
            <!-- Search Bar Tabel -->
            <form action="{{ Route::has('admin.anggota.index') ? route('admin.anggota.index') : '#' }}" method="GET" class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </span>
                <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari anggota..." class="py-2 pl-10 pr-4 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500 w-56 bg-white">
            </form>

            <!-- Dropdown Divisi -->
            <div class="relative">
                <select name="divisi" class="appearance-none py-2 pl-4 pr-10 rounded-xl border border-gray-200 text-sm text-gray-700 bg-white focus:outline-none focus:ring-1 focus:ring-blue-500 cursor-pointer">
                    <option value="">Semua Divisi</option>
                    <option value="administration">Administration</option>
                    <option value="education">Education</option>
                    <option value="media_creative">Media Creative</option>
                    <option value="public_relation">Public Relation</option>
                    <option value="investment_gallery">Investment Gallery</option>
                    <option value="analyze_trading">Analyze Trading</option>
                </select>
                <span class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </span>
            </div>

            <!-- Tombol Tambah Tabel -->
            <button onclick="openModal('addMemberModal')" class="bg-[#1e3a8a] hover:bg-blue-800 text-white px-5 py-2 rounded-xl text-sm font-semibold transition-colors flex items-center gap-1.5 shadow-sm">
                <span>+</span> Tambah
            </button>
        </div>
    </div>

    <!-- 3. TABLE SECTION -->
    <div class="bg-white rounded-[20px] border border-gray-200 overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="border-b border-gray-200 bg-white">
                    <tr>
                        <th class="px-6 py-4 text-[12px] font-bold text-gray-500 uppercase tracking-widest">NAMA</th>
                        <th class="px-6 py-4 text-[12px] font-bold text-gray-500 uppercase tracking-widest">NIM</th>
                        <th class="px-6 py-4 text-[12px] font-bold text-gray-500 uppercase tracking-widest">DIVISI</th>
                        <th class="px-6 py-4 text-[12px] font-bold text-gray-500 uppercase tracking-widest">ANGKATAN</th>
                        <th class="px-6 py-4 text-[12px] font-bold text-gray-500 uppercase tracking-widest">STATUS</th>
                        <th class="px-6 py-4 text-[12px] font-bold text-gray-500 uppercase tracking-widest">KONTAK</th>
                        <th class="px-6 py-4 text-[12px] font-bold text-gray-500 uppercase tracking-widest text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    
                    {{-- Simulasi Looping Data --}}
                    @php
                        $dummyData = [
                            ['name' => 'Andi Prasetyo', 'jabatan' => 'Koordinator', 'nim' => 'J0401211001', 'divisi' => 'Analyze Trading', 'angkatan' => '2021', 'status' => 'Aktif', 'kontak' => '085612341234', 'email' => 'andi@apps.ipb.ac.id'],
                        ];
                        $iterableData = isset($anggotas) && count($anggotas) > 0 ? $anggotas : $dummyData;
                    @endphp

                    @foreach($iterableData as $anggota)
                    @php
                        // Parsing Data
                        $isObject = is_object($anggota);
                        $id = $isObject ? ($anggota->id ?? 0) : $loop->iteration;
                        $nama = $isObject ? ($anggota->name ?? 'User') : $anggota['name'];
                        $jabatan = $isObject ? ($anggota->jabatan ?? 'Anggota') : $anggota['jabatan'];
                        $nim = $isObject ? ($anggota->nim ?? '-') : $anggota['nim'];
                        $divisiStr = $isObject ? ($anggota->divisi ?? 'General') : $anggota['divisi'];
                        $angkatan = $isObject ? ($anggota->angkatan ?? '-') : $anggota['angkatan'];
                        $statusStr = $isObject ? ($anggota->status ?? 'Aktif') : $anggota['status'];
                        $kontak = $isObject ? ($anggota->whatsapp ?? $anggota->kontak ?? '-') : $anggota['kontak'];
                        $email = $isObject ? ($anggota->email ?? '') : ($anggota['email'] ?? '');

                        // Format Display (Merubah underscore jadi spasi & huruf awal kapital)
                        $jabatanDisplay = ucwords(str_replace('_', ' ', $jabatan));
                        $divisiDisplay = ucwords(str_replace('_', ' ', $divisiStr));
                        $statusDisplay = ucwords(str_replace('_', ' ', $statusStr));

                        // Prepare data for Modals (Tetap gunakan raw data yang ada underscore-nya agar dropdown berfungsi)
                        $rawDivisi = strtolower(str_replace(' ', '_', $divisiStr));
                        $rawStatus = strtolower(str_replace(' ', '_', $statusStr));
                        $rawJabatan = strtolower($jabatan);

                        // Generate Initial
                        $words = explode(' ', $nama);
                        $initial = isset($words[1]) ? strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1)) : strtoupper(substr($words[0], 0, 2));

                        // Warna Divisi Badges
                        $div = strtolower($divisiStr);
                        $divBg = 'bg-gray-100'; $divText = 'text-gray-700';
                        if(str_contains($div, 'trading')) { $divBg = 'bg-blue-100'; $divText = 'text-[#1e3a8a]'; }
                        elseif(str_contains($div, 'education')) { $divBg = 'bg-[#d1fae5]'; $divText = 'text-emerald-700'; }
                        elseif(str_contains($div, 'media') || str_contains($div, 'creative')) { $divBg = 'bg-purple-100'; $divText = 'text-purple-700'; }
                        elseif(str_contains($div, 'public') || str_contains($div, 'relation')) { $divBg = 'bg-[#fef08a]'; $divText = 'text-yellow-800'; }
                        elseif(str_contains($div, 'investment') || str_contains($div, 'gallery')) { $divBg = 'bg-[#cffafe]'; $divText = 'text-cyan-800'; }

                        // Warna Status Badges
                        $stat = strtolower($statusStr);
                        $statBg = 'bg-[#d1fae5]'; $statText = 'text-emerald-700'; 
                        if(str_contains($stat, 'tidak')) { $statBg = 'bg-[#fee2e2]'; $statText = 'text-red-700'; }
                        elseif(str_contains($stat, 'alumni')) { $statBg = 'bg-gray-100'; $statText = 'text-gray-600'; }
                    @endphp

                    <tr class="hover:bg-gray-50/50 transition-colors group">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="h-10 w-10 rounded-full bg-[#1e3a8a] flex items-center justify-center text-white font-bold text-sm">
                                    {{ $initial }}
                                </div>
                                <div>
                                    <p class="text-[15px] font-bold text-gray-900">{{ $nama }}</p>
                                    <p class="text-[13px] text-gray-500">{{ $jabatanDisplay }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-[15px] text-gray-700">{{ $nim }}</td>
                        <td class="px-6 py-4">
                            <span class="{{ $divBg }} {{ $divText }} text-[12px] font-semibold px-3 py-1 rounded-full whitespace-nowrap">{{ $divisiDisplay }}</span>
                        </td>
                        <td class="px-6 py-4 text-[15px] text-gray-700">{{ $angkatan }}</td>
                        <td class="px-6 py-4">
                            <span class="{{ $statBg }} {{ $statText }} text-[12px] font-semibold px-3 py-1 rounded-full whitespace-nowrap">{{ $statusDisplay }}</span>
                        </td>
                        <td class="px-6 py-4 text-[15px] text-gray-700">{{ $kontak }}</td>
                        <td class="px-6 py-4">
                            <div class="flex justify-center gap-2">
                                <!-- Tombol Edit -->
                                <button onclick="openEditModal('{{ $id }}', '{{ addslashes($nama) }}', '{{ $nim }}', '{{ $rawDivisi }}', '{{ $angkatan }}', '{{ addslashes($email) }}', '{{ $kontak }}', '{{ $rawStatus }}', '{{ $rawJabatan }}')" class="p-1.5 border border-gray-200 rounded-md text-orange-500 hover:bg-orange-50 transition-colors" title="Edit Data">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                </button>
                                <!-- Tombol Hapus (Memicu Delete Modal) -->
                                <button onclick="openDeleteModal('{{ $id }}', '{{ addslashes($nama) }}')" class="p-1.5 border border-gray-200 rounded-md text-gray-400 hover:bg-red-50 hover:text-red-500 hover:border-red-200 transition-colors" title="Hapus Data">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if(isset($anggotas) && $anggotas instanceof \Illuminate\Pagination\LengthAwarePaginator && $anggotas->hasPages())
        <div class="border-t border-gray-100 px-6 py-4 bg-white">
            {{ $anggotas->appends(['search' => $search ?? ''])->links() }}
        </div>
        @endif
    </div>
</div>

<!-- ================= MODAL TAMBAH ANGGOTA ================= -->
<div id="addMemberModal" class="fixed inset-0 z-50 hidden bg-slate-900/40 backdrop-blur-sm overflow-y-auto h-full w-full flex items-center justify-center transition-opacity duration-300">
    <div class="relative w-full max-w-2xl mx-auto bg-white rounded-2xl shadow-2xl p-8 border border-gray-100">
        <div class="flex justify-between items-start mb-6">
            <h3 class="text-xl font-bold text-gray-900">Tambah Anggota</h3>
            <button type="button" onclick="closeModal('addMemberModal')" class="bg-red-50 text-red-500 hover:bg-red-100 hover:text-red-600 transition-colors rounded-xl p-2 focus:outline-none">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        
        <form action="{{ Route::has('admin.anggota.store') ? route('admin.anggota.store') : '#' }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div><label class="block text-[13px] font-medium text-gray-700 mb-1.5">Nama Lengkap*</label><input type="text" name="name" required class="w-full px-4 py-2.5 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500"></div>
                <div><label class="block text-[13px] font-medium text-gray-700 mb-1.5">NIM*</label><input type="text" name="nim" required class="w-full px-4 py-2.5 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500"></div>
                <div>
                    <label class="block text-[13px] font-medium text-gray-700 mb-1.5">Divisi*</label>
                    <select name="divisi" required class="custom-select-icon w-full px-4 py-2.5 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 appearance-none">
                        <option value="" disabled selected>Pilih Divisi</option>
                        <option value="administration">Administration</option>
                        <option value="education">Education</option>
                        <option value="media_creative">Media Creative</option>
                        <option value="public_relation">Public Relation</option>
                        <option value="investment_gallery">Investment Gallery</option>
                        <option value="analyze_trading">Analyze Trading</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[13px] font-medium text-gray-700 mb-1.5">Angkatan</label>
                    <select name="angkatan" class="custom-select-icon w-full px-4 py-2.5 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 appearance-none">
                        <option value="2024">2024</option><option value="2023">2023</option><option value="2022">2022</option><option value="2021">2021</option>
                    </select>
                </div>
                <div><label class="block text-[13px] font-medium text-gray-700 mb-1.5">Email</label><input type="email" name="email" class="w-full px-4 py-2.5 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500"></div>
                <div><label class="block text-[13px] font-medium text-gray-700 mb-1.5">WhatsApp</label><input type="text" name="whatsapp" class="w-full px-4 py-2.5 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500"></div>
                <div>
                    <label class="block text-[13px] font-medium text-gray-700 mb-1.5">Status</label>
                    <select name="status" class="custom-select-icon w-full px-4 py-2.5 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 appearance-none">
                        <option value="aktif">Aktif</option><option value="tidak_aktif">Tidak Aktif</option><option value="alumni">Alumni</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[13px] font-medium text-gray-700 mb-1.5">Jabatan</label>
                    <select name="jabatan" class="custom-select-icon w-full px-4 py-2.5 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 appearance-none">
                        <option value="anggota">Anggota</option><option value="staff">Staff</option><option value="koordinator">Koordinator</option><option value="ketua">Ketua</option>
                    </select>
                </div>
            </div>
            <div class="mt-8 flex justify-end gap-3">
                <button type="button" onclick="closeModal('addMemberModal')" class="px-5 py-2.5 bg-white border text-gray-700 rounded-xl font-semibold hover:bg-gray-50">Batal</button>
                <button type="submit" class="px-5 py-2.5 bg-[#1e3a8a] text-white rounded-xl font-semibold flex items-center gap-2 hover:bg-blue-800 shadow-md">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- ================= MODAL EDIT ANGGOTA ================= -->
<div id="editMemberModal" class="fixed inset-0 z-50 hidden bg-slate-900/40 backdrop-blur-sm overflow-y-auto h-full w-full flex items-center justify-center transition-opacity duration-300">
    <div class="relative w-full max-w-2xl mx-auto bg-white rounded-2xl shadow-2xl p-8 border border-gray-100">
        <div class="flex justify-between items-start mb-6">
            <h3 class="text-xl font-bold text-gray-900">Edit Anggota</h3>
            <button type="button" onclick="closeModal('editMemberModal')" class="bg-slate-100 text-slate-500 hover:bg-slate-200 hover:text-slate-700 transition-colors rounded-xl p-2 focus:outline-none">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        <form id="editForm" action="#" method="POST">
            @csrf @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div><label class="block text-[13px] font-medium text-gray-700 mb-1.5">Nama Lengkap*</label><input type="text" id="edit_name" name="name" required class="w-full px-4 py-2.5 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500"></div>
                <div><label class="block text-[13px] font-medium text-gray-700 mb-1.5">NIM*</label><input type="text" id="edit_nim" name="nim" required class="w-full px-4 py-2.5 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500"></div>
                <div>
                    <label class="block text-[13px] font-medium text-gray-700 mb-1.5">Divisi*</label>
                    <select id="edit_divisi" name="divisi" required class="custom-select-icon w-full px-4 py-2.5 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 appearance-none">
                        <option value="" disabled>Pilih Divisi</option>
                        <option value="administration">Administration</option>
                        <option value="education">Education</option>
                        <option value="media_creative">Media Creative</option>
                        <option value="public_relation">Public Relation</option>
                        <option value="investment_gallery">Investment Gallery</option>
                        <option value="analyze_trading">Analyze Trading</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[13px] font-medium text-gray-700 mb-1.5">Angkatan</label>
                    <select id="edit_angkatan" name="angkatan" class="custom-select-icon w-full px-4 py-2.5 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 appearance-none">
                        <option value="2024">2024</option><option value="2023">2023</option><option value="2022">2022</option><option value="2021">2021</option>
                    </select>
                </div>
                <div><label class="block text-[13px] font-medium text-gray-700 mb-1.5">Email</label><input type="email" id="edit_email" name="email" class="w-full px-4 py-2.5 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500"></div>
                <div><label class="block text-[13px] font-medium text-gray-700 mb-1.5">WhatsApp</label><input type="text" id="edit_whatsapp" name="whatsapp" class="w-full px-4 py-2.5 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500"></div>
                <div>
                    <label class="block text-[13px] font-medium text-gray-700 mb-1.5">Status</label>
                    <select id="edit_status" name="status" class="custom-select-icon w-full px-4 py-2.5 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 appearance-none">
                        <option value="aktif">Aktif</option><option value="tidak_aktif">Tidak Aktif</option><option value="alumni">Alumni</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[13px] font-medium text-gray-700 mb-1.5">Jabatan</label>
                    <select id="edit_jabatan" name="jabatan" class="custom-select-icon w-full px-4 py-2.5 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 appearance-none">
                        <option value="anggota">Anggota</option><option value="staff">Staff</option><option value="koordinator">Koordinator</option><option value="ketua">Ketua</option>
                    </select>
                </div>
            </div>
            <div class="mt-8 flex justify-end gap-3">
                <button type="button" onclick="closeModal('editMemberModal')" class="px-5 py-2.5 bg-white border text-gray-700 rounded-xl font-semibold hover:bg-gray-50">Batal</button>
                <button type="submit" class="px-5 py-2.5 bg-[#1e3a8a] text-white rounded-xl font-semibold flex items-center gap-2 hover:bg-blue-800 shadow-md">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- ================= MODAL HAPUS ANGGOTA ================= -->
<div id="deleteMemberModal" class="fixed inset-0 z-50 hidden bg-slate-900/40 backdrop-blur-sm overflow-y-auto h-full w-full flex items-center justify-center transition-opacity duration-300">
    <div class="relative w-full max-w-sm mx-auto bg-white rounded-3xl shadow-2xl p-8 border border-gray-100 text-center">
        <div class="mb-4 inline-flex items-center justify-center drop-shadow-md">
            <span class="text-6xl">🗑️</span>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-2">Hapus Data?</h3>
        <p class="text-[15px] text-gray-500 mb-8">
            Hapus anggota "<span id="delete_member_name" class="font-bold text-gray-800"></span>"?
        </p>
        <form id="deleteForm" action="#" method="POST" class="flex justify-center gap-3">
            @csrf
            @method('DELETE')
            <button type="button" onclick="closeModal('deleteMemberModal')" class="px-6 py-2.5 bg-white border border-gray-200 text-gray-700 rounded-xl text-sm font-semibold hover:bg-gray-50 transition-colors w-full">
                Batal
            </button>
            <button type="submit" class="px-6 py-2.5 bg-red-500 text-white rounded-xl text-sm font-semibold hover:bg-red-600 transition-colors flex items-center justify-center gap-2 shadow-md w-full">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                Hapus
            </button>
        </form>
    </div>
</div>

<style>
    .custom-select-icon {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 0.5rem center;
        background-repeat: no-repeat;
        background-size: 1.5em 1.5em;
        padding-right: 2.5rem;
    }
</style>

<script>
    // General Modal Functions
    function openModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.children[0].classList.add('scale-100', 'opacity-100');
            modal.children[0].classList.remove('scale-95', 'opacity-0');
        }, 10);
    }

    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.children[0].classList.remove('scale-100', 'opacity-100');
        modal.children[0].classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 200);
    }

    // Modal Edit Data Injeksi
    function openEditModal(id, name, nim, divisi, angkatan, email, whatsapp, status, jabatan) {
        const form = document.getElementById('editForm');
        form.action = `/admin/anggota/${id}`;

        document.getElementById('edit_name').value = name;
        document.getElementById('edit_nim').value = nim !== '-' ? nim : '';
        document.getElementById('edit_divisi').value = divisi;
        document.getElementById('edit_angkatan').value = angkatan !== '-' ? angkatan : '';
        document.getElementById('edit_email').value = email;
        document.getElementById('edit_whatsapp').value = whatsapp !== '-' ? whatsapp : '';
        document.getElementById('edit_status').value = status;
        document.getElementById('edit_jabatan').value = jabatan;

        openModal('editMemberModal');
    }

    // Modal Delete Injeksi
    function openDeleteModal(id, name) {
        const form = document.getElementById('deleteForm');
        form.action = `/admin/anggota/${id}`;
        document.getElementById('delete_member_name').innerText = name;
        openModal('deleteMemberModal');
    }

    // Tutup saat klik background hitam
    window.onclick = function(event) {
        if (event.target == document.getElementById('addMemberModal')) closeModal('addMemberModal');
        if (event.target == document.getElementById('editMemberModal')) closeModal('editMemberModal');
        if (event.target == document.getElementById('deleteMemberModal')) closeModal('deleteMemberModal');
    }
</script>
@endsection
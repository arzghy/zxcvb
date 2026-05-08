@extends('layouts.admin')

@section('page-title', 'Pusat Riset')
@section('page-breadcrumb', 'Kelola Riset')

@section('content')
<div class="section-header flex items-center justify-between mb-5 mt-2 gap-3 flex-wrap">
    <div>
        <div class="section-title text-lg font-bold text-gray-900">Riset & Publikasi</div>
        <div class="section-sub text-sm text-gray-500">Kelola dokumen riset KSPM</div>
    </div>
    <div class="flex gap-2 flex-wrap">
        <div class="search-bar relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm">🔍</span>
            <input type="text" id="search-input" class="inp inp-sm pl-9" placeholder="Cari judul riset...">
        </div>
        <select id="filter-type" class="inp inp-sm" style="width:auto">
            <option value="">Semua Kategori</option>
            <option value="Weekly Outlook">Weekly Outlook</option>
            <option value="Analisis Fundamental">Analisis Fundamental</option>
            <option value="Stock Pick">Stock Pick</option>
            <option value="Outlook Sektor">Outlook Sektor</option>
            <option value="Riset Khusus">Riset Khusus</option>
        </select>
        <button class="btn btn-primary btn-sm" onclick="openModal('modal-tambah-riset')">+ Upload Riset</button>
    </div>
</div>

{{-- ===== LIST DATA RISET (RESPONSIF) ===== --}}
<div class="flex flex-col gap-3.5" id="riset-list">
    @forelse($risets as $rs)
        @php
            $statusClass = match($rs->status) {
                'Publik' => 'bg-green-100 text-green-800',
                'Terbatas' => 'bg-yellow-100 text-yellow-800',
                'Draft' => 'bg-gray-100 text-gray-600',
                default => 'bg-gray-100 text-gray-800',
            };
        @endphp
        
        <div class="bg-white border border-gray-200 rounded-2xl p-4 sm:p-5 hover:border-blue-300 hover:shadow-sm transition-all flex flex-col sm:flex-row sm:items-center justify-between gap-4 riset-card-item" data-category="{{ strtolower($rs->category) }}">
            
            {{-- Bagian Kiri: Icon & Info --}}
            <div class="flex items-start gap-4 w-full sm:w-auto overflow-hidden">
                <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-500 flex items-center justify-center text-2xl shrink-0 border border-blue-100">
                    📄
                </div>
                <div class="min-w-0 flex-1">
                    <div class="font-bold text-gray-900 text-[1.05rem] mb-1.5 truncate pr-2">
                        {{ $rs->title }}
                    </div>
                    <div class="flex flex-wrap items-center gap-2 text-[0.75rem]">
                        <span class="px-2 py-0.5 rounded-md bg-blue-50 text-blue-700 font-bold border border-blue-100 shrink-0">
                            {{ $rs->category }}
                        </span>
                        <span class="text-gray-300 hidden sm:inline">•</span>
                        <span class="text-gray-600 font-medium flex items-center gap-1 shrink-0">
                            👤 {{ $rs->author ?? '-' }}
                        </span>
                        <span class="text-gray-300 hidden sm:inline">•</span>
                        <span class="text-gray-500 flex items-center gap-1 shrink-0">
                            📅 {{ $rs->release_date ? \Carbon\Carbon::parse($rs->release_date)->format('d M Y') : '-' }}
                        </span>
                        <span class="text-gray-300 hidden sm:inline">•</span>
                        <span class="text-gray-500 font-mono shrink-0 text-[0.7rem]">
                            💾 {{ $rs->file_size ?? 'Auto' }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- Bagian Kanan: Status & Tombol Aksi --}}
            <div class="flex flex-row sm:flex-col items-center sm:items-end justify-between sm:justify-center gap-3 w-full sm:w-auto mt-2 sm:mt-0 pt-3 sm:pt-0 border-t sm:border-t-0 border-gray-100 shrink-0">
                <span class="{{ $statusClass }} px-2.5 py-1 rounded-full text-[0.65rem] font-bold uppercase tracking-wider">
                    {{ $rs->status }}
                </span>
                
                <div class="flex gap-1.5">
                    @if($rs->file_path)
                        {{-- Kembalikan ke asset() untuk percobaan normal, atau ganti ke route('buka.pdf') jika pakai VVIP --}}
                        <a href="{{ route('admin.riset.pdf', $rs->id) }}" target="_blank" class="btn btn-ghost bg-gray-50 hover:bg-green-50 text-green-600 border border-gray-200 hover:border-green-200 btn-sm px-3" title="Buka PDF">👁️ Lihat</a>
                    @endif
                    <button type="button" class="btn btn-ghost bg-gray-50 hover:bg-blue-50 text-blue-600 border border-gray-200 hover:border-blue-200 btn-sm btn-edit px-2.5" data-riset="{{ json_encode($rs) }}">✏️ Edit</button>
                    <button type="button" class="btn btn-ghost bg-gray-50 hover:bg-red-50 text-red-500 border border-gray-200 hover:border-red-200 btn-sm btn-delete-trigger px-2.5" data-url="{{ route('admin.riset.destroy', $rs->id) }}" data-title="{{ $rs->title }}">🗑️</button>
                </div>
            </div>
            
        </div>
    @empty
        <div id="empty-db" class="bg-white p-16 rounded-2xl border border-gray-200 flex flex-col items-center justify-center text-center">
            <div class="text-4xl opacity-40 mb-3">📄</div>
            <p class="text-sm font-semibold text-gray-500">Belum ada data publikasi riset</p>
            <p class="text-xs text-gray-400 mt-1">Tambahkan riset baru dengan tombol "+ Upload Riset"</p>
        </div>
    @endforelse

    {{-- State Pencarian Kosong --}}
    <div id="empty-state" style="display: none;" class="bg-white p-16 rounded-2xl border border-gray-200 flex-col items-center justify-center text-center">
        <div class="text-4xl opacity-40 mb-3">📭</div>
        <p class="text-sm font-semibold text-gray-500">Riset tidak tersedia</p>
        <p class="text-xs text-gray-400 mt-1">Coba gunakan kata kunci pencarian yang lain.</p>
    </div>
</div>

{{-- ===== MODAL TAMBAH RISET ===== --}}
<div class="modal-overlay fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden items-center justify-center p-4" id="modal-tambah-riset">
    <div class="modal bg-white rounded-2xl p-7 w-full max-w-lg relative">
        <div class="modal-header flex items-center justify-between mb-5 pb-3.5 border-b border-gray-200">
            <div class="modal-title text-base font-bold text-gray-900">Upload Riset</div>
            <button class="w-8 h-8 rounded-lg bg-gray-100 text-gray-500 hover:bg-red-100 hover:text-red-500 transition flex items-center justify-center" onclick="closeModal('modal-tambah-riset')">✕</button>
        </div>
        <form action="{{ route('admin.riset.store') }}" method="POST" enctype="multipart/form-data" id="form-tambah-riset">
            @csrf
            <div class="mb-3.5">
                <label class="block text-xs font-semibold text-gray-500 mb-1">Judul Riset*</label>
                <input class="inp" name="title" required placeholder="Judul dokumen riset">
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-3.5">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Kategori*</label>
                    <select class="inp" name="category" required>
                        <option value="Weekly Outlook">Weekly Outlook</option>
                        <option value="Analisis Fundamental">Analisis Fundamental</option>
                        <option value="Stock Pick">Stock Pick</option>
                        <option value="Outlook Sektor">Outlook Sektor</option>
                        <option value="Riset Khusus">Riset Khusus</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Penulis</label>
                    <input class="inp" name="author" placeholder="Nama / Divisi">
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-3.5">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Tanggal Rilis</label>
                    <input type="date" class="inp" name="release_date">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Ukuran File</label>
                    <input class="inp" name="file_size" placeholder="Cth: 1.5 MB (Auto jika kosong)">
                </div>
            </div>

            {{-- INTERAKTIF UPLOAD AREA --}}
            <div class="mb-4">
                <label class="block text-xs font-semibold text-gray-500 mb-1">File Dokumen PDF</label>
                <div id="drop-area-tambah" class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:bg-gray-50 transition duration-300 relative overflow-hidden group">
                    <input type="file" name="file" id="file-tambah" accept=".pdf" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                    
                    <div id="file-info-tambah" class="pointer-events-none transition-opacity">
                        <div class="text-4xl mb-2">📄</div>
                        <div class="text-sm font-semibold text-gray-700 group-hover:text-blue-600 transition">Klik atau Drag untuk upload PDF</div>
                        <div class="text-xs text-gray-400 mt-1">Mendukung file PDF hingga 10MB</div>
                    </div>

                    <div id="file-success-tambah" class="hidden pointer-events-none flex-col items-center justify-center">
                        <div class="text-4xl mb-2">✅</div>
                        <div class="text-sm font-bold text-green-600 truncate w-full px-4" id="file-name-tambah">filename.pdf</div>
                        <div class="text-xs text-gray-500 mt-1" id="file-size-tambah">1.2 MB</div>
                        <div class="mt-3 text-[0.7rem] font-semibold text-blue-600 bg-blue-50 border border-blue-200 px-3 py-1 rounded-lg">Ganti File</div>
                    </div>
                </div>
            </div>

            <div class="mb-3.5">
                <label class="block text-xs font-semibold text-gray-500 mb-1">Status Publikasi</label>
                <select class="inp" name="status">
                    <option value="Publik">Publik</option>
                    <option value="Draft">Draft</option>
                    <option value="Terbatas">Terbatas</option>
                </select>
            </div>
            <div class="mt-5 pt-4 border-t border-gray-200 flex justify-end gap-2.5">
                <button type="button" class="btn btn-ghost" onclick="closeModal('modal-tambah-riset')">Batal</button>
                <button type="submit" class="btn btn-primary">📊 Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- ===== MODAL EDIT RISET ===== --}}
<div class="modal-overlay fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden items-center justify-center p-4" id="modal-edit-riset">
    <div class="modal bg-white rounded-2xl p-7 w-full max-w-lg relative">
        <div class="modal-header flex items-center justify-between mb-5 pb-3.5 border-b border-gray-200">
            <div class="modal-title text-base font-bold text-gray-900">Edit Riset</div>
            <button class="w-8 h-8 rounded-lg bg-gray-100 text-gray-500 hover:bg-red-100 hover:text-red-500 transition flex items-center justify-center" onclick="closeModal('modal-edit-riset')">✕</button>
        </div>
        <form id="form-edit-riset" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3.5">
                <label class="block text-xs font-semibold text-gray-500 mb-1">Judul Riset*</label>
                <input class="inp" name="title" id="edit-title" required>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-3.5">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Kategori*</label>
                    <select class="inp" name="category" id="edit-category" required>
                        <option value="Weekly Outlook">Weekly Outlook</option>
                        <option value="Analisis Fundamental">Analisis Fundamental</option>
                        <option value="Stock Pick">Stock Pick</option>
                        <option value="Outlook Sektor">Outlook Sektor</option>
                        <option value="Riset Khusus">Riset Khusus</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Penulis</label>
                    <input class="inp" name="author" id="edit-author">
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-3.5">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Tanggal Rilis</label>
                    <input type="date" class="inp" name="release_date" id="edit-release-date">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Ukuran File</label>
                    <input class="inp" name="file_size" id="edit-file-size">
                </div>
            </div>

            {{-- INTERAKTIF UPLOAD AREA EDIT --}}
            <div class="mb-4">
                <label class="block text-xs font-semibold text-gray-500 mb-1">Ganti Dokumen PDF (Opsional)</label>
                <div id="drop-area-edit" class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:bg-gray-50 transition duration-300 relative overflow-hidden group">
                    <input type="file" name="file" id="file-edit" accept=".pdf" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                    <div id="file-info-edit" class="pointer-events-none transition-opacity">
                        <div class="text-4xl mb-2">📄</div>
                        <div class="text-sm font-semibold text-gray-700 group-hover:text-blue-600 transition">Klik untuk Ganti File PDF</div>
                        <div class="text-xs text-gray-400 mt-1">Biarkan kosong jika tidak ingin mengubah dokumen</div>
                    </div>
                    <div id="file-success-edit" class="hidden pointer-events-none flex-col items-center justify-center">
                        <div class="text-4xl mb-2">✅</div>
                        <div class="text-sm font-bold text-green-600 truncate w-full px-4" id="file-name-edit">filename.pdf</div>
                        <div class="text-xs text-gray-500 mt-1" id="file-size-edit">1.2 MB</div>
                        <div class="mt-3 text-[0.7rem] font-semibold text-blue-600 bg-blue-50 border border-blue-200 px-3 py-1 rounded-lg">Ganti File Lain</div>
                    </div>
                </div>
            </div>

            <div class="mb-3.5">
                <label class="block text-xs font-semibold text-gray-500 mb-1">Status Publikasi</label>
                <select class="inp" name="status" id="edit-status">
                    <option value="Publik">Publik</option>
                    <option value="Draft">Draft</option>
                    <option value="Terbatas">Terbatas</option>
                </select>
            </div>
            <div class="mt-5 pt-4 border-t border-gray-200 flex justify-end gap-2.5">
                <button type="button" class="btn btn-ghost" onclick="closeModal('modal-edit-riset')">Batal</button>
                <button type="submit" class="btn btn-primary">📊 Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

{{-- ===== MODAL DELETE CONFIRM ===== --}}
<div class="modal-overlay fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden items-center justify-center p-4" id="modal-delete">
    <div class="modal bg-white rounded-2xl p-8 w-full max-w-[400px] text-center relative">
        <div class="text-5xl mb-4">🗑️</div>
        <div class="text-lg font-bold text-gray-900 mb-2">Hapus Data?</div>
        <div class="text-sm text-gray-500 mb-6" id="delete-msg">Dokumen riset ini akan dihapus permanen.</div>
        
        <form id="form-delete-riset" method="POST">
            @csrf
            @method('DELETE')
            <div class="flex gap-2.5 justify-center">
                <button type="button" class="btn btn-ghost" onclick="closeModal('modal-delete')">Batal</button>
                <button type="submit" class="btn bg-red-500 hover:bg-red-600 text-white px-5 py-2 rounded-xl font-semibold transition">🗑️ Hapus</button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('styles')
<style>
    .modal-overlay.open { display: flex !important; }
</style>
@endpush

@push('scripts')
<script>
    function openModal(id) { 
        document.getElementById(id).classList.add('open'); 
    }
    
    function closeModal(id) { 
        document.getElementById(id).classList.remove('open'); 
        if(id === 'modal-tambah-riset') {
            document.getElementById('form-tambah-riset').reset();
            resetFileInputUI('file-tambah', 'file-info-tambah', 'file-success-tambah', 'drop-area-tambah');
        }
    }

    function handleFileInput(inputId, infoId, successId, nameId, sizeId, dropAreaId) {
        const input = document.getElementById(inputId);
        const info = document.getElementById(infoId);
        const success = document.getElementById(successId);
        const nameDisplay = document.getElementById(nameId);
        const sizeDisplay = document.getElementById(sizeId);
        const dropArea = document.getElementById(dropAreaId);

        input.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                info.classList.add('hidden');
                success.classList.remove('hidden');
                success.classList.add('flex');
                
                dropArea.classList.add('border-green-400', 'bg-green-50');
                dropArea.classList.remove('border-gray-300', 'hover:bg-gray-50');

                nameDisplay.textContent = file.name;
                
                const sizeKB = file.size / 1024;
                if (sizeKB > 1024) {
                    sizeDisplay.textContent = (sizeKB / 1024).toFixed(2) + ' MB';
                } else {
                    sizeDisplay.textContent = sizeKB.toFixed(2) + ' KB';
                }
            } else {
                resetFileInputUI(inputId, infoId, successId, dropAreaId);
            }
        });
    }

    function resetFileInputUI(inputId, infoId, successId, dropAreaId) {
        document.getElementById(inputId).value = '';
        document.getElementById(infoId).classList.remove('hidden');
        document.getElementById(successId).classList.add('hidden');
        document.getElementById(successId).classList.remove('flex');
        
        const dropArea = document.getElementById(dropAreaId);
        dropArea.classList.remove('border-green-400', 'bg-green-50');
        dropArea.classList.add('border-gray-300', 'hover:bg-gray-50');
    }

    handleFileInput('file-tambah', 'file-info-tambah', 'file-success-tambah', 'file-name-tambah', 'file-size-tambah', 'drop-area-tambah');
    handleFileInput('file-edit', 'file-info-edit', 'file-success-edit', 'file-name-edit', 'file-size-edit', 'drop-area-edit');

    document.querySelectorAll('.btn-edit').forEach(btn => {
        btn.addEventListener('click', function() {
            const rs = JSON.parse(this.dataset.riset);
            const form = document.getElementById('form-edit-riset');
            
            form.action = `/admin/riset/${rs.id}`;

            document.getElementById('edit-title').value = rs.title;
            document.getElementById('edit-category').value = rs.category || 'Weekly Outlook';
            document.getElementById('edit-author').value = rs.author || '';
            document.getElementById('edit-release-date').value = rs.release_date || '';
            document.getElementById('edit-file-size').value = rs.file_size || '';
            document.getElementById('edit-status').value = rs.status || 'Publik';

            resetFileInputUI('file-edit', 'file-info-edit', 'file-success-edit', 'drop-area-edit');

            openModal('modal-edit-riset');
        });
    });

    document.querySelectorAll('.btn-delete-trigger').forEach(btn => {
        btn.addEventListener('click', function() {
            const url = this.dataset.url;
            const title = this.dataset.title;
            
            document.getElementById('form-delete-riset').action = url;
            document.getElementById('delete-msg').innerHTML = `Riset <b>"${title}"</b> akan dihapus permanen beserta file PDF-nya.`;
            
            openModal('modal-delete');
        });
    });

    // Filtering logic diperbarui untuk format class baru
    const searchInput = document.getElementById('search-input');
    const filterType = document.getElementById('filter-type');
    const eventCards = document.querySelectorAll('.riset-card-item');
    const emptyState = document.getElementById('empty-state');

    function filterRiset() {
        const query = searchInput.value.toLowerCase();
        const type = filterType.value.toLowerCase();
        let visibleCount = 0;

        eventCards.forEach(card => {
            const textContent = card.textContent.toLowerCase();
            const cardType = card.getAttribute('data-category');

            const matchesSearch = textContent.includes(query);
            const matchesType = (type === '' || cardType === type);

            if (matchesSearch && matchesType) {
                card.style.display = 'flex'; // Menggunakan flex karena ini adalah div flex
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        if (eventCards.length > 0) {
            emptyState.style.display = visibleCount === 0 ? 'flex' : 'none';
        }
    }

    searchInput.addEventListener('input', filterRiset);
    filterType.addEventListener('change', filterRiset);
</script>
@endpush
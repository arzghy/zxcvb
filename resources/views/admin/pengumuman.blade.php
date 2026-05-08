@extends('layouts.admin')

@section('page-title', 'Pengumuman')
@section('page-breadcrumb', 'Manajemen Konten')

@section('content')
<div class="section-header flex items-center justify-between mb-5 mt-2 gap-3 flex-wrap">
    <div>
        <div class="section-title text-lg font-bold text-gray-900">Daftar Pengumuman</div>
        <div class="section-sub text-sm text-gray-500">Kirim informasi terbaru ke anggota atau publik</div>
    </div>
    <div class="flex gap-2 flex-wrap">
        <div class="search-bar relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm">🔍</span>
            <input type="text" id="search-input" class="inp inp-sm pl-9" placeholder="Cari pengumuman...">
        </div>
        <button class="btn btn-primary btn-sm" onclick="prepareAdd()">+ Buat Pengumuman</button>
    </div>
</div>

{{-- LIST PENGUMUMAN --}}
<div class="flex flex-col gap-3.5" id="announcement-list">
    @forelse($announcements as $ann)
    @php
        $typeColor = match($ann->type) {
            'Penting' => 'bg-red-100 text-red-700 border-red-200',
            'Rekrutmen' => 'bg-purple-100 text-purple-700 border-purple-200',
            'Kegiatan' => 'bg-blue-100 text-blue-700 border-blue-200',
            'Lomba' => 'bg-yellow-100 text-yellow-700 border-yellow-200',
            default => 'bg-gray-100 text-gray-700 border-gray-200',
        };
    @endphp
    <div class="bg-white border border-gray-200 rounded-2xl p-4 sm:p-5 hover:border-blue-300 hover:shadow-sm transition-all flex flex-col sm:flex-row sm:items-center justify-between gap-4 announcement-card-item">
        <div class="flex items-start gap-4 w-full sm:w-auto">
            <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-500 flex items-center justify-center text-2xl shrink-0 border border-blue-100">
                📢
            </div>
            <div class="min-w-0 flex-1">
                <div class="flex items-center gap-2 mb-1 flex-wrap">
                    <span class="px-2 py-0.5 rounded-md text-[0.7rem] font-bold border {{ $typeColor }}">
                        {{ $ann->type }}
                    </span>
                    <span class="text-[0.7rem] text-gray-400 font-medium">Target: {{ $ann->target }}</span>
                </div>
                <div class="font-bold text-gray-900 text-[1.05rem] mb-1 truncate">
                    {{ $ann->title }}
                </div>
                <div class="text-[0.8rem] text-gray-500 line-clamp-1 leading-relaxed">
                    {{ $ann->content }}
                </div>
                <div class="text-[0.7rem] text-gray-400 mt-2 flex items-center gap-3">
                    <span>📅 {{ $ann->start_date ? \Carbon\Carbon::parse($ann->start_date)->format('d M') : 'Sekarang' }} - {{ $ann->end_date ? \Carbon\Carbon::parse($ann->end_date)->format('d M Y') : 'Seterusnya' }}</span>
                </div>
            </div>
        </div>

        <div class="flex gap-1.5 shrink-0 justify-end pt-3 sm:pt-0 border-t sm:border-t-0 border-gray-100">
            <button class="btn btn-ghost bg-gray-50 hover:bg-blue-50 text-blue-600 border border-gray-200 btn-sm px-3 btn-edit" data-item="{{ json_encode($ann) }}">✏️ Edit</button>
            <form action="{{ route('admin.pengumuman.destroy', $ann->id) }}" method="POST" onsubmit="return confirm('Hapus pengumuman ini?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-ghost bg-gray-50 hover:bg-red-50 text-red-500 border border-gray-200 btn-sm px-2.5">🗑️</button>
            </form>
        </div>
    </div>
    @empty
    <div class="bg-white p-16 rounded-2xl border border-gray-200 flex flex-col items-center justify-center text-center">
        <div class="text-4xl opacity-40 mb-3">📢</div>
        <p class="text-sm font-semibold text-gray-500">Belum ada pengumuman</p>
        <p class="text-xs text-gray-400 mt-1">Tambahkan pengumuman baru dengan tombol "+ Buat Pengumuman"</p>
    </div>
    @endforelse
    {{-- State Pencarian Kosong --}}
    <div id="empty-state-search" style="display: none;" class="bg-white p-16 rounded-2xl border border-gray-200 flex-col items-center justify-center text-center">
        <div class="text-4xl opacity-40 mb-3">📭</div>
        <p class="text-sm font-semibold text-gray-500">Pengumuman tidak ditemukan</p>
        <p class="text-xs text-gray-400 mt-1">Coba gunakan kata kunci pencarian yang lain.</p>
    </div>
</div>

{{-- MODAL PENGUMUMAN (TAMBAH & EDIT) --}}
<div class="modal-overlay fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden items-center justify-center p-4" id="modal-pengumuman">
    <div class="modal bg-white rounded-2xl p-7 w-full max-w-lg relative">
        <div class="modal-header flex items-center justify-between mb-5 pb-3.5 border-b border-gray-200">
            <div class="modal-title text-base font-bold text-gray-900" id="modal-pengumuman-title">Buat Pengumuman</div>
            <button class="modal-close text-gray-400 hover:text-gray-600" onclick="closeModal('modal-pengumuman')">✕</button>
        </div>
        <form id="form-pengumuman" action="{{ route('admin.pengumuman.store') }}" method="POST">
            @csrf
            <div id="method-field"></div>
            <div class="form-field mb-4">
                <label class="form-label block text-xs font-semibold text-gray-500 mb-1">Judul Pengumuman*</label>
                <input class="inp" name="title" id="pengumuman-judul" placeholder="Judul pengumuman" required>
            </div>
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="form-label block text-xs font-semibold text-gray-500 mb-1">Tipe</label>
                    <select class="inp" name="type" id="pengumuman-tipe">
                        <option>Info</option><option>Penting</option><option>Rekrutmen</option><option>Kegiatan</option><option>Lomba</option>
                    </select>
                </div>
                <div>
                    <label class="form-label block text-xs font-semibold text-gray-500 mb-1">Target</label>
                    <select class="inp" name="target" id="pengumuman-target">
                        <option>Semua Anggota</option><option>Staff</option><option>Publik</option>
                    </select>
                </div>
            </div>
            <div class="form-field mb-4">
                <label class="form-label block text-xs font-semibold text-gray-500 mb-1">Isi Pengumuman*</label>
                <textarea class="inp" name="content" id="pengumuman-isi" placeholder="Tulis isi pengumuman di sini..." style="min-height:120px" required></textarea>
            </div>
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="form-label block text-xs font-semibold text-gray-500 mb-1">Tanggal Mulai</label>
                    <input class="inp" type="date" name="start_date" id="pengumuman-mulai">
                </div>
                <div>
                    <label class="form-label block text-xs font-semibold text-gray-500 mb-1">Tanggal Berakhir</label>
                    <input class="inp" type="date" name="end_date" id="pengumuman-akhir">
                </div>
            </div>
            <div class="modal-footer mt-5 pt-4 border-t border-gray-200 flex justify-end gap-2.5">
                <button type="button" class="btn btn-ghost" onclick="closeModal('modal-pengumuman')">Batal</button>
                <button type="submit" class="btn btn-primary" id="btn-save">📢 Publish</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Fungsi dasar untuk memunculkan modal
    function openModal(id) {
        const modal = document.getElementById(id);
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    // Fungsi menutup modal
    function closeModal(id) {
        const modal = document.getElementById(id);
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    // Fungsi menyiapkan modal untuk TAMBAH BARU
    function prepareAdd() {
        // Reset Judul dan Tombol
        document.getElementById('modal-pengumuman-title').innerText = "Buat Pengumuman";
        document.getElementById('btn-save').innerText = "📢 Publish";
        
        // Reset Form agar kosong
        const form = document.getElementById('form-pengumuman');
        form.reset();
        form.action = "{{ route('admin.pengumuman.store') }}";
        document.getElementById('method-field').innerHTML = "";
        
        openModal('modal-pengumuman');
    }

    // Logika untuk tombol EDIT
    document.querySelectorAll('.btn-edit').forEach(btn => {
        btn.addEventListener('click', function() {
            // Ambil data dari atribut data-item
            const data = JSON.parse(this.dataset.item);
            const form = document.getElementById('form-pengumuman');
            
            // 1. Ubah UI Modal menjadi mode Edit
            document.getElementById('modal-pengumuman-title').innerText = "Edit Pengumuman";
            document.getElementById('btn-save').innerText = "💾 Simpan Perubahan";
            
            // 2. Atur Action URL dan Method PUT
            form.action = `/admin/pengumuman/${data.id}`;
            document.getElementById('method-field').innerHTML = `@method('PUT')`;
            
            // 3. ISI DATA KE INPUT (Ini bagian yang kamu minta)
            document.getElementById('pengumuman-judul').value = data.title;
            document.getElementById('pengumuman-tipe').value = data.type;
            document.getElementById('pengumuman-target').value = data.target;
            document.getElementById('pengumuman-isi').value = data.content;
            document.getElementById('pengumuman-mulai').value = data.start_date || '';
            document.getElementById('pengumuman-akhir').value = data.end_date || '';
            
            // 4. Baru buka modalnya
            openModal('modal-pengumuman');
        });
    });

    // Fitur Pencarian Sederhana dengan Empty State
    document.getElementById('search-input').addEventListener('input', function(e) {
        const val = e.target.value.toLowerCase();
        let visibleCount = 0;
        const cards = document.querySelectorAll('.announcement-card-item');
        const emptySearchState = document.getElementById('empty-state-search');
        
        cards.forEach(card => {
            const text = card.innerText.toLowerCase();
            if (text.includes(val)) {
                card.style.display = 'flex';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        // Tampilkan State Kosong jika tidak ada hasil pencarian
        if (cards.length > 0) {
            if (visibleCount === 0) {
                emptySearchState.style.display = 'flex';
            } else {
                emptySearchState.style.display = 'none';
            }
        }
    });
</script>
@endpush
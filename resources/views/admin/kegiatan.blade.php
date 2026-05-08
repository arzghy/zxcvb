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
            {{-- Tambahkan ID search-input --}}
            <input type="text" id="search-input" class="inp inp-sm pl-9" placeholder="Cari kegiatan...">
        </div>
        {{-- Tambahkan ID filter-type dan value di tiap option --}}
        <select id="filter-type" class="inp inp-sm" style="width:auto">
            <option value="">Semua Tipe</option>
            <option value="Seminar">Seminar</option>
            <option value="Workshop">Workshop</option>
            <option value="Lomba">Lomba</option>
            <option value="Rapat">Rapat</option>
            <option value="Webinar">Webinar</option>
            <option value="Diskusi">Diskusi</option>
        </select>
        <button class="btn btn-primary btn-sm" onclick="openModal('modal-tambah-kegiatan')">+ Tambah Kegiatan</button>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-5 mb-5" style="align-items: stretch;">
    {{-- ===== KARTU KALENDER ===== --}}
    <div class="card p-5 flex flex-col">
        <div class="flex items-center justify-between mb-4">
            <button class="btn btn-ghost btn-icon btn-sm" id="cal-prev">◀</button>
            <div class="font-bold text-[0.95rem]" id="cal-title"></div>
            <button class="btn btn-ghost btn-icon btn-sm" id="cal-next">▶</button>
        </div>
        <div class="grid grid-cols-7 gap-1 text-center mb-1">
            @foreach(['Min','Sen','Sel','Rab','Kam','Jum','Sab'] as $day)
                <div class="text-[0.68rem] font-bold text-gray-500 uppercase py-1">{{ $day }}</div>
            @endforeach
        </div>
        <div class="grid grid-cols-7 gap-1 text-center" id="cal-grid"></div>
        <div class="flex-1"></div>
    </div>

    {{-- ===== KARTU KEGIATAN MENDATANG ===== --}}
    <div class="card p-5 flex flex-col">
        <div class="font-bold mb-3.5 text-gray-900">Kegiatan Mendatang</div>

        @if($upcomingEvents->isEmpty())
            <div class="flex-1 flex flex-col items-center justify-center py-10 text-gray-400">
                <div class="text-5xl mb-3 opacity-40">📅</div>
                <p class="text-sm font-semibold text-gray-500">Kegiatan belum tersedia</p>
                <p class="text-xs text-gray-400 mt-1">Tambahkan kegiatan baru dengan tombol "+ Tambah Kegiatan"</p>
            </div>
        @else
            <div class="flex flex-col gap-2.5 flex-1">
                @foreach($upcomingEvents as $ev)
                <div class="flex gap-3 p-2.5 rounded-xl border border-gray-200 hover:border-blue-500 transition">
                    <div class="text-center w-10 shrink-0 border-r border-gray-100 pr-2">
                        <div class="font-mono font-extrabold text-blue-600 text-lg">
                            {{ \Carbon\Carbon::parse($ev->event_date)->format('d') }}
                        </div>
                        <div class="text-[0.65rem] text-gray-500">
                            {{ \Carbon\Carbon::parse($ev->event_date)->translatedFormat('M') }}
                        </div>
                    </div>
                    <div class="min-w-0">
                        <div class="text-[0.85rem] font-semibold text-gray-900 truncate">{{ $ev->title }}</div>
                        <div class="text-[0.72rem] text-gray-500 mt-0.5 truncate">📍 {{ $ev->location }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

{{-- ===== TABEL SEMUA KEGIATAN ===== --}}
<div class="card overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse text-sm">
            <thead>
                <tr class="text-gray-500 uppercase tracking-wider border-b border-gray-200 bg-gray-50">
                    <th class="px-4 py-3">Kegiatan</th>
                    <th class="px-4 py-3">Tanggal</th>
                    <th class="px-4 py-3">Lokasi</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody id="table-body-kegiatan">
                @forelse($allEvents as $ev)
                @php
                    $statusClass = match($ev->status) {
                        'Selesai' => 'bg-gray-100 text-gray-600',
                        'Berlangsung' => 'bg-blue-100 text-blue-800',
                        'Dibatalkan' => 'bg-red-100 text-red-800',
                        default => 'bg-green-100 text-green-800',
                    };
                @endphp
                {{-- Tambahkan class event-row dan data-type untuk difilter JS --}}
                <tr class="border-b border-gray-50 hover:bg-blue-50 transition event-row" data-type="{{ strtolower($ev->type ?? '') }}">
                    <td class="px-4 py-3">
                        <div class="font-semibold text-gray-900 event-title">{{ $ev->title }}</div>
                        <div class="text-[0.72rem] text-gray-500">{{ $ev->type ?? 'General' }}</div>
                    </td>
                    <td class="px-4 py-3 text-[0.8rem]">
                        {{ \Carbon\Carbon::parse($ev->event_date)->format('d M Y') }}
                        @if($ev->start_time)
                            <div class="text-[0.7rem] text-gray-400">{{ substr($ev->start_time, 0, 5) }} - {{ substr($ev->end_time, 0, 5) }}</div>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-[0.82rem]">{{ $ev->location }}</td>
                    <td class="px-4 py-3">
                        <span class="{{ $statusClass }} px-2.5 py-0.5 rounded-full text-[0.7rem] font-semibold">
                            {{ $ev->status ?? 'Upcoming' }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-right">
                        <button type="button" class="btn btn-ghost btn-icon btn-sm text-blue-600 btn-edit" data-event="{{ json_encode($ev) }}">✏️</button>
                        <button type="button" class="btn btn-ghost btn-icon btn-sm text-red-500 ml-1 btn-delete-trigger" 
                                data-url="{{ route('admin.event.destroy', $ev->id) }}" 
                                data-title="{{ $ev->title }}">🗑️</button>
                    </td>
                </tr>
                @empty
                <tr id="empty-db">
                    <td colspan="5" class="px-4 py-16 text-center text-gray-400">Belum ada kegiatan dalam database</td>
                </tr>
                @endforelse
                
                {{-- Row kosong untuk notifikasi jika pencarian tidak ditemukan --}}
                <tr id="empty-state" style="display: none;">
                    <td colspan="5" class="px-4 py-16 text-center">
                        <div class="flex flex-col items-center gap-3 text-gray-400">
                            <div class="text-4xl opacity-40">📭</div>
                            <p class="text-sm font-semibold text-gray-500">Kegiatan tidak tersedia</p>
                            <p class="text-xs text-gray-400">Coba gunakan kata kunci pencarian yang lain.</p>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

{{-- ===== MODAL TAMBAH KEGIATAN (Dengan Efek Blur) ===== --}}
<div class="modal-overlay fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden items-center justify-center p-4" id="modal-tambah-kegiatan">
    <div class="modal bg-white rounded-2xl p-7 w-full max-w-2xl max-h-[90vh] overflow-y-auto relative">
        <div class="modal-header flex items-center justify-between mb-5 pb-3.5 border-b border-gray-200">
            <div class="modal-title text-base font-bold text-gray-900">Tambah Kegiatan</div>
            <button class="w-8 h-8 rounded-lg bg-gray-100 text-gray-500 hover:bg-red-100 hover:text-red-500 transition flex items-center justify-center" onclick="closeModal('modal-tambah-kegiatan')">✕</button>
        </div>
        <form action="{{ route('admin.event.store') }}" method="POST">
            @csrf
            <div class="mb-3.5">
                <label class="block text-xs font-semibold text-gray-500 mb-1">Nama Kegiatan*</label>
                <input class="inp" name="title" required>
            </div>
            <div class="grid grid-cols-2 gap-4 mb-3.5">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Tipe*</label>
                    <select class="inp" name="type">
                        <option>Seminar</option><option>Workshop</option><option>Lomba</option><option>Rapat</option><option>Webinar</option><option>Diskusi</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Tanggal*</label>
                    <input type="date" class="inp" name="event_date" required>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4 mb-3.5">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Waktu Mulai</label>
                    <input type="time" class="inp" name="start_time">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Waktu Selesai</label>
                    <input type="time" class="inp" name="end_time">
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4 mb-3.5">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Lokasi/Tempat*</label>
                    <input class="inp" name="location" required>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">PIC</label>
                    <input class="inp" name="pic">
                </div>
            </div>
            <div class="mb-3.5">
                <label class="block text-xs font-semibold text-gray-500 mb-1">Deskripsi</label>
                <textarea class="inp" name="description" rows="3"></textarea>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Status</label>
                    <select class="inp" name="status">
                        <option>Upcoming</option><option>Berlangsung</option><option>Selesai</option><option>Dibatalkan</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Kuota</label>
                    <input type="number" class="inp" name="quota">
                </div>
            </div>
            <div class="mt-5 pt-4 border-t border-gray-200 flex justify-end gap-2.5">
                <button type="button" class="btn btn-ghost" onclick="closeModal('modal-tambah-kegiatan')">Batal</button>
                <button type="submit" class="btn btn-primary">💾 Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- ===== MODAL EDIT KEGIATAN (Dengan Efek Blur) ===== --}}
<div class="modal-overlay fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden items-center justify-center p-4" id="modal-edit-kegiatan">
    <div class="modal bg-white rounded-2xl p-7 w-full max-w-2xl max-h-[90vh] overflow-y-auto relative">
        <div class="modal-header flex items-center justify-between mb-5 pb-3.5 border-b border-gray-200">
            <div class="modal-title text-base font-bold text-gray-900">Edit Kegiatan</div>
            <button class="w-8 h-8 rounded-lg bg-gray-100 text-gray-500 hover:bg-red-100 hover:text-red-500 transition flex items-center justify-center" onclick="closeModal('modal-edit-kegiatan')">✕</button>
        </div>
        <form id="form-edit-kegiatan" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3.5">
                <label class="block text-xs font-semibold text-gray-500 mb-1">Nama Kegiatan*</label>
                <input class="inp" name="title" id="edit-title" required>
            </div>
            <div class="grid grid-cols-2 gap-4 mb-3.5">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Tipe*</label>
                    <select class="inp" name="type" id="edit-type">
                        <option>Seminar</option><option>Workshop</option><option>Lomba</option><option>Rapat</option><option>Webinar</option><option>Diskusi</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Tanggal*</label>
                    <input type="date" class="inp" name="event_date" id="edit-date" required>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4 mb-3.5">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Waktu Mulai</label>
                    <input type="time" class="inp" name="start_time" id="edit-start">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Waktu Selesai</label>
                    <input type="time" class="inp" name="end_time" id="edit-end">
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4 mb-3.5">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Lokasi/Tempat*</label>
                    <input class="inp" name="location" id="edit-location" required>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">PIC</label>
                    <input class="inp" name="pic" id="edit-pic">
                </div>
            </div>
            <div class="mb-3.5">
                <label class="block text-xs font-semibold text-gray-500 mb-1">Deskripsi</label>
                <textarea class="inp" name="description" id="edit-desc" rows="3"></textarea>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Status</label>
                    <select class="inp" name="status" id="edit-status">
                        <option>Upcoming</option><option>Berlangsung</option><option>Selesai</option><option>Dibatalkan</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Kuota</label>
                    <input type="number" class="inp" name="quota" id="edit-quota">
                </div>
            </div>
            <div class="mt-5 pt-4 border-t border-gray-200 flex justify-end gap-2.5">
                <button type="button" class="btn btn-ghost" onclick="closeModal('modal-edit-kegiatan')">Batal</button>
                <button type="submit" class="btn btn-primary">💾 Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

{{-- ===== MODAL DELETE CONFIRM (Dengan Efek Blur) ===== --}}
<div class="modal-overlay fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden items-center justify-center p-4" id="modal-delete">
    <div class="modal bg-white rounded-2xl p-8 w-full max-w-[400px] text-center relative">
        <div class="text-5xl mb-4">🗑️</div>
        <div class="text-lg font-bold text-gray-900 mb-2">Hapus Data?</div>
        <div class="text-sm text-gray-500 mb-6" id="delete-msg">Data ini akan dihapus permanen dan tidak bisa dipulihkan.</div>
        
        <form id="form-delete-kegiatan" method="POST">
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
    .card { background: white; border-radius: 1rem; border: 1px solid #e5e7eb; }
</style>
@endpush

@push('scripts')
<script>
    function openModal(id) { document.getElementById(id).classList.add('open'); }
    function closeModal(id) { document.getElementById(id).classList.remove('open'); }

    // Logic Edit Modal
    document.querySelectorAll('.btn-edit').forEach(btn => {
        btn.addEventListener('click', function() {
            const ev = JSON.parse(this.dataset.event);
            const form = document.getElementById('form-edit-kegiatan');
            form.action = `/admin/kegiatan/${ev.id}`;

            document.getElementById('edit-title').value = ev.title;
            document.getElementById('edit-type').value = ev.type || 'Seminar';
            document.getElementById('edit-date').value = ev.event_date;
            document.getElementById('edit-start').value = ev.start_time ? ev.start_time.substring(0,5) : '';
            document.getElementById('edit-end').value = ev.end_time ? ev.end_time.substring(0,5) : '';
            document.getElementById('edit-location').value = ev.location;
            document.getElementById('edit-pic').value = ev.pic || '';
            document.getElementById('edit-desc').value = ev.description || '';
            document.getElementById('edit-status').value = ev.status || 'Upcoming';
            document.getElementById('edit-quota').value = ev.quota || '';

            openModal('modal-edit-kegiatan');
        });
    });

    // Logic Delete Modal
    document.querySelectorAll('.btn-delete-trigger').forEach(btn => {
        btn.addEventListener('click', function() {
            const url = this.dataset.url;
            const title = this.dataset.title;
            
            document.getElementById('form-delete-kegiatan').action = url;
            document.getElementById('delete-msg').innerHTML = `Kegiatan <b>"${title}"</b> akan dihapus permanen dan tidak bisa dipulihkan.`;
            
            openModal('modal-delete');
        });
    });

    // Logic Pencarian (Search) & Filter
    const searchInput = document.getElementById('search-input');
    const filterType = document.getElementById('filter-type');
    const eventRows = document.querySelectorAll('.event-row');
    const emptyState = document.getElementById('empty-state');

    function filterEvents() {
        const query = searchInput.value.toLowerCase();
        const type = filterType.value.toLowerCase();
        let visibleCount = 0;

        eventRows.forEach(row => {
            // Cek seluruh teks dalam baris (Judul, Lokasi, Status, Tanggal)
            const textContent = row.textContent.toLowerCase();
            // Ambil data-type untuk difilter berdasarkan select option
            const rowType = row.getAttribute('data-type'); 

            const matchesSearch = textContent.includes(query);
            const matchesType = (type === '' || rowType === type);

            if (matchesSearch && matchesType) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        // Tampilkan State "Kegiatan tidak tersedia" jika data tidak ada yg cocok
        if (eventRows.length > 0) {
            if (visibleCount === 0) {
                emptyState.style.display = '';
            } else {
                emptyState.style.display = 'none';
            }
        }
    }

    searchInput.addEventListener('input', filterEvents);
    filterType.addEventListener('change', filterEvents);

    // Kalender Logic
    (function () {
        const eventDates = @json($allEvents->pluck('event_date')->toArray());
        let current = new Date();
        current.setDate(1);

        function render() {
            const year = current.getFullYear();
            const month = current.getMonth();
            const monthNames = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
            document.getElementById('cal-title').textContent = monthNames[month] + ' ' + year;

            const grid = document.getElementById('cal-grid');
            const firstDay = new Date(year, month, 1).getDay();
            const daysInMonth = new Date(year, month + 1, 0).getDate();
            let html = '';

            for (let i = 0; i < firstDay; i++) html += '<div></div>';
            for (let d = 1; d <= daysInMonth; d++) {
                const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(d).padStart(2, '0')}`;
                const hasEvent = eventDates.includes(dateStr);
                const isToday = (new Date().toDateString() === new Date(year, month, d).toDateString());
                
                let cls = 'aspect-square flex items-center justify-center rounded-lg text-sm relative ' + (isToday ? 'bg-blue-600 text-white' : 'hover:bg-blue-50');
                const dot = hasEvent ? `<span class="absolute bottom-1 w-1 h-1 rounded-full ${isToday ? 'bg-white' : 'bg-blue-500'}"></span>` : '';
                html += `<div class="${cls}">${d}${dot}</div>`;
            }
            grid.innerHTML = html;
        }

        render();
        document.getElementById('cal-prev').onclick = () => { current.setMonth(current.getMonth() - 1); render(); };
        document.getElementById('cal-next').onclick = () => { current.setMonth(current.getMonth() + 1); render(); };
    })();
</script>
@endpush
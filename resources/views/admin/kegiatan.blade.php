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

{{-- Grid dua kartu dengan tinggi yang selalu sama (items-stretch default di grid) --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-5 mb-5" style="align-items: stretch;">

    {{-- ===== KARTU KALENDER ===== --}}
    <div class="card p-5 flex flex-col">
        <div class="flex items-center justify-between mb-4">
            <button class="btn btn-ghost btn-icon btn-sm">◀</button>
            <div class="font-bold text-[0.95rem]" id="cal-title"></div>
            <button class="btn btn-ghost btn-icon btn-sm">▶</button>
        </div>
        <div class="grid grid-cols-7 gap-1 text-center mb-1">
            @foreach(['Min','Sen','Sel','Rab','Kam','Jum','Sab'] as $day)
                <div class="text-[0.68rem] font-bold text-gray-500 uppercase py-1">{{ $day }}</div>
            @endforeach
        </div>
        <div class="grid grid-cols-7 gap-1 text-center" id="cal-grid">
            {{-- Diisi oleh JavaScript --}}
        </div>
        {{-- Spacer agar kalender mengisi sisa tinggi --}}
        <div class="flex-1"></div>
    </div>

    {{-- ===== KARTU KEGIATAN MENDATANG ===== --}}
    <div class="card p-5 flex flex-col">
        <div class="font-bold mb-3.5 text-gray-900">Kegiatan Mendatang</div>

        @if($upcomingEvents->isEmpty())
            {{-- State kosong --}}
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
                        @if($ev->description)
                            <div class="text-[0.72rem] text-gray-400 mt-0.5 line-clamp-1">{{ $ev->description }}</div>
                        @endif
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
            <tbody>
                @forelse($allEvents as $ev)
                @php
                    $isPast   = \Carbon\Carbon::parse($ev->event_date)->isPast();
                    $isToday  = \Carbon\Carbon::parse($ev->event_date)->isToday();
                    $statusLabel = $isPast  ? 'Selesai'    : ($isToday ? 'Berlangsung' : 'Upcoming');
                    $statusClass = $isPast  ? 'bg-gray-100 text-gray-600'
                                 : ($isToday ? 'bg-blue-100 text-blue-800'
                                             : 'bg-green-100 text-green-800');
                @endphp
                <tr class="border-b border-gray-50 hover:bg-blue-50 transition">
                    <td class="px-4 py-3">
                        <div class="font-semibold text-gray-900">{{ $ev->title }}</div>
                        @if($ev->description)
                            <div class="text-[0.72rem] text-gray-500 truncate max-w-xs">{{ $ev->description }}</div>
                        @endif
                    </td>
                    <td class="px-4 py-3 font-mono text-[0.8rem]">
                        {{ \Carbon\Carbon::parse($ev->event_date)->format('d M Y') }}
                    </td>
                    <td class="px-4 py-3 text-[0.82rem]">{{ $ev->location }}</td>
                    <td class="px-4 py-3">
                        <span class="{{ $statusClass }} px-2.5 py-0.5 rounded-full text-[0.7rem] font-semibold">
                            {{ $statusLabel }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-right">
                        <button class="btn btn-ghost btn-icon btn-sm text-blue-600">✏️</button>
                        <form action="{{ route('admin.event.destroy', $ev->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus kegiatan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-ghost btn-icon btn-sm text-red-500 ml-1">🗑️</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-4 py-16 text-center">
                        <div class="flex flex-col items-center gap-3 text-gray-400">
                            <div class="text-4xl opacity-40">📭</div>
                            <p class="text-sm font-semibold text-gray-500">Belum ada kegiatan</p>
                            <p class="text-xs text-gray-400">Tambahkan kegiatan pertama dengan tombol di atas.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- ===== MODAL TAMBAH KEGIATAN ===== --}}
<div class="modal-overlay fixed inset-0 bg-black/50 z-50 hidden items-center justify-center p-4" id="modal-kegiatan">
    <div class="modal bg-white rounded-2xl p-7 w-full max-w-2xl max-h-[90vh] overflow-y-auto relative">
        <div class="modal-header flex items-center justify-between mb-5 pb-3.5 border-b border-gray-200">
            <div class="modal-title text-base font-bold text-gray-900">Tambah Kegiatan</div>
            <button class="w-8 h-8 rounded-lg bg-gray-100 text-gray-500 hover:bg-red-100 hover:text-red-500 transition flex items-center justify-center" onclick="document.getElementById('modal-kegiatan').classList.remove('open')">✕</button>
        </div>

        <form action="{{ route('admin.event.store') }}" method="POST">
            @csrf
            <div class="mb-3.5">
                <label class="block text-xs font-semibold text-gray-500 mb-1">Nama Kegiatan*</label>
                <input class="inp" name="title" placeholder="Nama kegiatan" required>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-3.5">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Tanggal*</label>
                    <input type="date" class="inp" name="event_date" required>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Lokasi*</label>
                    <input class="inp" name="location" placeholder="Lokasi / Link Zoom" required>
                </div>
            </div>
            <div class="mb-3.5">
                <label class="block text-xs font-semibold text-gray-500 mb-1">Deskripsi*</label>
                <textarea class="inp" name="description" placeholder="Deskripsi singkat kegiatan..." rows="3" required></textarea>
            </div>
            <div class="mt-5 pt-4 border-t border-gray-200 flex justify-end gap-2.5">
                <button type="button" class="btn btn-ghost" onclick="document.getElementById('modal-kegiatan').classList.remove('open')">Batal</button>
                <button type="submit" class="btn btn-primary">💾 Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('styles')
<style>
.modal-overlay.open { display: flex !important; }
.line-clamp-1 { display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; overflow: hidden; }

/* Pastikan dua kartu atas selalu sama tinggi */
.grid.lg\:grid-cols-2 > .card { height: 100%; }
</style>
@endpush

@push('scripts')
<script>
// ===== KALENDER DINAMIS =====
(function () {
    // Kumpulkan tanggal event dari DB yang dikirim via PHP
    const eventDates = @json($allEvents->pluck('event_date')->map(fn($d) => \Carbon\Carbon::parse($d)->format('Y-m-d'))->toArray());

    let current = new Date();
    current.setDate(1);

    function render() {
        const year  = current.getFullYear();
        const month = current.getMonth(); // 0-based

        const monthNames = ['Januari','Februari','Maret','April','Mei','Juni',
                            'Juli','Agustus','September','Oktober','November','Desember'];
        document.getElementById('cal-title').textContent = monthNames[month] + ' ' + year;

        const grid      = document.getElementById('cal-grid');
        const today     = new Date();
        const firstDay  = new Date(year, month, 1).getDay(); // 0 = Sun
        const daysInMonth = new Date(year, month + 1, 0).getDate();

        let html = '';

        // Offset kosong sebelum hari pertama
        for (let i = 0; i < firstDay; i++) {
            html += '<div></div>';
        }

        for (let d = 1; d <= daysInMonth; d++) {
            const dateStr = year + '-'
                + String(month + 1).padStart(2, '0') + '-'
                + String(d).padStart(2, '0');
            const isToday   = (d === today.getDate() && month === today.getMonth() && year === today.getFullYear());
            const hasEvent  = eventDates.includes(dateStr);

            let cls = 'aspect-square flex flex-col items-center justify-center rounded-lg text-sm cursor-pointer transition relative ';
            if (isToday) {
                cls += 'bg-blue-600 text-white font-bold';
            } else {
                cls += 'hover:bg-blue-50';
            }

            const dot = hasEvent
                ? `<span class="absolute bottom-1 w-1.5 h-1.5 rounded-full ${isToday ? 'bg-white' : 'bg-sky-500'}"></span>`
                : '';

            html += `<div class="${cls}">${d}${dot}</div>`;
        }

        grid.innerHTML = html;
    }

    render();

    // Tombol navigasi bulan
    document.querySelectorAll('.btn-icon').forEach((btn, idx) => {
        btn.addEventListener('click', function () {
            const dir = this.textContent.includes('◀') ? -1 : 1;
            current.setMonth(current.getMonth() + dir);
            render();
        });
    });
})();
</script>
@endpush
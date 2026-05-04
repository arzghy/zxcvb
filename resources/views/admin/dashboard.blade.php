@extends('layouts.admin')

@section('page-title', 'Dashboard')
@section('page-breadcrumb', 'Overview')

@section('content')
<!-- STAT CARDS -->
<div class="grid-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4" style="margin-bottom:20px">
    <div class="stat-card">
        <div class="flex items-center justify-between mb-2.5">
            <div style="font-size:.75rem;font-weight:700;color:var(--muted);text-transform:uppercase">Total Anggota</div>
            <div style="font-size:1.4rem">👥</div>
        </div>
        <div class="mono" style="font-size:2rem;font-weight:800;color:var(--blue)">{{ $totalAnggota }}</div>
        <div style="font-size:.75rem;color:var(--success);margin-top:4px;font-weight:600">
            @if($anggotaBulanIni > 0)
                ▲ +{{ $anggotaBulanIni }} bulan ini
            @else
                — Belum ada anggota baru bulan ini
            @endif
        </div>
    </div>

    <div class="stat-card">
        <div class="flex items-center justify-between mb-2.5">
            <div style="font-size:.75rem;font-weight:700;color:var(--muted);text-transform:uppercase">Kegiatan Aktif</div>
            <div style="font-size:1.4rem">📅</div>
        </div>
        <div class="mono" style="font-size:2rem;font-weight:800;color:#0ea5e9">{{ $totalEvents }}</div>
        <div style="font-size:.75rem;color:var(--muted);margin-top:4px">
            {{ $upcomingEvents }} upcoming
        </div>
    </div>

    <div class="stat-card">
        <div class="flex items-center justify-between mb-2.5">
            <div style="font-size:.75rem;font-weight:700;color:var(--muted);text-transform:uppercase">Kamus Istilah</div>
            <div style="font-size:1.4rem">📖</div>
        </div>
        <div class="mono" style="font-size:2rem;font-weight:800;color:#f59e0b">{{ $totalDictionary }}</div>
        <div style="font-size:.75rem;color:var(--muted);margin-top:4px">Istilah tersedia</div>
    </div>

    <div class="stat-card">
        <div class="flex items-center justify-between mb-2.5">
            <div style="font-size:.75rem;font-weight:700;color:var(--muted);text-transform:uppercase">Publikasi Riset</div>
            <div style="font-size:1.4rem">📊</div>
        </div>
        <div class="mono" style="font-size:2rem;font-weight:800;color:#10b981">{{ $totalReports }}</div>
        <div style="font-size:.75rem;color:var(--success);margin-top:4px;font-weight:600">
            @if($reportsMingguIni > 0)
                ▲ +{{ $reportsMingguIni }} minggu ini
            @else
                — Belum ada upload minggu ini
            @endif
        </div>
    </div>
</div>

<div class="grid-2 grid grid-cols-1 lg:grid-cols-2 gap-5" style="margin-bottom:20px">
    <!-- Aktivitas Terbaru -->
    <div class="card p-5">
        <div class="section-header flex items-center justify-between mb-5 mt-2 gap-3 flex-wrap">
            <div>
                <div class="section-title text-lg font-bold text-gray-900">Aktivitas Terbaru</div>
                <div class="section-sub text-sm text-gray-500">Log perubahan terkini dari database</div>
            </div>
        </div>
        <div id="activity-log">
            @forelse($activities as $act)
            <div class="activity-item flex gap-3 py-3 border-b border-gray-100">
                <div class="activity-dot w-2 h-2 rounded-full {{ $act['color'] }} shrink-0 mt-1.5"></div>
                <div>
                    <div style="font-size:.85rem;font-weight:600">{{ $act['text'] }}</div>
                    <div style="font-size:.72rem;color:var(--muted)">
                        {{ \Carbon\Carbon::parse($act['time'])->diffForHumans() }}
                        &nbsp;·&nbsp;
                        {{ \Carbon\Carbon::parse($act['time'])->format('d M Y, H:i') }} WIB
                    </div>
                </div>
            </div>
            @empty
            <div class="py-10 text-center text-gray-400 text-sm">
                <div class="text-3xl mb-2">📭</div>
                Belum ada aktivitas tercatat.
            </div>
            @endforelse
        </div>
    </div>

    <!-- Chart Pertumbuhan Anggota — SVG Dinamis -->
    <div class="card p-5">
        <div class="section-header flex items-center justify-between mb-5 mt-2 gap-3 flex-wrap">
            <div>
                <div class="section-title text-lg font-bold text-gray-900">Pertumbuhan Anggota</div>
                <div class="section-sub text-sm text-gray-500">6 bulan terakhir (kumulatif)</div>
            </div>
            <span class="badge badge-blue inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">Line Chart</span>
        </div>
        <div style="width:100%;overflow:hidden" id="member-chart"></div>
        <div class="mt-3.5 flex gap-5 flex-wrap">
            <div>
                <div style="font-size:.72rem;color:var(--muted)">Total Anggota</div>
                <div style="font-size:1.3rem;font-weight:800;color:var(--blue)">{{ $totalAnggota }}</div>
            </div>
            <div>
                <div style="font-size:.72rem;color:var(--muted)">Baru bulan ini</div>
                <div style="font-size:1.3rem;font-weight:800;color:#10b981">+{{ $anggotaBulanIni }}</div>
            </div>
            @php
                $lastV = collect($memberGrowth)->pluck('v')->filter()->last() ?? 0;
                $prevV = collect($memberGrowth)->pluck('v')->filter()->nth(1)->reverse()->skip(1)->first() ?? 0;
                $activePct = $totalAnggota > 0 ? round(($totalAnggota / max($lastV, 1)) * 100) : 0;
            @endphp
            <div>
                <div style="font-size:.72rem;color:var(--muted)">Total User</div>
                <div style="font-size:1.3rem;font-weight:800;color:#0ea5e9">{{ \App\Models\User::count() }}</div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Access -->
<div class="card p-5 mb-5">
    <div class="section-title text-lg font-bold text-gray-900" style="margin-bottom:16px">Quick Access</div>
    <div class="flex gap-2.5 flex-wrap">
        <a href="{{ url('admin/anggota') }}" class="btn btn-primary text-sm">👤 Tambah Anggota</a>
        <a href="{{ url('admin/kegiatan') }}" class="btn btn-outline border-blue-600 text-blue-700 bg-white text-sm">📅 Buat Kegiatan</a>
        <a href="{{ url('admin/riset') }}" class="btn btn-outline border-blue-600 text-blue-700 bg-white text-sm">📊 Upload Riset</a>
        <a href="{{ url('admin/pengumuman') }}" class="btn btn-outline border-blue-600 text-blue-700 bg-white text-sm">📢 Buat Pengumuman</a>
        <a href="{{ url('admin/kamus') }}" class="btn btn-outline border-blue-600 text-blue-700 bg-white text-sm">📖 Tambah Kamus</a>
        <a href="{{ url('admin/gallery') }}" class="btn btn-outline border-blue-600 text-blue-700 bg-white text-sm">🖼️ Upload Foto</a>
        <a href="{{ url('admin/rekrutmen') }}" class="btn btn-outline border-blue-600 text-blue-700 bg-white text-sm">🎯 Buka Rekrutmen</a>
        <a href="{{ url('admin/kalkulator') }}" class="btn btn-ghost border-gray-300 text-gray-600 bg-white text-sm">🧮 Kalkulator Saham</a>
    </div>
</div>

<!-- GRAFIK TAMBAHAN DASHBOARD -->
<div style="margin-top:20px">
    <div class="section-header flex items-center justify-between mb-5 mt-2 gap-3 flex-wrap" style="margin-bottom:16px">
        <div>
            <div class="section-title text-lg font-bold text-gray-900">📊 Grafik Aktivitas Database</div>
            <div class="section-sub text-sm text-gray-500">Event & riset yang diinput per bulan (6 bulan terakhir)</div>
        </div>
    </div>

    <!-- Row 1: Event & Report per bulan -->
    <div class="grid-2 grid grid-cols-1 lg:grid-cols-2 gap-5" style="margin-bottom:20px">
        <!-- Event per bulan -->
        <div class="card p-5">
            <div class="section-header flex items-center justify-between mt-2 gap-3 flex-wrap mb-4">
                <div>
                    <div class="section-title text-lg font-bold text-gray-900" style="font-size:.95rem">📅 Event Diinput per Bulan</div>
                    <div class="section-sub text-sm text-gray-500">Jumlah event yang ditambahkan ke database</div>
                </div>
                <span class="badge badge-blue inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">{{ $totalEvents }} total</span>
            </div>
            <div class="relative h-[180px] w-full">
                <canvas id="chart-events-monthly"></canvas>
            </div>
            <div class="mt-3.5 flex gap-5 flex-wrap">
                <div>
                    <div style="font-size:.72rem;color:var(--muted)">Total Event</div>
                    <div style="font-size:1.2rem;font-weight:800;color:var(--blue)">{{ $totalEvents }}</div>
                </div>
                <div>
                    <div style="font-size:.72rem;color:var(--muted)">Upcoming</div>
                    <div style="font-size:1.2rem;font-weight:800;color:#10b981">{{ $upcomingEvents }}</div>
                </div>
            </div>
        </div>

        <!-- Report per bulan -->
        <div class="card p-5">
            <div class="section-header flex items-center justify-between mt-2 gap-3 flex-wrap mb-4">
                <div>
                    <div class="section-title text-lg font-bold text-gray-900" style="font-size:.95rem">📊 Riset Diupload per Bulan</div>
                    <div class="section-sub text-sm text-gray-500">Jumlah laporan yang diupload ke database</div>
                </div>
                <span class="badge badge-green inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-green-100 text-green-800">{{ $totalReports }} total</span>
            </div>
            <div class="relative h-[180px] w-full">
                <canvas id="chart-reports-monthly"></canvas>
            </div>
            <div class="mt-3.5 flex gap-5 flex-wrap">
                <div>
                    <div style="font-size:.72rem;color:var(--muted)">Total Riset</div>
                    <div style="font-size:1.2rem;font-weight:800;color:var(--blue)">{{ $totalReports }}</div>
                </div>
                <div>
                    <div style="font-size:.72rem;color:var(--muted)">Minggu ini</div>
                    <div style="font-size:1.2rem;font-weight:800;color:#10b981">+{{ $reportsMingguIni }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Row 2: Top Events & Top Reports -->
    <div class="grid-2 grid grid-cols-1 lg:grid-cols-2 gap-5 mb-5">
        <!-- Top Events -->
        <div class="card p-5">
            <div class="section-header flex items-center justify-between mt-2 gap-3 flex-wrap mb-4">
                <div>
                    <div class="section-title text-lg font-bold text-gray-900" style="font-size:.95rem">📅 Event Terbaru</div>
                    <div class="section-sub text-sm text-gray-500">Event terbaru yang tersimpan di database</div>
                </div>
                <span class="badge badge-purple inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-violet-100 text-violet-800">Database</span>
            </div>
            @forelse($topEvents as $ev)
            <div class="flex items-center justify-between py-2 border-b border-gray-50 text-sm">
                <div class="truncate pr-3 text-gray-800 font-medium" style="max-width:200px" title="{{ $ev['full'] }}">
                    {{ $ev['full'] }}
                </div>
                <div class="font-mono text-xs text-blue-600 font-bold shrink-0">{{ $ev['klik'] }} views</div>
            </div>
            @empty
            <div class="py-8 text-center text-gray-400 text-sm">Belum ada data event.</div>
            @endforelse
        </div>

        <!-- Top Reports -->
        <div class="card p-5">
            <div class="section-header flex items-center justify-between mt-2 gap-3 flex-wrap mb-4">
                <div>
                    <div class="section-title text-lg font-bold text-gray-900" style="font-size:.95rem">📊 Riset Terbaru</div>
                    <div class="section-sub text-sm text-gray-500">Laporan terbaru yang tersimpan di database</div>
                </div>
                <span class="badge badge-orange inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-100 text-amber-800">Database</span>
            </div>
            @forelse($topReports as $rp)
            <div class="flex items-center justify-between py-2 border-b border-gray-50 text-sm">
                <div class="truncate pr-3 text-gray-800 font-medium" style="max-width:200px" title="{{ $rp['full'] }}">
                    {{ $rp['full'] }}
                </div>
                <div class="font-mono text-xs text-amber-600 font-bold shrink-0">{{ $rp['klik'] }} views</div>
            </div>
            @empty
            <div class="py-8 text-center text-gray-400 text-sm">Belum ada data riset.</div>
            @endforelse
        </div>
    </div>

    <!-- Upcoming Events List dari DB -->
    @if($upcomingEventList->count() > 0)
    <div class="card p-5 mb-5">
        <div class="font-bold mb-3.5 text-gray-900">📆 Kegiatan Mendatang (dari Database)</div>
        <div class="flex flex-col gap-2.5">
            @foreach($upcomingEventList as $ev)
            <div class="flex gap-3 p-2.5 rounded-xl border border-gray-200 hover:border-blue-500 transition">
                <div class="text-center w-10 shrink-0 border-r border-gray-100 pr-2">
                    <div class="font-mono font-extrabold text-blue-600 text-lg">
                        {{ \Carbon\Carbon::parse($ev->event_date)->format('d') }}
                    </div>
                    <div class="text-[0.65rem] text-gray-500">
                        {{ \Carbon\Carbon::parse($ev->event_date)->format('M') }}
                    </div>
                </div>
                <div>
                    <div class="text-[0.85rem] font-semibold text-gray-900">{{ $ev->title }}</div>
                    <div class="text-[0.72rem] text-gray-500 mt-0.5">📍 {{ $ev->location }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>
<script>
// ============================================================
// DATA DARI PHP/BLADE — dikirim sebagai JSON ke JavaScript
// ============================================================
const memberGrowthData = @json($memberGrowth);

const eventChartLabels = @json($eventChartLabels);
const eventChartData   = @json($eventChartData);

const reportChartLabels = @json($reportChartLabels);
const reportChartData   = @json($reportChartData);

// ============================================================
// HELPER FUNCTIONS
// ============================================================
function hexToRgb(hex) {
    return [
        parseInt(hex.slice(1,3),16),
        parseInt(hex.slice(3,5),16),
        parseInt(hex.slice(5,7),16)
    ].join(',');
}

function buildGradient(canvasEl, hex, alpha1=0.22, alpha2=0) {
    const ctx  = canvasEl.getContext('2d');
    const h    = canvasEl.parentElement ? canvasEl.parentElement.offsetHeight : 200;
    const grad = ctx.createLinearGradient(0, 0, 0, h || 200);
    grad.addColorStop(0, `rgba(${hexToRgb(hex)},${alpha1})`);
    grad.addColorStop(1, `rgba(${hexToRgb(hex)},${alpha2})`);
    return grad;
}

function buildLineDataset(canvasEl, data, color, label) {
    return {
        label: label || 'Data',
        data,
        borderColor: color,
        borderWidth: 2.5,
        backgroundColor: buildGradient(canvasEl, color),
        pointBackgroundColor: color,
        pointBorderColor: '#fff',
        pointBorderWidth: 2,
        pointRadius: 4,
        tension: 0.42,
        fill: true,
    };
}

const sharedOptions = (extraTooltip = {}) => ({
    responsive: true,
    maintainAspectRatio: false,
    interaction: { mode: 'index', intersect: false },
    plugins: {
        legend: { display: false },
        tooltip: {
            backgroundColor: 'rgba(13,15,26,0.90)',
            padding: 12,
            cornerRadius: 10,
            ...extraTooltip,
        }
    },
    scales: {
        x: { grid: { display: false }, border: { display: false } },
        y: {
            beginAtZero: true,
            ticks: { precision: 0 },   // Nilai Y hanya bilangan bulat
            grid: { color: 'rgba(208,213,232,0.35)' },
            border: { display: false }
        }
    }
});

// ============================================================
// SVG LINE CHART — Pertumbuhan Anggota
// ============================================================
function renderLineChartSVG(containerId, data, color1) {
    const el = document.getElementById(containerId);
    if (!el) return;

    const W   = el.offsetWidth || 340;
    const H   = 150;
    const pad = { t: 20, r: 16, b: 30, l: 38 };
    const cw  = W - pad.l - pad.r;
    const ch  = H - pad.t - pad.b;

    const values = data.map(d => d.v);
    const min    = Math.min(...values);
    const max    = Math.max(...values);
    const range  = max - min || 1;

    const xs = data.map((_, i) => pad.l + (i / (data.length - 1)) * cw);
    const ys = data.map(d => pad.t + ch - ((d.v - min) / range) * ch);

    const line = xs.map((x, i) => `${i === 0 ? 'M' : 'L'}${x.toFixed(1)},${ys[i].toFixed(1)}`).join(' ');
    const area = `${line} L${xs[xs.length-1].toFixed(1)},${(pad.t+ch).toFixed(1)} L${xs[0].toFixed(1)},${(pad.t+ch).toFixed(1)} Z`;

    const yTicks = [0, 0.5, 1].map(f => ({
        y: pad.t + ch - f * ch,
        v: Math.round(min + f * range)
    }));

    const gradId = 'grad-' + containerId.replace(/[^a-z]/gi, '');

    el.innerHTML = `<svg viewBox="0 0 ${W} ${H}" style="width:100%;height:${H}px;display:block;overflow:visible">
        <defs>
            <linearGradient id="${gradId}" x1="0" y1="0" x2="0" y2="1">
                <stop offset="0%" stop-color="${color1}" stop-opacity="0.2"/>
                <stop offset="100%" stop-color="${color1}" stop-opacity="0.01"/>
            </linearGradient>
        </defs>
        ${yTicks.map(t => `
            <line x1="${pad.l}" y1="${t.y.toFixed(1)}" x2="${(W-pad.r).toFixed(1)}" y2="${t.y.toFixed(1)}" stroke="#e8ecfb" stroke-width="1"/>
            <text x="${(pad.l-5).toFixed(1)}" y="${t.y.toFixed(1)}" text-anchor="end" dominant-baseline="middle" fill="#94a3b8" font-size="9" font-family="monospace">${t.v}</text>
        `).join('')}
        ${data.map((d, i) => `
            <text x="${xs[i].toFixed(1)}" y="${(H-4).toFixed(1)}" text-anchor="middle" fill="#94a3b8" font-size="9" font-family="sans-serif">${d.m}</text>
        `).join('')}
        <path d="${area}" fill="url(#${gradId})"/>
        <path d="${line}" fill="none" stroke="${color1}" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
        ${data.map((d, i) => `
            <circle cx="${xs[i].toFixed(1)}" cy="${ys[i].toFixed(1)}" r="4.5" fill="${color1}" stroke="#fff" stroke-width="2.5">
                <title>${d.m}: ${d.v} anggota (+${d.new} baru)</title>
            </circle>
        `).join('')}
    </svg>`;
}

// ============================================================
// INIT SEMUA CHART SAAT DOM READY
// ============================================================
document.addEventListener('DOMContentLoaded', () => {

    // 1. SVG Member Growth
    renderLineChartSVG('member-chart', memberGrowthData, '#1a2fb5');

    // 2. Event per bulan (Chart.js bar)
    const cEv = document.getElementById('chart-events-monthly');
    if (cEv) {
        new Chart(cEv, {
            type: 'bar',
            data: {
                labels: eventChartLabels,
                datasets: [{
                    label: 'Event',
                    data: eventChartData,
                    backgroundColor: 'rgba(14,165,233,0.8)',
                    borderColor: '#0ea5e9',
                    borderWidth: 1.5,
                    borderRadius: 8,
                }]
            },
            options: sharedOptions({
                callbacks: { label: ctx => `  Event: ${ctx.parsed.y}` }
            })
        });
    }

    // 3. Report per bulan (Chart.js line)
    const cRp = document.getElementById('chart-reports-monthly');
    if (cRp) {
        new Chart(cRp, {
            type: 'line',
            data: {
                labels: reportChartLabels,
                datasets: [buildLineDataset(cRp, reportChartData, '#10b981', 'Riset')]
            },
            options: sharedOptions({
                callbacks: { label: ctx => `  Riset: ${ctx.parsed.y}` }
            })
        });
    }
});
</script>
@endpush
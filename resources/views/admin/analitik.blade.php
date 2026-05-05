@extends('layouts.admin')

@section('page-title', 'Analitik Pengguna')
@section('page-breadcrumb', 'Sistem Informasi Manajemen')

@section('content')
<div class="p-6 bg-[#f8fafc] min-h-screen">
    <!-- 2. SUB-HEADER & FILTER -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                <span class="text-xl">📉</span> Analitik Pengguna
            </h2>
            <p class="text-xs text-gray-500 mt-1">Statistik sistem informasi manajemen — data pengguna, emiten favorit & fitur terpopuler</p>
        </div>
        <div class="flex items-center gap-3">
            <select class="border border-gray-200 rounded-lg px-3 py-2 text-sm bg-white text-gray-600 focus:outline-none shadow-sm">
                <option>30 Hari Terakhir</option>
                <option>7 Hari Terakhir</option>
            </select>
            <button class="border border-gray-200 rounded-lg px-4 py-2 text-sm bg-white text-blue-600 font-medium flex items-center gap-2 shadow-sm hover:bg-gray-50 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                Refresh
            </button>
        </div>
    </div>

    <!-- 3. METRIC CARDS (4 Columns) -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <!-- User Registrasi -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
            <div class="flex justify-between items-center mb-3">
                <h3 class="text-[11px] font-bold text-gray-500 tracking-wider uppercase">User Registrasi</h3>
                <span class="text-indigo-900 font-bold">👤</span>
            </div>
            <div class="text-4xl font-bold text-purple-600 mb-2">{{ number_format($totalUsers ?? 0) }}</div>
            <div class="text-xs font-semibold text-emerald-500 flex items-center gap-1">
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd"></path></svg>
                +{{ $usersThisMonth ?? 0 }} bulan ini
            </div>
        </div>

        <!-- Bukan Anggota -->
        <div class="bg-white rounded-xl shadow-sm border-2 border-blue-500 p-5 relative">
            <div class="flex justify-between items-center mb-3">
                <h3 class="text-[11px] font-bold text-gray-500 tracking-wider uppercase">Bukan Anggota</h3>
                <span class="text-xl">🙋‍♂️</span>
            </div>
            <div class="text-4xl font-bold text-blue-500 mb-2">{{ number_format($nonAnggota ?? 0) }}</div>
            <p class="text-xs font-medium text-gray-500">Mahasiswa umum</p>
        </div>

        <!-- View Website -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
            <div class="flex justify-between items-center mb-3">
                <h3 class="text-[11px] font-bold text-gray-500 tracking-wider uppercase">View Website</h3>
                <span class="text-gray-400">👁️</span>
            </div>
            <div class="text-4xl font-bold text-cyan-500 mb-2">{{ number_format($totalViews ?? 0) }}</div>
            <div class="text-xs font-semibold text-emerald-500 flex items-center gap-1">
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd"></path></svg>
                +12% minggu ini
            </div>
        </div>

        <!-- Fitur Aktif -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
            <div class="flex justify-between items-center mb-3">
                <h3 class="text-[11px] font-bold text-gray-500 tracking-wider uppercase">Fitur Aktif</h3>
                <span class="text-orange-500">⚡</span>
            </div>
            <div class="text-4xl font-bold text-emerald-500 mb-2">{{ $fiturAktif ?? 0 }}</div>
            <p class="text-xs font-medium text-emerald-600">Fitur digunakan</p>
        </div>
    </div>

    <!-- 4. PERTUMBUHAN USER SECTION -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-8 relative">
        <div class="absolute top-6 right-6 bg-purple-100 text-purple-700 text-xs font-bold px-4 py-1 rounded-full uppercase tracking-wider">
            Non-Anggota
        </div>
        <div class="flex items-center gap-2 mb-2">
            <span class="text-indigo-900">👤</span>
            <h3 class="text-lg font-bold text-gray-800">Pertumbuhan User Registrasi</h3>
        </div>
        <p class="text-sm text-gray-400 mb-8">User terdaftar (bukan anggota KSPM) per bulan</p>
        
        <div class="flex gap-12">
            <div>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Total Terdaftar</p>
                <p class="text-3xl font-bold text-purple-600">{{ number_format($totalUsers ?? 0) }}</p>
            </div>
            <div>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Bulan ini</p>
                <p class="text-3xl font-bold text-emerald-500">+{{ $usersThisMonth ?? 0 }}</p>
            </div>
            <div>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Rata-rata/bln</p>
                <p class="text-3xl font-bold text-cyan-500">+{{ $avgPerMonth ?? 0 }}</p>
            </div>
        </div>
    </div>

    <!-- 5. TRIGGER KLIK (RISET & EVENT) -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <!-- Riset Trigger -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 flex flex-col justify-between min-h-[250px]">
            <div>
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h3 class="font-bold text-gray-800 flex items-center gap-2 text-lg">
                            📊 Trigger Klik — Riset & Publikasi
                        </h3>
                        <p class="text-sm text-gray-400 mt-1">Jumlah orang yang melihat per judul riset/publikasi</p>
                    </div>
                    <span class="bg-purple-100 text-purple-600 text-[10px] font-black px-3 py-1 rounded-full uppercase">Klik</span>
                </div>
            </div>
            <div class="mt-auto border-t border-gray-50 pt-4 flex items-center gap-2">
                <span class="text-rose-500">📌</span>
                <p class="text-sm font-medium text-gray-500">
                    Terbanyak: <span class="text-indigo-600 font-bold">{{ $topReport->title ?? 'N/A' }}</span> 
                    — <span class="text-gray-800 font-bold">{{ $topReport->views ?? 0 }} klik</span>
                </p>
            </div>
        </div>

        <!-- Event Trigger -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 flex flex-col justify-between min-h-[250px]">
            <div>
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h3 class="font-bold text-gray-800 flex items-center gap-2 text-lg">
                            🎯 Trigger Klik — Event KSPM
                        </h3>
                        <p class="text-sm text-gray-400 mt-1">Jumlah orang yang melihat per event/kegiatan</p>
                    </div>
                    <span class="bg-orange-100 text-orange-600 text-[10px] font-black px-3 py-1 rounded-full uppercase">Klik</span>
                </div>
            </div>
            <div class="mt-auto border-t border-gray-50 pt-4 flex items-center gap-2">
                <span class="text-orange-500">🏆</span>
                <p class="text-sm font-medium text-gray-500">
                    Terbanyak: <span class="text-orange-600 font-bold">{{ $topEvent->name ?? $topEvent->title ?? 'N/A' }}</span> 
                    — <span class="text-gray-800 font-bold">{{ $topEvent->views ?? 0 }} klik</span>
                </p>
            </div>
        </div>
    </div>

    <!-- 6. INSIGHT & REKOMENDASI (Full Width) -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
        <div class="mb-8">
            <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                💡 Insight & Rekomendasi
            </h3>
            <p class="text-sm text-gray-400 mt-1">Analisis otomatis berdasarkan data sistem</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Box 1 -->
            <div class="bg-[#fdfaff] border-l-4 border-purple-500 rounded-xl p-6 shadow-sm">
                <h4 class="text-[10px] font-black text-purple-800 uppercase tracking-widest mb-3 flex items-center gap-2">
                    📝 Pertumbuhan User
                </h4>
                <p class="text-sm text-gray-600 leading-relaxed">
                    Pertumbuhan user non-anggota mencapai <span class="font-bold text-purple-600">+{{ $usersThisMonth ?? 0 }} user</span> bulan ini. 
                    Pertimbangkan kampanye konversi ke anggota resmi KSPM.
                </p>
            </div>

            <!-- Box 2 -->
            <div class="bg-[#f5fbff] border-l-4 border-blue-500 rounded-xl p-6 shadow-sm">
                <h4 class="text-[10px] font-black text-blue-800 uppercase tracking-widest mb-3 flex items-center gap-2">
                    👁️ Traffic Website
                </h4>
                <p class="text-sm text-gray-600 leading-relaxed">
                    Jumat memiliki traffic tertinggi ({{ number_format($totalViews ?? 0) }} views). Jadwalkan posting konten pada 
                    hari Kamis—Jumat untuk jangkauan maksimal.
                </p>
            </div>

            <!-- Box 3 -->
            <div class="bg-[#f6fffb] border-l-4 border-emerald-500 rounded-xl p-6 shadow-sm">
                <h4 class="text-[10px] font-black text-emerald-800 uppercase tracking-widest mb-3 flex items-center gap-2">
                    ⚡ Fitur Terpopuler
                </h4>
                <p class="text-sm text-gray-600 leading-relaxed">
                    <span class="font-bold text-emerald-600">{{ $topFeature ?? 'Kalkulator Saham' }}</span> adalah fitur paling 
                    sering diakses. Tingkatkan fitur ini dengan lebih banyak jenis kalkulasi investasi.
                </p>
            </div>
        </div>
    </div>

    <!-- Quick Links Navigation -->
    <div class="mt-8 flex gap-6">
        @if(Route::has('admin.report.index'))
            <a href="{{ route('admin.report.index') }}" class="text-[10px] font-black text-blue-600 hover:underline tracking-widest uppercase">→ Manajemen Riset</a>
        @endif
        @if(Route::has('admin.event.index'))
            <a href="{{ route('admin.event.index') }}" class="text-[10px] font-black text-blue-600 hover:underline tracking-widest uppercase">→ Kelola Event</a>
        @endif
    </div>
</div>
@endsection

@push('styles')
<style>
.fitur-row { display:flex; align-items:center; gap:10px; margin-bottom:8px; animation:fadeInRight .4s ease both; }
.fitur-icon { width:32px; height:32px; display:flex; justify-content:center; align-items:center; background:#f0f4ff; border-radius:8px; }
.fitur-info { flex:1; }
.fitur-name { font-size:0.85rem; font-weight:600; margin-bottom:4px; }
.fitur-bar-track { height:6px; background:#e2e8f0; border-radius:4px; overflow:hidden; }
.fitur-bar-fill { height:100%; border-radius:4px; transition:width 0.8s cubic-bezier(.4,0,.2,1); }
.fitur-pct { font-size:0.8rem; font-weight:700; width:40px; text-align:right; }
.fitur-legend-item { font-size:0.75rem; color:#64748b; display:flex; align-items:center; gap:4px; }
.fitur-legend-dot { width:8px; height:8px; border-radius:50%; }
@keyframes fadeInRight { from { opacity:0; transform:translateX(20px); } to { opacity:1; transform:translateX(0); } }
</style>
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>
<script>
// Data Setup
const analitikViewHarian = { labels: ['Sen','Sel','Rab','Kam','Jum','Sab','Min'], data: [224, 318, 287, 352, 412, 195, 154] };
const analitikViewMingguan = { labels: ['Mgg 1','Mgg 2','Mgg 3','Mgg 4'], data: [1820, 2214, 1948, 1366] };
const risetKlikData = { labels: ['W.Outlook Vol.12','W.Outlook Vol.11','Analisis BBCA','Analisis GOTO','Screening April','W.Outlook Vol.10'], shortLabels: ['WO.12','WO.11','BBCA','GOTO','Apr','WO.10'], data: [412, 347, 298, 276, 231, 184] };
const eventKlikData = { labels: ['SPM Batch 2','Webinar IPO','Workshop TA','Seminar BEI','KSPM Cup','School of IPB'], shortLabels: ['SPM B2','Web.IPO','WS TA','Sem BEI','KSPM Cup','SoIPB'], data: [538, 421, 384, 312, 267, 195] };
const fiturData = [
    {icon:'🧮', name:'Kalkulator Saham', usage:2840, color:'#8b5cf6'},
    {icon:'📈', name:'Data Pasar & IHSG', usage:2415, color:'#3b82f6'},
    {icon:'📊', name:'Riset & Publikasi', usage:1640, color:'#10b981'},
    {icon:'🏆', name:'Info Lomba', usage:1280, color:'#f59e0b'},
    {icon:'📖', name:'Kamus Investasi', usage:1050, color:'#6366f1'},
];
const userRegData = [{m:'Nov', v:8}, {m:'Des', v:11}, {m:'Jan', v:14}, {m:'Feb', v:19}, {m:'Mar', v:16}, {m:'Apr', v:24}];

let chartAViewH, chartARiset, chartAEvent;
let analitikViewMode = 'harian';

function hexToRgb(hex) { return [parseInt(hex.slice(1,3),16), parseInt(hex.slice(3,5),16), parseInt(hex.slice(5,7),16)].join(','); }
function buildGradient(canvasEl, hex, alpha1=0.22, alpha2=0) {
    const ctx = canvasEl.getContext('2d');
    const grad = ctx.createLinearGradient(0, 0, 0, 200);
    grad.addColorStop(0, `rgba(${hexToRgb(hex)},${alpha1})`);
    grad.addColorStop(1, `rgba(${hexToRgb(hex)},${alpha2})`);
    return grad;
}

const sharedOptions = (extraTooltip={}) => ({
    responsive: true, maintainAspectRatio: false, interaction: { mode: 'index', intersect: false },
    plugins: { legend: { display: false }, tooltip: { backgroundColor: 'rgba(13,15,26,0.90)', padding: 12, cornerRadius: 10, ...extraTooltip } },
    scales: { x: { grid: { display: false }, border: { display: false } }, y: { beginAtZero: true, grid: { color: 'rgba(208,213,232,0.35)' }, border: { display: false } } }
});

// SVG Chart Function
function renderLineChartSVG(containerId, data, color1) {
    const el = document.getElementById(containerId);
    if (!el) return;
    const W = el.offsetWidth || 340, H = 150;
    const pad = {t:20,r:16,b:30,l:38};
    const cw = W - pad.l - pad.r, ch = H - pad.t - pad.b;
    const min = Math.min(...data.map(d=>d.v)), max = Math.max(...data.map(d=>d.v));
    const range = max - min || 1;
    const xs = data.map((_,i)=> pad.l + (i/(data.length-1))*cw);
    const ys = data.map(d=> pad.t + ch - ((d.v - min)/range)*ch);
    const line = xs.map((x,i)=>`${i===0?'M':'L'}${x.toFixed(1)},${ys[i].toFixed(1)}`).join(' ');
    const area = `${line} L${xs[xs.length-1].toFixed(1)},${(pad.t+ch).toFixed(1)} L${xs[0].toFixed(1)},${(pad.t+ch).toFixed(1)} Z`;
    const yTicks = [0,0.5,1].map(f=>({y:pad.t+ch-f*ch,v:Math.round(min+f*range)}));
    const gradId='grad-'+containerId.replace(/[^a-z]/gi,'');
    el.innerHTML=`<svg viewBox="0 0 ${W} ${H}" style="width:100%;height:${H}px;display:block;overflow:visible">
        <defs><linearGradient id="${gradId}" x1="0" y1="0" x2="0" y2="1"><stop offset="0%" stop-color="${color1}" stop-opacity="0.2"/><stop offset="100%" stop-color="${color1}" stop-opacity="0.01"/></linearGradient></defs>
        ${yTicks.map(t=>`<line x1="${pad.l}" y1="${t.y.toFixed(1)}" x2="${(W-pad.r).toFixed(1)}" y2="${t.y.toFixed(1)}" stroke="#e8ecfb" stroke-width="1"/><text x="${(pad.l-5).toFixed(1)}" y="${t.y.toFixed(1)}" text-anchor="end" dominant-baseline="middle" fill="#94a3b8" font-size="9" font-family="monospace">${t.v}</text>`).join('')}
        ${data.map((d,i)=>`<text x="${xs[i].toFixed(1)}" y="${(H-4).toFixed(1)}" text-anchor="middle" fill="#94a3b8" font-size="9" font-family="sans-serif">${d.m}</text>`).join('')}
        <path d="${area}" fill="url(#${gradId})"/><path d="${line}" fill="none" stroke="${color1}" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path>
        ${data.map((d,i)=>`<circle cx="${xs[i].toFixed(1)}" cy="${ys[i].toFixed(1)}" r="4.5" fill="${color1}" stroke="#fff" stroke-width="2.5"></circle>`).join('')}
    </svg>`;
}

function renderFiturChart() {
    const wrap = document.getElementById('chart-fitur');
    const legend = document.getElementById('fitur-legend');
    if (!wrap) return;
    const max = fiturData[0].usage;
    const totalUsage = fiturData.reduce((s,d)=>s+d.usage,0);
    wrap.innerHTML = fiturData.map((d, i) => {
        const pctTotal = Math.round((d.usage/totalUsage)*100);
        return `<div class="fitur-row" style="animation-delay:${i*0.07}s">
            <div class="fitur-icon text-lg">${d.icon}</div>
            <div class="fitur-info">
                <div class="fitur-name">${d.name}</div>
                <div class="fitur-bar-track"><div class="fitur-bar-fill" id="fbar-${i}" style="background:linear-gradient(90deg,${d.color},${d.color}aa);width:0"></div></div>
            </div>
            <div class="fitur-pct" style="color:${d.color}">${pctTotal}%</div>
        </div>`;
    }).join('');

    if (legend) {
        legend.innerHTML = fiturData.map(d => `<div class="fitur-legend-item"><div class="fitur-legend-dot" style="background:${d.color}"></div>${d.name.split(' ')[0]}</div>`).join('');
    }

    fiturData.forEach((d, i) => {
        const bar = document.getElementById('fbar-'+i);
        if (bar) setTimeout(() => { bar.style.width = Math.round((d.usage/max)*100) + '%'; }, i * 100 + 250);
    });
}

document.addEventListener('DOMContentLoaded', () => {
    // 1. Line SVG User Registration
    renderLineChartSVG('chart-user-reg', userRegData, '#8b5cf6');

    // 2. Fitur List Chart
    renderFiturChart();

    // 3. Chart.js init
    const cv = document.getElementById('chartViewHarian');
    if(cv) chartAViewH = new Chart(cv, { type: 'line', data: { labels: analitikViewHarian.labels, datasets: [{ label: 'Views', data: analitikViewHarian.data, borderColor: '#0ea5e9', borderWidth: 2.5, backgroundColor: buildGradient(cv, '#0ea5e9'), pointBackgroundColor: '#0ea5e9', pointBorderColor: '#fff', pointRadius: 4, tension: 0.42, fill: true }] }, options: sharedOptions({ callbacks: { label: ctx => `  Views: ${ctx.parsed.y.toLocaleString('id-ID')}` } }) });

    const cr = document.getElementById('chartRisetKlik');
    if(cr) chartARiset = new Chart(cr, { type: 'bar', data: { labels: risetKlikData.shortLabels, datasets: [{ label: 'Klik', data: risetKlikData.data, backgroundColor: ['rgba(139,92,246,0.85)','rgba(139,92,246,0.75)','rgba(139,92,246,0.65)','rgba(139,92,246,0.58)','rgba(139,92,246,0.50)','rgba(139,92,246,0.43)'], borderColor: '#8b5cf6', borderWidth: 1.5, borderRadius: 8 }] }, options: sharedOptions({ callbacks: { title: i => risetKlikData.labels[i[0].dataIndex], label: ctx => `  Klik: ${ctx.parsed.y.toLocaleString('id-ID')}` } }) });

    const ce = document.getElementById('chartEventKlik');
    if(ce) chartAEvent = new Chart(ce, { type: 'bar', data: { labels: eventKlikData.shortLabels, datasets: [{ label: 'Klik', data: eventKlikData.data, backgroundColor: ['rgba(245,158,11,0.88)','rgba(245,158,11,0.76)','rgba(245,158,11,0.66)','rgba(245,158,11,0.58)','rgba(245,158,11,0.50)','rgba(245,158,11,0.43)'], borderColor: '#f59e0b', borderWidth: 1.5, borderRadius: 8 }] }, options: sharedOptions({ callbacks: { title: i => eventKlikData.labels[i[0].dataIndex], label: ctx => `  Klik: ${ctx.parsed.y.toLocaleString('id-ID')}` } }) });
});

function toggleViewChart(mode) {
    analitikViewMode = mode;
    const btnH = document.getElementById('vbtn-harian'), btnM = document.getElementById('vbtn-mingguan');
    if (mode === 'harian') {
        btnH && (btnH.style.borderColor='var(--blue)', btnH.style.color='var(--blue)'); btnM && (btnM.style.borderColor='', btnM.style.color='');
        document.getElementById('vstat-total').textContent='1.942'; document.getElementById('vstat-avg').textContent='277'; document.getElementById('vstat-peak').textContent='412';
    } else {
        btnM && (btnM.style.borderColor='var(--blue)', btnM.style.color='var(--blue)'); btnH && (btnH.style.borderColor='', btnH.style.color='');
        document.getElementById('vstat-total').textContent='7.348'; document.getElementById('vstat-avg').textContent='1.837'; document.getElementById('vstat-peak').textContent='2.214';
    }
    if (chartAViewH) {
        const d = mode === 'harian' ? analitikViewHarian : analitikViewMingguan;
        chartAViewH.data.labels = d.labels; chartAViewH.data.datasets[0].data = d.data; chartAViewH.update();
    }
}
</script>
@endpush
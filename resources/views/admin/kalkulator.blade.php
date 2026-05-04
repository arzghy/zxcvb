@extends('layouts.admin')

@section('page-title', 'Kalkulator Saham')
@section('page-breadcrumb', 'Tools Analisis')

@section('content')
<div class="section-header flex items-center justify-between mb-5 mt-2 gap-3 flex-wrap">
    <div>
        <div class="section-title text-lg font-bold text-gray-900">Kalkulator Saham</div>
        <div class="section-sub text-sm text-gray-500">Tools analisis & kalkulasi investasi</div>
    </div>
</div>

<div class="tab-bar flex gap-1.5 mb-5 flex-wrap bg-slate-100 p-1.5 rounded-xl">
    <button class="tab-btn active px-4 py-2 rounded-lg text-sm font-semibold bg-blue-600 text-white shadow-sm transition" onclick="switchTab('avg', this)">📉 Average Down</button>
    <button class="tab-btn px-4 py-2 rounded-lg text-sm font-semibold text-gray-500 hover:bg-gray-200 transition" onclick="switchTab('pl', this)">📊 Profit / Loss</button>
    <button class="tab-btn px-4 py-2 rounded-lg text-sm font-semibold text-gray-500 hover:bg-gray-200 transition" onclick="switchTab('bep', this)">🎯 Target & BEP</button>
    <button class="tab-btn px-4 py-2 rounded-lg text-sm font-semibold text-gray-500 hover:bg-gray-200 transition" onclick="switchTab('fee', this)">💸 Fee Broker</button>
    <button class="tab-btn px-4 py-2 rounded-lg text-sm font-semibold text-gray-500 hover:bg-gray-200 transition" onclick="switchTab('dividen', this)">💰 Dividen</button>
    <button class="tab-btn px-4 py-2 rounded-lg text-sm font-semibold text-gray-500 hover:bg-gray-200 transition" onclick="switchTab('valuation', this)">🔍 Valuasi Saham</button>
</div>

<!-- Tab 1: Average Down -->
<div class="tab-content block" id="tab-avg">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
        <div class="card p-6">
            <div class="font-bold text-base mb-1 text-gray-900">Kalkulator Average Down</div>
            <div class="text-[0.8rem] text-gray-500 mb-5">Hitung harga rata-rata setelah menambah posisi.</div>
            <div class="grid grid-cols-2 gap-4 mb-3.5">
                <div><label class="block text-xs font-semibold text-gray-500 mb-1">Harga Beli Awal (Rp)</label><input class="inp" type="number" placeholder="5.000"></div>
                <div><label class="block text-xs font-semibold text-gray-500 mb-1">Lot Awal</label><input class="inp" type="number" placeholder="10"></div>
            </div>
            <div class="grid grid-cols-2 gap-4 mb-3.5">
                <div><label class="block text-xs font-semibold text-gray-500 mb-1">Harga Beli Baru (Rp)</label><input class="inp" type="number" placeholder="4.500"></div>
                <div><label class="block text-xs font-semibold text-gray-500 mb-1">Lot Baru</label><input class="inp" type="number" placeholder="10"></div>
            </div>
            <button class="btn btn-primary w-full justify-center" onclick="alert('Fitur kalkulasi berjalan via JS khusus Kalkulator')">Hitung Average</button>
        </div>
        <div class="card p-6">
            <div class="font-bold mb-3 text-gray-900">💡 Tips Average Down</div>
            <div class="text-[0.85rem] text-gray-500 leading-relaxed">
                <p class="mb-2">✅ Average down efektif untuk saham <strong>fundamentally strong</strong></p>
                <p class="mb-2">⚠️ Jangan average saham yang turun karena <strong>fundamental buruk</strong></p>
                <p class="mb-2">📌 Pastikan penurunan bukan karena <strong>sentimen negatif jangka panjang</strong></p>
                <p>💰 Siapkan <strong>modal cadangan</strong> sebelum memutuskan average down</p>
            </div>
        </div>
    </div>
</div>

<!-- Tab 2: P/L -->
<div class="tab-content hidden" id="tab-pl">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
        <div class="card p-6">
            <div class="font-bold text-base mb-1 text-gray-900">Kalkulator Profit / Loss</div>
            <div class="text-[0.8rem] text-gray-500 mb-5">Hitung keuntungan atau kerugian posisi saham.</div>
            <div class="grid grid-cols-2 gap-4 mb-3.5">
                <div><label class="block text-xs font-semibold text-gray-500 mb-1">Harga Beli (Rp)</label><input class="inp" type="number" placeholder="5.000"></div>
                <div><label class="block text-xs font-semibold text-gray-500 mb-1">Harga Jual (Rp)</label><input class="inp" type="number" placeholder="5.500"></div>
            </div>
            <div class="grid grid-cols-2 gap-4 mb-3.5">
                <div><label class="block text-xs font-semibold text-gray-500 mb-1">Jumlah Lot</label><input class="inp" type="number" placeholder="10"></div>
                <div><label class="block text-xs font-semibold text-gray-500 mb-1">Fee Broker (%)</label><input class="inp" type="number" placeholder="0.15" step="0.01"></div>
            </div>
            <button class="btn btn-primary w-full justify-center">Hitung Profit / Loss</button>
        </div>
        <div class="card p-6 bg-gradient-to-br from-blue-50 to-indigo-50 border-blue-100">
            <div class="font-bold mb-3 text-gray-900">📋 Catatan Fee Broker IDX</div>
            <div class="text-[0.82rem] text-gray-500 leading-relaxed">
                <div class="flex justify-between py-1.5 border-b border-gray-200"><span>Fee Beli (umum)</span><span class="font-mono font-bold text-blue-700">0.10–0.18%</span></div>
                <div class="flex justify-between py-1.5 border-b border-gray-200"><span>Fee Jual (umum)</span><span class="font-mono font-bold text-blue-700">0.20–0.28%</span></div>
                <div class="flex justify-between py-1.5 border-b border-gray-200"><span>Pajak Jual (PPh)</span><span class="font-mono font-bold text-orange-600">0.10%</span></div>
                <div class="flex justify-between py-1.5"><span>Minimum Transaksi</span><span class="font-mono font-bold">1 Lot = 100 lbr</span></div>
            </div>
        </div>
    </div>
</div>

<!-- Tab 3: BEP -->
<div class="tab-content hidden" id="tab-bep">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
        <div class="card p-6">
            <div class="font-bold text-base mb-1 text-gray-900">Target & Break Even Point</div>
            <div class="text-[0.8rem] text-gray-500 mb-5">Hitung target harga dan BEP dengan fee broker.</div>
            <div class="grid grid-cols-2 gap-4 mb-3.5">
                <div><label class="block text-xs font-semibold text-gray-500 mb-1">Harga Beli (Rp)</label><input class="inp" type="number" placeholder="5.000"></div>
                <div><label class="block text-xs font-semibold text-gray-500 mb-1">Jumlah Lot</label><input class="inp" type="number" placeholder="10"></div>
            </div>
            <div class="grid grid-cols-2 gap-4 mb-3.5">
                <div><label class="block text-xs font-semibold text-gray-500 mb-1">Fee Beli (%)</label><input class="inp" type="number" placeholder="0.15" step="0.01"></div>
                <div><label class="block text-xs font-semibold text-gray-500 mb-1">Fee Jual + Pajak (%)</label><input class="inp" type="number" placeholder="0.25" step="0.01"></div>
            </div>
            <div class="mb-3.5">
                <label class="block text-xs font-semibold text-gray-500 mb-1">Target Return (%)</label><input class="inp" type="number" placeholder="10">
            </div>
            <button class="btn btn-primary w-full justify-center">Hitung BEP</button>
        </div>
        <div class="card p-6">
            <div class="font-bold mb-3 text-gray-900">🎯 Strategi Target Price</div>
            <div class="text-[0.85rem] text-gray-500 leading-relaxed">
                <p class="mb-2">🔹 <strong>Swing Trade:</strong> Target 3–10% dalam 1–4 minggu</p>
                <p class="mb-2">🔹 <strong>Medium-term:</strong> Target 15–30% dalam 1–6 bulan</p>
                <p class="mb-2">🔹 <strong>Investasi:</strong> Target 20–50%+ dalam 1 tahun+</p>
                <p>⚠️ Selalu tetapkan <strong>Stop Loss</strong> untuk membatasi risiko</p>
            </div>
        </div>
    </div>
</div>

<!-- Tab 4: Fee -->
<div class="tab-content hidden" id="tab-fee">
    <div class="card p-6 max-w-xl">
        <div class="font-bold text-base mb-1 text-gray-900">Simulasi Fee Transaksi</div>
        <div class="text-[0.8rem] text-gray-500 mb-5">Estimasi total biaya transaksi beli & jual saham.</div>
        <div class="grid grid-cols-2 gap-4 mb-3.5">
            <div><label class="block text-xs font-semibold text-gray-500 mb-1">Harga Saham (Rp)</label><input class="inp" type="number" placeholder="5.000"></div>
            <div><label class="block text-xs font-semibold text-gray-500 mb-1">Jumlah Lot</label><input class="inp" type="number" placeholder="10"></div>
        </div>
        <div class="grid grid-cols-2 gap-4 mb-3.5">
            <div><label class="block text-xs font-semibold text-gray-500 mb-1">Fee Beli (%)</label><input class="inp" type="number" placeholder="0.15" step="0.01"></div>
            <div><label class="block text-xs font-semibold text-gray-500 mb-1">Fee Jual + PPh (%)</label><input class="inp" type="number" placeholder="0.25" step="0.01"></div>
        </div>
        <button class="btn btn-primary w-full justify-center">Kalkulasi Total Fee</button>
    </div>
</div>

<!-- Tab 5: Dividen -->
<div class="tab-content hidden" id="tab-dividen">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
        <div class="card p-6">
            <div class="font-bold text-base mb-1 text-gray-900">Kalkulator Dividen</div>
            <div class="text-[0.8rem] text-gray-500 mb-5">Estimasi dividen yang diterima dari kepemilikan saham.</div>
            <div class="grid grid-cols-2 gap-4 mb-3.5">
                <div><label class="block text-xs font-semibold text-gray-500 mb-1">Harga Saham (Rp)</label><input class="inp" type="number" placeholder="5.000"></div>
                <div><label class="block text-xs font-semibold text-gray-500 mb-1">Jumlah Lot</label><input class="inp" type="number" placeholder="10"></div>
            </div>
            <div class="grid grid-cols-2 gap-4 mb-3.5">
                <div><label class="block text-xs font-semibold text-gray-500 mb-1">DPS — Dividen/Saham (Rp)</label><input class="inp" type="number" placeholder="200"></div>
                <div><label class="block text-xs font-semibold text-gray-500 mb-1">Pajak Dividen (%)</label><input class="inp" type="number" placeholder="10"></div>
            </div>
            <button class="btn btn-primary w-full justify-center">Hitung Dividen Neto</button>
        </div>
        <div class="card p-6 bg-gradient-to-br from-emerald-50 to-green-50 border-emerald-100">
            <div class="font-bold mb-3 text-gray-900">💰 Info Dividen IDX</div>
            <div class="text-[0.82rem] text-gray-500 leading-relaxed">
                <div class="py-1.5 border-b border-gray-200"><strong>Dividend Yield tinggi</strong> = lebih dari 4%/tahun</div>
                <div class="py-1.5 border-b border-gray-200"><strong>Pajak dividen</strong> investor ritel Indonesia: 10%</div>
                <div class="py-1.5 border-b border-gray-200"><strong>Contoh high yield:</strong> BRIS, TLKM, BBRI, PTBA</div>
                <div class="py-1.5">Dividen dibagikan sesuai <strong>cum date & ex date</strong></div>
            </div>
        </div>
    </div>
</div>

<!-- Tab 6: Valuation -->
<div class="tab-content hidden" id="tab-valuation">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
        <div class="card p-6">
            <div class="font-bold text-base mb-1 text-gray-900">Valuasi Saham (PER & PBV)</div>
            <div class="text-[0.8rem] text-gray-500 mb-5">Analisis valuasi sederhana berdasarkan rasio fundamental.</div>
            <div class="grid grid-cols-2 gap-4 mb-3.5">
                <div><label class="block text-xs font-semibold text-gray-500 mb-1">Harga Saham (Rp)</label><input class="inp" type="number" placeholder="5.000"></div>
                <div><label class="block text-xs font-semibold text-gray-500 mb-1">EPS — Laba/Saham (Rp)</label><input class="inp" type="number" placeholder="500"></div>
            </div>
            <div class="grid grid-cols-2 gap-4 mb-3.5">
                <div><label class="block text-xs font-semibold text-gray-500 mb-1">Book Value/Saham (Rp)</label><input class="inp" type="number" placeholder="2.500"></div>
                <div><label class="block text-xs font-semibold text-gray-500 mb-1">PER Industri (x)</label><input class="inp" type="number" placeholder="15"></div>
            </div>
            <button class="btn btn-primary w-full justify-center">Hitung Valuasi</button>
        </div>
        <div class="card p-6">
            <div class="font-bold mb-3 text-gray-900">📊 Panduan Interpretasi Rasio</div>
            <div class="text-[0.82rem] text-gray-500 leading-relaxed">
                <div class="py-1.5 border-b border-gray-100"><strong>PER &lt; 10x</strong> → Murah / Undervalued</div>
                <div class="py-1.5 border-b border-gray-100"><strong>PER 10–20x</strong> → Wajar / Fair value</div>
                <div class="py-1.5 border-b border-gray-100"><strong>PER &gt; 20x</strong> → Mahal / Overvalued</div>
                <div class="py-1.5 border-b border-gray-100"><strong>PBV &lt; 1x</strong> → Diperdagangkan di bawah aset buku</div>
                <div class="py-1.5"><strong>ROE tinggi + PBV wajar</strong> → Peluang investasi baik</div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Fungsi simpel untuk Tab System Kalkulator
function switchTab(tabId, btnElement) {
    // Hide all tabs
    document.querySelectorAll('.tab-content').forEach(tab => {
        tab.classList.remove('block');
        tab.classList.add('hidden');
    });
    // Remove active styles from all buttons
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.classList.remove('bg-blue-600', 'text-white', 'shadow-sm');
        btn.classList.add('text-gray-500');
    });
    
    // Show selected tab
    document.getElementById('tab-' + tabId).classList.remove('hidden');
    document.getElementById('tab-' + tabId).classList.add('block');
    
    // Set active styles to clicked button
    btnElement.classList.remove('text-gray-500');
    btnElement.classList.add('bg-blue-600', 'text-white', 'shadow-sm');
}
</script>
@endpush
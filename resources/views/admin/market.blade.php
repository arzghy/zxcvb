@extends('layouts.admin')

@section('page-title', 'Data Pasar')
@section('page-breadcrumb', 'Simulasi Market Data')

@section('content')
<div class="section-header flex items-center justify-between mb-5 mt-2 gap-3 flex-wrap">
    <div>
        <div class="section-title text-lg font-bold text-gray-900">Data Pasar</div>
        <div class="section-sub text-sm text-gray-500">Simulasi data pasar modal Indonesia</div>
    </div>
    <span class="bg-green-100 text-green-800 px-2.5 py-1 rounded-full text-xs font-semibold flex items-center gap-1">● Live Simulation</span>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-5">
    <div class="card p-5">
        <div class="text-[0.72rem] font-bold text-gray-500 uppercase mb-2">IHSG</div>
        <div class="font-mono text-3xl font-extrabold text-gray-900">7.842,10</div>
        <div class="text-[0.8rem] text-green-600 font-semibold mt-1">▲ +95.4 (1.23%)</div>
    </div>
    <div class="card p-5">
        <div class="text-[0.72rem] font-bold text-gray-500 uppercase mb-2">USD/IDR</div>
        <div class="font-mono text-3xl font-extrabold text-gray-900">15.820</div>
        <div class="text-[0.8rem] text-red-500 font-semibold mt-1">▼ -33 (0.21%)</div>
    </div>
    <div class="card p-5">
        <div class="text-[0.72rem] font-bold text-gray-500 uppercase mb-2">EMAS (XAU/USD)</div>
        <div class="font-mono text-3xl font-extrabold text-gray-900">$2.918</div>
        <div class="text-[0.8rem] text-green-600 font-semibold mt-1">▲ +24.6 (0.85%)</div>
    </div>
    <div class="card p-5">
        <div class="text-[0.72rem] font-bold text-gray-500 uppercase mb-2">MINYAK (WTI)</div>
        <div class="font-mono text-3xl font-extrabold text-gray-900">$71.4</div>
        <div class="text-[0.8rem] text-red-500 font-semibold mt-1">▼ -0.40 (0.55%)</div>
    </div>
</div>

<div class="card p-5">
    <div class="font-bold mb-3.5 text-gray-900">Top Mover IDX — Simulasi Data</div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse text-sm">
            <thead>
                <tr class="text-gray-500 uppercase tracking-wider border-b border-gray-200 bg-gray-50">
                    <th class="px-4 py-3">Emiten</th>
                    <th class="px-4 py-3">Sektor</th>
                    <th class="px-4 py-3">Harga</th>
                    <th class="px-4 py-3">Perubahan</th>
                    <th class="px-4 py-3">% Change</th>
                    <th class="px-4 py-3">Volume</th>
                    <th class="px-4 py-3">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b border-gray-50 hover:bg-blue-50 transition">
                    <td class="px-4 py-3 font-bold text-gray-900">BBCA</td>
                    <td class="px-4 py-3 text-[0.8rem] text-gray-500">Perbankan</td>
                    <td class="px-4 py-3 font-mono font-semibold">9.725</td>
                    <td class="px-4 py-3 font-mono font-semibold text-green-600">+75</td>
                    <td class="px-4 py-3 font-bold text-green-600">▲ 0.78%</td>
                    <td class="px-4 py-3 font-mono text-[0.8rem] text-gray-500">12.4 M</td>
                    <td class="px-4 py-3"><span class="bg-green-100 text-green-800 px-2.5 py-0.5 rounded-full text-[0.7rem] font-semibold">Naik</span></td>
                </tr>
                <tr class="border-b border-gray-50 hover:bg-blue-50 transition">
                    <td class="px-4 py-3 font-bold text-gray-900">BBRI</td>
                    <td class="px-4 py-3 text-[0.8rem] text-gray-500">Perbankan</td>
                    <td class="px-4 py-3 font-mono font-semibold">4.820</td>
                    <td class="px-4 py-3 font-mono font-semibold text-red-500">-30</td>
                    <td class="px-4 py-3 font-bold text-red-500">▼ 0.62%</td>
                    <td class="px-4 py-3 font-mono text-[0.8rem] text-gray-500">98.2 M</td>
                    <td class="px-4 py-3"><span class="bg-red-100 text-red-800 px-2.5 py-0.5 rounded-full text-[0.7rem] font-semibold">Turun</span></td>
                </tr>
                <tr class="border-b border-gray-50 hover:bg-blue-50 transition">
                    <td class="px-4 py-3 font-bold text-gray-900">BMRI</td>
                    <td class="px-4 py-3 text-[0.8rem] text-gray-500">Perbankan</td>
                    <td class="px-4 py-3 font-mono font-semibold">6.150</td>
                    <td class="px-4 py-3 font-mono font-semibold text-green-600">+50</td>
                    <td class="px-4 py-3 font-bold text-green-600">▲ 0.82%</td>
                    <td class="px-4 py-3 font-mono text-[0.8rem] text-gray-500">24.1 M</td>
                    <td class="px-4 py-3"><span class="bg-green-100 text-green-800 px-2.5 py-0.5 rounded-full text-[0.7rem] font-semibold">Naik</span></td>
                </tr>
                <tr class="border-b border-gray-50 hover:bg-blue-50 transition">
                    <td class="px-4 py-3 font-bold text-gray-900">TLKM</td>
                    <td class="px-4 py-3 text-[0.8rem] text-gray-500">Telekomunikasi</td>
                    <td class="px-4 py-3 font-mono font-semibold">3.140</td>
                    <td class="px-4 py-3 font-mono font-semibold text-red-500">-20</td>
                    <td class="px-4 py-3 font-bold text-red-500">▼ 0.63%</td>
                    <td class="px-4 py-3 font-mono text-[0.8rem] text-gray-500">55.8 M</td>
                    <td class="px-4 py-3"><span class="bg-red-100 text-red-800 px-2.5 py-0.5 rounded-full text-[0.7rem] font-semibold">Turun</span></td>
                </tr>
                <tr class="border-b border-gray-50 hover:bg-blue-50 transition">
                    <td class="px-4 py-3 font-bold text-gray-900">ASII</td>
                    <td class="px-4 py-3 text-[0.8rem] text-gray-500">Manufaktur</td>
                    <td class="px-4 py-3 font-mono font-semibold">4.920</td>
                    <td class="px-4 py-3 font-mono font-semibold text-green-600">+60</td>
                    <td class="px-4 py-3 font-bold text-green-600">▲ 1.23%</td>
                    <td class="px-4 py-3 font-mono text-[0.8rem] text-gray-500">31.7 M</td>
                    <td class="px-4 py-3"><span class="bg-green-100 text-green-800 px-2.5 py-0.5 rounded-full text-[0.7rem] font-semibold">Naik</span></td>
                </tr>
                <tr class="border-b border-gray-50 hover:bg-blue-50 transition">
                    <td class="px-4 py-3 font-bold text-gray-900">GOTO</td>
                    <td class="px-4 py-3 text-[0.8rem] text-gray-500">Teknologi</td>
                    <td class="px-4 py-3 font-mono font-semibold">84</td>
                    <td class="px-4 py-3 font-mono font-semibold text-green-600">+3</td>
                    <td class="px-4 py-3 font-bold text-green-600">▲ 3.70%</td>
                    <td class="px-4 py-3 font-mono text-[0.8rem] text-gray-500">4.2 B</td>
                    <td class="px-4 py-3"><span class="bg-green-100 text-green-800 px-2.5 py-0.5 rounded-full text-[0.7rem] font-semibold">Naik</span></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
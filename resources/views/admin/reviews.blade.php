@extends('layouts.admin')

@section('page-title', 'Manajemen Reviews')
@section('page-breadcrumb', 'Testimoni Anggota')

@section('content')
<div class="section-header flex items-center justify-between mb-5 mt-2 gap-3 flex-wrap">
    <div>
        <div class="section-title text-lg font-bold text-gray-900">Manajemen Reviews</div>
        <div class="section-sub text-sm text-gray-500">Kelola testimoni dan ulasan untuk ditampilkan di landing page</div>
    </div>
</div>

<div class="card p-6">
    <div class="empty-state text-center py-16 px-5 text-gray-400">
        <div class="text-4xl mb-3">⭐</div>
        <div class="text-sm">Fitur Reviews sedang dalam tahap pengembangan (Sesuai modifikasi ledger).</div>
    </div>
</div>
@endsection
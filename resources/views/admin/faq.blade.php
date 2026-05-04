@extends('layouts.admin')

@section('page-title', 'Manajemen FAQ')
@section('page-breadcrumb', 'Kelola Tanya Jawab')

@section('content')
<div class="section-header flex items-center justify-between mb-5 mt-2 gap-3 flex-wrap">
    <div>
        <div class="section-title text-lg font-bold text-gray-900">Manajemen FAQ</div>
        <div class="section-sub text-sm text-gray-500">Kelola pertanyaan yang sering diajukan di website</div>
    </div>
    <button class="btn btn-primary btn-sm">+ Tambah FAQ</button>
</div>

<div class="card p-6">
    <div class="empty-state text-center py-16 px-5 text-gray-400">
        <div class="text-4xl mb-3">❓</div>
        <div class="text-sm">Fitur FAQ sedang dalam tahap pengembangan (Sesuai modifikasi ledger).</div>
    </div>
</div>
@endsection
@extends('layouts.admin')

@section('page-title', 'Manajemen Anggota')
@section('page-breadcrumb', 'Kelola Data Anggota')

@section('content')
<div class="p-6 bg-[#f8fafc] min-h-screen">
    
    <!-- Header Page -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Manajemen Anggota</h1>
            <p class="text-sm text-gray-400 mt-1">Total {{ number_format($totalAnggota) }} pengguna terdaftar dalam sistem.</p>
        </div>
        
        <div class="flex items-center gap-4 mt-4 md:mt-0">
            <!-- Form Pencarian -->
            <form action="{{ route('admin.anggota.index') }}" method="GET" class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </span>
                <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari nama atau email..." class="py-2 pl-10 pr-4 rounded-full border border-gray-100 text-sm focus:outline-none focus:border-blue-500 w-64 bg-white shadow-sm">
            </form>

            <button class="bg-blue-800 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-semibold shadow-md flex items-center gap-2">
                <span>+</span> Tambah Anggota
            </button>
        </div>
    </div>

    <!-- Table Section -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full whitespace-nowrap text-left">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4 text-[11px] font-bold text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-4 text-[11px] font-bold text-gray-500 uppercase tracking-wider">Informasi Pengguna</th>
                        <th class="px-6 py-4 text-[11px] font-bold text-gray-500 uppercase tracking-wider">Role</th>
                        <th class="px-6 py-4 text-[11px] font-bold text-gray-500 uppercase tracking-wider">Tanggal Bergabung</th>
                        <th class="px-6 py-4 text-[11px] font-bold text-gray-500 uppercase tracking-wider text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($anggotas as $index => $anggota)
                    <tr class="hover:bg-blue-50/50 transition-colors">
                        <!-- Penomoran otomatis menyesuaikan pagination -->
                        <td class="px-6 py-4 text-sm text-gray-500 font-medium">
                            {{ $anggotas->firstItem() + $index }}
                        </td>
                        
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="h-10 w-10 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold text-sm shadow-sm">
                                    <!-- Menampilkan Inisial Nama -->
                                    {{ strtoupper(substr($anggota->name, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gray-800">{{ $anggota->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $anggota->email }}</p>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            @if(($anggota->role ?? 'user') == 'admin')
                                <span class="bg-purple-100 text-purple-700 text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wide">Admin</span>
                            @else
                                <span class="bg-emerald-100 text-emerald-700 text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wide">Member</span>
                            @endif
                        </td>

                        <td class="px-6 py-4 text-sm text-gray-600 font-medium">
                            {{ $anggota->created_at ? $anggota->created_at->format('d M Y') : '-' }}
                        </td>

                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center gap-2">
                                <button class="p-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-colors tooltip" title="Edit Data">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                </button>
                                <button class="p-2 bg-rose-50 text-rose-600 rounded-lg hover:bg-rose-100 transition-colors tooltip" title="Hapus Data">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                            <div class="flex flex-col items-center">
                                <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                <p class="text-sm font-medium">Tidak ada data anggota ditemukan.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination Links -->
        @if($anggotas->hasPages())
        <div class="border-t border-gray-100 px-6 py-4">
            {{ $anggotas->appends(['search' => $search])->links() }}
        </div>
        @endif
    </div>
</div>
@endsection

@push('styles')
<style>
/* Style pembantu agar modal berfungsi saat display:flex disematkan */
.modal-overlay.open { display: flex !important; }
</style>
@endpush
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AnggotaController extends Controller
{
    public function index(Request $request)
    {
        // Fitur pencarian sederhana (opsional, tapi sangat berguna)
        $search = $request->input('search');
        
        $query = User::query();

        if ($search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        }

        // Ambil data user, urutkan dari yang terbaru, batasi 10 per halaman
        $anggotas = $query->latest()->paginate(10);
        $totalAnggota = User::count();

        return view('admin.anggota', compact('anggotas', 'totalAnggota', 'search'));
    }
}
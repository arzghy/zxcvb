<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AnggotaController extends Controller
{
    // Menampilkan halaman tabel
    public function index(Request $request)
    {
        $search = $request->input('search');
        $divisi = $request->input('divisi');
        $query = User::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('nim', 'like', "%{$search}%");
            });
        }

        if ($divisi) {
            $query->where('divisi', $divisi);
        }

        $anggotas = $query->latest()->paginate(10)->withQueryString();
        $totalAnggota = User::count();

        return view('admin.anggota', compact('anggotas', 'totalAnggota', 'search', 'divisi'));
    }

    // Menyimpan anggota baru (dari Modal Tambah)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nim' => 'required|string|max:50|unique:users,nim',
            'email' => 'nullable|email|unique:users,email',
            'divisi' => 'required|string',
        ]);

        User::create([
            'name' => $request->name,
            'nim' => $request->nim,
            'email' => $request->email,
            'password' => Hash::make($request->nim),
            'divisi' => $request->divisi,
            'angkatan' => $request->angkatan,
            'whatsapp' => $request->whatsapp,
            'status' => $request->status ?? 'aktif',
            'jabatan' => $request->jabatan ?? 'anggota',
            'role' => 'user'
        ]);

        return redirect()->back()->with('success', 'Anggota berhasil ditambahkan!');
    }

    // Mengupdate data anggota (dari Modal Edit)
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'nim' => 'required|string|max:50|unique:users,nim,' . $id,
            'email' => 'nullable|email|unique:users,email,' . $id,
            'divisi' => 'required|string',
        ]);

        $user->update([
            'name' => $request->name,
            'nim' => $request->nim,
            'email' => $request->email,
            'divisi' => $request->divisi,
            'angkatan' => $request->angkatan,
            'whatsapp' => $request->whatsapp,
            'status' => $request->status,
            'jabatan' => $request->jabatan,
        ]);

        return redirect()->back()->with('success', 'Data anggota berhasil diperbarui!');
    }

    // Menghapus data anggota (dari Modal Hapus)
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'Data anggota berhasil dihapus!');
    }
}
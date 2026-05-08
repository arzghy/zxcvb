<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Riset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RisetController extends Controller
{
    public function index() {
        $risets = Riset::orderBy('release_date', 'desc')->get();
        return view('admin.riset', compact('risets'));
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'file' => 'nullable|mimes:pdf|max:10240', // Maks 10MB
        ]);
        
        $data = $request->except('file');

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/riset', $filename);
            
            $data['file_path'] = 'storage/riset/' . $filename;
            
            // Hitung ukuran file otomatis jika kosong
            if(empty($data['file_size'])) {
                $data['file_size'] = number_format($file->getSize() / 1048576, 2) . ' MB';
            }
        }

        Riset::create($data);
        return back()->with('success', 'Riset berhasil ditambahkan!');
    }

    public function update(Request $request, $id) {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'file' => 'nullable|mimes:pdf|max:10240',
        ]);

        $riset = Riset::findOrFail($id);
        $data = $request->except('file');

        if ($request->hasFile('file')) {
            // Hapus file lama jika ada
            if ($riset->file_path && file_exists(public_path($riset->file_path))) {
                unlink(public_path($riset->file_path));
            }

            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('riset', $filename, 'public');
            
            $data['file_path'] = 'storage/riset/' . $filename;
            
            if(empty($data['file_size'])) {
                $data['file_size'] = number_format($file->getSize() / 1048576, 2) . ' MB';
            }
        }

        $riset->update($data);
        return back()->with('success', 'Riset berhasil diupdate!');
    }

    public function destroy($id) {
        $riset = Riset::findOrFail($id);
        if ($riset->file_path && file_exists(public_path($riset->file_path))) {
            unlink(public_path($riset->file_path));
        }
        $riset->delete();
        return back()->with('success', 'Riset berhasil dihapus!');
    }

    // Fungsi khusus untuk membaca PDF langsung dari sistem (Bypass Symlink)
    public function showPdf($id)
    {
        $riset = \App\Models\Riset::findOrFail($id);
        
        // Ambil nama filenya saja (misal: 12345_file.pdf)
        $namaFile = basename($riset->file_path);

        // 1. Cek apakah file ada menggunakan sistem internal Laravel
        if (!\Illuminate\Support\Facades\Storage::disk('public')->exists('riset/' . $namaFile)) {
            // Jika file benar-benar hilang, munculkan pesan teks ini (bukan 404)
            return "GAGAL: File (" . $namaFile . ") tidak tersimpan di laptop. Silakan hapus data ini di tabel dan coba upload ulang.";
        }

        // 2. Jika ada, baca file langsung dari memori dan paksa browser menampilkan PDF
        $file = \Illuminate\Support\Facades\Storage::disk('public')->get('riset/' . $namaFile);
        
        return response($file, 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="' . $namaFile . '"');
    }
}
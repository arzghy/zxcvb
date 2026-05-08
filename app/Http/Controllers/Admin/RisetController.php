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
            $file->storeAs('public/riset', $filename);
            
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
}
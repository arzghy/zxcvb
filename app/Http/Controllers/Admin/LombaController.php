<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lomba;
use Illuminate\Http\Request;

class LombaController extends Controller
{
    public function index() {
        // Mengambil data lomba diurutkan dari deadline terdekat
        $lombas = Lomba::orderBy('registration_deadline', 'asc')->get();
        return view('admin.lomba', compact('lombas'));
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'organizer' => 'required|string|max:255',
            'registration_deadline' => 'required|date',
        ]);
        
        Lomba::create($request->all());
        return back()->with('success', 'Info lomba berhasil ditambahkan!');
    }

    public function update(Request $request, $id) {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'organizer' => 'required|string|max:255',
            'registration_deadline' => 'required|date',
        ]);

        $lomba = Lomba::findOrFail($id);
        $lomba->update($request->all());
        
        return back()->with('success', 'Info lomba berhasil diupdate!');
    }

    public function destroy($id) {
        Lomba::findOrFail($id)->delete();
        return back()->with('success', 'Info lomba berhasil dihapus!');
    }
}
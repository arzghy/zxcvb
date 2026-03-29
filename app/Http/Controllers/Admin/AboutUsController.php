<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function edit()
    {
        // Ambil data pertama, jika belum ada buat instance baru
        $aboutUs = AboutUs::first() ?? new AboutUs();
        return view('admin.about_us.edit', compact('aboutUs'));
    }

    public function update(Request $request)
    {
        // Validasi input dari admin
        $request->validate([
            'history' => 'required|string',
            'vision' => 'required|string',
            'mission' => 'required|string',
        ]);

        $aboutUs = AboutUs::first() ?? new AboutUs();
        $aboutUs->history = $request->history;
        $aboutUs->vision = $request->vision;
        $aboutUs->mission = $request->mission;
        
        $aboutUs->save();

        return back()->with('success', 'Halaman Tentang Kami berhasil diperbarui!');
    }

    // Tambahkan method ini di dalam AboutUsController
    public function updateApi(Request $request)
    {
        // Validasi input dari Postman/API
        $request->validate([
            'history' => 'required|string',
            'vision' => 'required|string',
            'mission' => 'required|string',
        ]);

        $aboutUs = AboutUs::first() ?? new AboutUs();
        $aboutUs->history = $request->history;
        $aboutUs->vision = $request->vision;
        $aboutUs->mission = $request->mission;
        
        $aboutUs->save();

        // Return berupa JSON untuk API
        return response()->json([
            'status' => 'success',
            'message' => 'Halaman Tentang Kami berhasil diperbarui via API!',
            'data' => $aboutUs
        ], 200);
    }
}
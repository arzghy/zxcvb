<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Header;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeaderController extends Controller
{
    // 1. Method untuk menampilkan halaman admin (Web)
    public function edit()
    {
        $header = Header::first() ?? new Header();
        return view('admin.header.edit', compact('header'));
    }

    // 2. Method untuk memproses form dari halaman admin (Web)
    public function update(Request $request)
    {
        $request->validate([
            'welcome_banner' => 'required|string|max:255',
            'tagline' => 'required|string',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $header = Header::first() ?? new Header();
        $header->welcome_banner = $request->welcome_banner;
        $header->tagline = $request->tagline;

        if ($request->hasFile('main_image')) {
            if ($header->main_image && Storage::exists('public/' . $header->main_image)) {
                Storage::delete('public/' . $header->main_image);
            }
            
            $path = $request->file('main_image')->store('headers', 'public');
            $header->main_image = $path;
        }

        $header->save();

        return back()->with('success', 'Header berhasil diperbarui!');
    }

    // 3. Method khusus untuk API Testing (Postman)
    public function updateApi(Request $request)
    {
        $request->validate([
            'welcome_banner' => 'required|string|max:255',
            'tagline' => 'required|string',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $header = Header::first() ?? new Header();
        $header->welcome_banner = $request->welcome_banner;
        $header->tagline = $request->tagline;

        if ($request->hasFile('main_image')) {
            if ($header->main_image && Storage::exists('public/' . $header->main_image)) {
                Storage::delete('public/' . $header->main_image);
            }
            
            $path = $request->file('main_image')->store('headers', 'public');
            $header->main_image = $path;
        }

        $header->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Header berhasil diperbarui via API!',
            'data' => $header
        ], 200);
    }
}
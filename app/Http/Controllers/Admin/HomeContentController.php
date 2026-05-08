<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeContent;
use App\Models\Ticker;
use Illuminate\Http\Request;

class HomeContentController extends Controller
{
    public function index()
    {
        // Mengambil semua konten menjadi array asosiatif ['key' => 'value']
        $contents = HomeContent::pluck('value', 'key')->toArray();
        $tickers = Ticker::orderBy('created_at', 'desc')->get();
        
        return view('admin.home_content', compact('contents', 'tickers'));
    }

    public function saveContent(Request $request)
    {
        // Menyimpan semua input teks ke tabel home_contents
        $data = $request->except('_token');
        foreach ($data as $key => $value) {
            HomeContent::updateOrCreate(['key' => $key], ['value' => $value]);
        }
        return response()->json(['success' => true]);
    }

    public function saveTicker(Request $request)
    {
        // Menyimpan atau Update data Ticker Saham
        $data = $request->validate([
            'kode' => 'required',
            'harga' => 'required|numeric',
            'change' => 'required|numeric',
            'pct' => 'required|numeric',
            'tren' => 'required',
            'status' => 'required',
        ]);

        if ($request->id) {
            Ticker::find($request->id)->update($data);
        } else {
            Ticker::create($data);
        }

        return response()->json(['success' => true]);
    }

    public function destroyTicker($id)
    {
        Ticker::destroy($id);
        return back()->with('success', 'Ticker dihapus');
    }
}
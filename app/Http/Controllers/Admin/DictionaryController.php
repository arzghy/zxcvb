<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dictionary;
use Illuminate\Http\Request;

class DictionaryController extends Controller
{
    // ================= FUNGSI WEB (BROWSER) =================
    public function index()
    {
        $terms = Dictionary::orderBy('term', 'asc')->get();
        return view('admin.dictionary.index', compact('terms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'term' => 'required|string|max:255',
            'definition' => 'required|string',
        ]);

        Dictionary::create($request->only(['term', 'definition']));
        return back()->with('success', 'Istilah baru berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $term = Dictionary::findOrFail($id);
        $term->delete();
        return back()->with('success', 'Istilah berhasil dihapus!');
    }

    // ================= FUNGSI API (POSTMAN) =================
    public function indexApi()
    {
        $terms = Dictionary::orderBy('term', 'asc')->get();
        return response()->json(['status' => 'success', 'data' => $terms], 200);
    }

    public function storeApi(Request $request)
    {
        $request->validate([
            'term' => 'required|string|max:255',
            'definition' => 'required|string',
        ]);

        $term = Dictionary::create($request->only(['term', 'definition']));
        return response()->json(['status' => 'success', 'message' => 'Istilah ditambahkan!', 'data' => $term], 201);
    }

    public function destroyApi($id)
    {
        $term = Dictionary::find($id);
        if (!$term) return response()->json(['status' => 'error', 'message' => 'Tidak ditemukan'], 404);
        
        $term->delete();
        return response()->json(['status' => 'success', 'message' => 'Istilah dihapus!'], 200);
    }
}
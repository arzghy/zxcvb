<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrganizationController extends Controller
{
    // ====================================================
    // 1. FUNGSI JALUR WEB (TAMPILAN BROWSER / DASHBOARD)
    // ====================================================

    public function index()
    {
        $members = Organization::all();
        return view('admin.organization.index', compact('members'));
    }

    public function create()
    {
        return view('admin.organization.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'period' => 'required|string|max:255',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = $request->file('photo')->store('organizations', 'public');

        Organization::create([
            'name' => $request->name,
            'position' => $request->position,
            'period' => $request->period,
            'photo' => $path,
        ]);

        return redirect()->route('admin.organization.index')->with('success', 'Pengurus berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $member = Organization::findOrFail($id);
        
        if ($member->photo && Storage::exists('public/' . $member->photo)) {
            Storage::delete('public/' . $member->photo);
        }
        
        $member->delete();
        return back()->with('success', 'Data pengurus berhasil dihapus!');
    }


    // ====================================================
    // 2. FUNGSI JALUR API (UNTUK POSTMAN / FRONTEND APP)
    // ====================================================

    public function indexApi()
    {
        $members = Organization::all();
        return response()->json([
            'status' => 'success',
            'data' => $members
        ], 200);
    }

    public function storeApi(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'period' => 'required|string|max:255',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = $request->file('photo')->store('organizations', 'public');

        $member = Organization::create([
            'name' => $request->name,
            'position' => $request->position,
            'period' => $request->period,
            'photo' => $path,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Pengurus berhasil ditambahkan via API!',
            'data' => $member
        ], 201);
    }

    public function destroyApi($id)
    {
        $member = Organization::find($id);

        if (!$member) {
            return response()->json(['status' => 'error', 'message' => 'Data tidak ditemukan'], 404);
        }
        
        if ($member->photo && Storage::exists('public/' . $member->photo)) {
            Storage::delete('public/' . $member->photo);
        }
        
        $member->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data pengurus berhasil dihapus via API!'
        ], 200);
    }
}
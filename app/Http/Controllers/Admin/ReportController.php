<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    // ================= FUNGSI WEB =================
    public function index() {
        $reports = Report::orderBy('created_at', 'desc')->get();
        return view('admin.report.index', compact('reports'));
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'pdf_file' => 'required|mimes:pdf|max:10240', // Maksimal 10MB khusus PDF
        ]);

        $path = $request->file('pdf_file')->store('reports', 'public');
        Report::create(['title' => $request->title, 'pdf_file' => $path]);
        
        return back()->with('success', 'Laporan PDF berhasil diupload!');
    }

    public function destroy($id) {
        $report = Report::findOrFail($id);
        if ($report->pdf_file && Storage::exists('public/' . $report->pdf_file)) {
            Storage::delete('public/' . $report->pdf_file);
        }
        $report->delete();
        return back()->with('success', 'Laporan dihapus!');
    }

    // ================= FUNGSI API =================
    public function indexApi() {
        return response()->json(['status' => 'success', 'data' => Report::orderBy('created_at', 'desc')->get()], 200);
    }

    public function storeApi(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'pdf_file' => 'required|mimes:pdf|max:10240',
        ]);

        $path = $request->file('pdf_file')->store('reports', 'public');
        $report = Report::create(['title' => $request->title, 'pdf_file' => $path]);

        return response()->json(['status' => 'success', 'message' => 'Laporan diupload via API!', 'data' => $report], 201);
    }

    public function destroyApi($id) {
        $report = Report::find($id);
        if(!$report) return response()->json(['status' => 'error', 'message' => 'Not found'], 404);
        
        if ($report->pdf_file && Storage::exists('public/' . $report->pdf_file)) {
            Storage::delete('public/' . $report->pdf_file);
        }
        $report->delete();
        return response()->json(['status' => 'success', 'message' => 'Laporan dihapus via API!'], 200);
    }
}
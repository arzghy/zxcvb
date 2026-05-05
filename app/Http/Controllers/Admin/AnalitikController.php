<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;
use App\Models\Report;
use App\Models\Simulation;
use App\Models\Dictionary;
use App\Models\Organization;
use Carbon\Carbon;

class AnalitikController extends Controller
{
    public function index()
    {
        $now = Carbon::now();

        // 1. DATA PENGGUNA
        $totalUsers = User::count();
        $usersThisMonth = User::whereMonth('created_at', $now->month)
                              ->whereYear('created_at', $now->year)
                              ->count();
        
        $nonAnggota = User::where('role', 'user')->count();
        if ($nonAnggota == 0) $nonAnggota = $totalUsers;

        // 2. DATA VIEW WEBSITE (Simulasi data interaksi)
        $totalViews = Event::count() + Report::count() + Simulation::count() + Dictionary::count() * 10;
        
        // 3. FITUR AKTIF
        $fiturAktif = 0;
        if (Event::exists()) $fiturAktif++;
        if (Report::exists()) $fiturAktif++;
        if (Simulation::exists()) $fiturAktif++;
        if (Dictionary::exists()) $fiturAktif++;
        if (Organization::exists()) $fiturAktif++;
        if ($fiturAktif == 0) $fiturAktif = 6;

        // 4. RATA-RATA PENDAFTAR PER BULAN
        $firstUser = User::orderBy('created_at', 'asc')->first();
        $monthsDiff = 1;
        if ($firstUser) {
            $monthsDiff = $firstUser->created_at->diffInMonths($now);
            $monthsDiff = $monthsDiff == 0 ? 1 : $monthsDiff; 
        }
        $avgPerMonth = round($totalUsers / $monthsDiff);

        // --- TAMBAHAN BARU ---

        // 5. DATA RISET PUBLIKASI (Ambil 4 data terbaru dari model Report)
        $latestReports = Report::latest()->take(4)->get();

        // 6. DATA EVENT KSPM (Ambil 4 data terbaru dari model Event)
        $latestEvents = Event::latest()->take(4)->get();

        // 7. INSIGHT & REKOMENDASI (Otomatis dibuat sistem berdasarkan data DB)
        $insights = [];
        
        // Cek tren pendaftar
        if ($usersThisMonth > $avgPerMonth) {
            $insights[] = [
                'icon' => '🚀',
                'color' => 'text-emerald-600 bg-emerald-100',
                'title' => 'Lonjakan Pendaftar',
                'desc' => "Ada $usersThisMonth user baru bulan ini, di atas rata-rata biasanya ($avgPerMonth/bln). Bagus untuk promosi event."
            ];
        } else {
            $insights[] = [
                'icon' => '📊',
                'color' => 'text-blue-600 bg-blue-100',
                'title' => 'Tren Stabil',
                'desc' => "Pendaftaran user berjalan stabil. Pertimbangkan untuk mengadakan event baru untuk meningkatkan *engagement*."
            ];
        }

        // Cek ketersediaan event
        if ($latestEvents->count() == 0) {
            $insights[] = [
                'icon' => '⚠️',
                'color' => 'text-orange-600 bg-orange-100',
                'title' => 'Tidak Ada Event Aktif',
                'desc' => "Saat ini tidak ada event terbaru. Segera buat event baru untuk mempertahankan aktivitas komunitas."
            ];
        } else {
            $insights[] = [
                'icon' => '💡',
                'color' => 'text-purple-600 bg-purple-100',
                'title' => 'Optimalisasi Fitur',
                'desc' => "Terdapat $fiturAktif fitur aktif. Pastikan informasi pada menu Riset dan Pengumuman selalu ter-update."
            ];
        }

        return view('admin.analitik', compact(
            'totalUsers', 'usersThisMonth', 'nonAnggota', 'totalViews', 
            'fiturAktif', 'avgPerMonth', 'latestReports', 'latestEvents', 'insights'
        ));
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Event;
use App\Models\Report;
use App\Models\Dictionary;
use App\Models\Organization;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // ============================================================
        // STAT CARDS
        // ============================================================

        // Total anggota (user dengan role 'user')
        $totalAnggota = User::where('role', 'user')->count();

        // Anggota baru bulan ini
        $anggotaBulanIni = User::where('role', 'user')
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        // Total event (kegiatan aktif = event yang tanggalnya >= hari ini)
        $totalEvents = Event::count();
        $upcomingEvents = Event::where('event_date', '>=', Carbon::today())->count();

        // Total laporan/riset
        $totalReports = Report::count();

        // Laporan baru minggu ini
        $reportsMingguIni = Report::where('created_at', '>=', Carbon::now()->startOfWeek())->count();

        // Total istilah kamus
        $totalDictionary = Dictionary::count();

        // ============================================================
        // AKTIVITAS TERBARU (gabungan dari beberapa tabel)
        // ============================================================
        $activities = collect();

        // User baru (anggota)
        $newUsers = User::where('role', 'user')
            ->latest()
            ->take(3)
            ->get()
            ->map(fn($u) => [
                'type'  => 'user',
                'color' => 'bg-emerald-500',
                'text'  => "Anggota baru: {$u->name}",
                'time'  => $u->created_at,
            ]);

        // Event terbaru
        $newEvents = Event::latest()
            ->take(3)
            ->get()
            ->map(fn($e) => [
                'type'  => 'event',
                'color' => 'bg-amber-500',
                'text'  => "Kegiatan: {$e->title}",
                'time'  => $e->created_at,
            ]);

        // Laporan terbaru
        $newReports = Report::latest()
            ->take(3)
            ->get()
            ->map(fn($r) => [
                'type'  => 'report',
                'color' => 'bg-sky-500',
                'text'  => "Riset dipublikasi: {$r->title}",
                'time'  => $r->created_at,
            ]);

        // Gabungkan & urutkan berdasarkan waktu terbaru, ambil 6 teratas
        $activities = $newUsers
            ->concat($newEvents)
            ->concat($newReports)
            ->sortByDesc('time')
            ->take(6)
            ->values();

        // ============================================================
        // PERTUMBUHAN ANGGOTA (6 bulan terakhir)
        // ============================================================
        $memberGrowth = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $count = User::where('role', 'user')
                ->whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();

            // Hitung total kumulatif sampai bulan ini
            $cumulative = User::where('role', 'user')
                ->where('created_at', '<=', $month->endOfMonth())
                ->count();

            $memberGrowth[] = [
                'm' => $month->format('M'),   // Label bulan (Jan, Feb, dst)
                'v' => $cumulative,            // Nilai kumulatif
                'new' => $count,               // Anggota baru bulan itu
            ];
        }

        // ============================================================
        // DATA GRAFIK — Event per bulan (6 bulan terakhir)
        // ============================================================
        $eventChartLabels = [];
        $eventChartData   = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $count = Event::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
            $eventChartLabels[] = $month->format('M');
            $eventChartData[]   = $count;
        }

        // ============================================================
        // DATA GRAFIK — Report per bulan (6 bulan terakhir)
        // ============================================================
        $reportChartLabels = [];
        $reportChartData   = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $count = Report::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
            $reportChartLabels[] = $month->format('M');
            $reportChartData[]   = $count;
        }

        // ============================================================
        // TOP EVENTS (paling banyak dikunjungi — simulasi: ambil terbaru)
        // ============================================================
        $topEvents = Event::latest()->take(6)->get()->map(fn($e, $i) => [
            'label' => \Str::limit($e->title, 20),
            'full'  => $e->title,
            'klik'  => max(50, 400 - ($i * 60)), // placeholder klik, ganti dengan kolom views jika ada
        ])->values();

        // ============================================================
        // TOP REPORTS (paling banyak dibaca — simulasi: ambil terbaru)
        // ============================================================
        $topReports = Report::latest()->take(6)->get()->map(fn($r, $i) => [
            'label' => \Str::limit($r->title, 20),
            'full'  => $r->title,
            'klik'  => max(50, 400 - ($i * 45)),
        ])->values();

        // ============================================================
        // UPCOMING EVENTS (event mendatang, maks 5)
        // ============================================================
        $upcomingEventList = Event::where('event_date', '>=', Carbon::today())
            ->orderBy('event_date', 'asc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            // Stat cards
            'totalAnggota',
            'anggotaBulanIni',
            'totalEvents',
            'upcomingEvents',
            'totalReports',
            'reportsMingguIni',
            'totalDictionary',
            // Aktivitas
            'activities',
            // Pertumbuhan anggota
            'memberGrowth',
            // Grafik event & report
            'eventChartLabels',
            'eventChartData',
            'reportChartLabels',
            'reportChartData',
            // Top events & reports
            'topEvents',
            'topReports',
            // Upcoming events
            'upcomingEventList',
        ));
    }
}
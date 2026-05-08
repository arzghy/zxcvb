<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AnalitikController;
use App\Http\Controllers\Admin\AnggotaController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\LombaController;
use App\Http\Controllers\Admin\RisetController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\HomeContentController;

Route::get('/', function () {
    $header = \App\Models\Header::first();
    return view('welcome', compact('header'));
});

// ============================================================
// ADMIN AUTH ROUTES (tidak butuh login)
// ============================================================
Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/', function () {
        if (auth()->check() && auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('admin.login');
    });

    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
});

// ============================================================
// ADMIN PROTECTED ROUTES (wajib login sebagai admin)
// ============================================================
Route::prefix('admin')->name('admin.')->middleware('admin.auth')->group(function () {

    // Overview
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/analitik', [AnalitikController::class, 'index'])->name('analitik');

    // Konten & Data
    Route::get('/anggota', [AnggotaController::class, 'index'])->name('anggota.index');
    Route::post('/anggota', [AnggotaController::class, 'store'])->name('anggota.store');
    Route::put('/anggota/{id}', [AnggotaController::class, 'update'])->name('anggota.update');
    Route::delete('/anggota/{id}', [AnggotaController::class, 'destroy'])->name('anggota.destroy');

    // Kegiatan — menggunakan controller agar data dari DB
    Route::get('/kegiatan', [EventController::class, 'kegiatanIndex'])->name('kegiatan');
    Route::post('/kegiatan', [EventController::class, 'store'])->name('event.store');
    Route::put('/kegiatan/{id}', [EventController::class, 'update'])->name('event.update');
    Route::delete('/kegiatan/{id}', [EventController::class, 'destroy'])->name('event.destroy');

    // Routes untuk Lomba
    Route::get('/lomba', [LombaController::class, 'index'])->name('lomba.index');
    Route::post('/lomba', [LombaController::class, 'store'])->name('lomba.store');
    Route::put('/lomba/{id}', [LombaController::class, 'update'])->name('lomba.update');
    Route::delete('/lomba/{id}', [LombaController::class, 'destroy'])->name('lomba.destroy');

    // Routes untuk Riset & Publikasi
    Route::get('/riset', [RisetController::class, 'index'])->name('riset.index');
    Route::post('/riset', [RisetController::class, 'store'])->name('riset.store');
    Route::put('/riset/{id}', [RisetController::class, 'update'])->name('riset.update');
    Route::delete('/riset/{id}', [RisetController::class, 'destroy'])->name('riset.destroy');
    Route::get('/riset/pdf/{id}', [RisetController::class, 'showPdf'])->name('riset.pdf');

    // Routes untuk Pengumuman
    Route::get('/pengumuman', [AnnouncementController::class, 'index'])->name('pengumuman.index');
    Route::post('/pengumuman', [AnnouncementController::class, 'store'])->name('pengumuman.store');
    Route::put('/pengumuman/{id}', [AnnouncementController::class, 'update'])->name('pengumuman.update');
    Route::delete('/pengumuman/{id}', [AnnouncementController::class, 'destroy'])->name('pengumuman.destroy');

    // Halaman Landing
    // Routes untuk Home Content
    Route::get('/home-content', [HomeContentController::class, 'index'])->name('home_content.index');
    Route::post('/home-content/save', [HomeContentController::class, 'saveContent'])->name('home_content.save');
    Route::post('/home-content/ticker', [HomeContentController::class, 'saveTicker'])->name('ticker.save');
    Route::delete('/home-content/ticker/{id}', [HomeContentController::class, 'destroyTicker'])->name('ticker.destroy');

    Route::get('/about-us', fn() => view('admin.about_us.edit'))->name('about_us.edit');
    Route::get('/gallery', fn() => view('admin.gallery'))->name('gallery');
    Route::get('/rekrutmen', fn() => view('admin.rekrutmen'))->name('rekrutmen');
    Route::get('/contact', fn() => view('admin.contact'))->name('contact');

    // Tools
    Route::get('/kalkulator', fn() => view('admin.kalkulator'))->name('kalkulator');
    Route::get('/kamus', fn() => view('admin.kamus'))->name('kamus');
    Route::get('/market', fn() => view('admin.market'))->name('market');

    // Pengaturan
    Route::get('/pengaturan', fn() => view('admin.pengaturan'))->name('pengaturan');
});
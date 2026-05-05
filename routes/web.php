<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AnalitikController;
use App\Http\Controllers\Admin\AnggotaController;

Route::get('/', function () {
    $header = \App\Models\Header::first();
    return view('welcome', compact('header'));
});

// ============================================================
// ADMIN AUTH ROUTES (tidak butuh login)
// ============================================================
Route::prefix('admin')->name('admin.')->group(function () {

    // Tambahkan ini ↓
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
    Route::get('/kegiatan', fn() => view('admin.kegiatan'))->name('kegiatan');
    Route::get('/lomba', fn() => view('admin.lomba'))->name('lomba');
    Route::get('/riset', fn() => view('admin.riset'))->name('riset');
    Route::get('/pengumuman', fn() => view('admin.pengumuman'))->name('pengumuman');

    // Fitur Esensial
    Route::get('/faq', fn() => view('admin.faq'))->name('faq');
    Route::get('/reviews', fn() => view('admin.reviews'))->name('reviews');

    // Halaman Landing
    Route::get('/home-content', fn() => view('admin.home_content'))->name('home_content');
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
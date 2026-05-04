<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController; // <-- tambahkan ini

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function () {
    // Overview
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard'); // <-- ubah ini
    Route::get('/analitik', function () { return view('admin.analitik'); })->name('admin.analitik');

    // Konten & Data
    Route::get('/anggota', function () { return view('admin.anggota'); })->name('admin.anggota');
    Route::get('/kegiatan', function () { return view('admin.kegiatan'); })->name('admin.kegiatan');
    Route::get('/lomba', function () { return view('admin.lomba'); })->name('admin.lomba');
    Route::get('/riset', function () { return view('admin.riset'); })->name('admin.riset');
    Route::get('/pengumuman', function () { return view('admin.pengumuman'); })->name('admin.pengumuman');

    // Fitur Esensial
    Route::get('/faq', function () { return view('admin.faq'); })->name('admin.faq');
    Route::get('/reviews', function () { return view('admin.reviews'); })->name('admin.reviews');

    // Halaman Landing
    Route::get('/home-content', function () { return view('admin.home_content'); })->name('admin.home_content');
    Route::get('/about-us', function () { return view('admin.about_us.edit'); })->name('admin.about_us.edit');
    Route::get('/gallery', function () { return view('admin.gallery'); })->name('admin.gallery');
    Route::get('/rekrutmen', function () { return view('admin.rekrutmen'); })->name('admin.rekrutmen');
    Route::get('/contact', function () { return view('admin.contact'); })->name('admin.contact');

    // Tools
    Route::get('/kalkulator', function () { return view('admin.kalkulator'); })->name('admin.kalkulator');
    Route::get('/kamus', function () { return view('admin.kamus'); })->name('admin.kamus');
    Route::get('/market', function () { return view('admin.market'); })->name('admin.market');

    // Pengaturan
    Route::get('/pengaturan', function () { return view('admin.pengaturan'); })->name('admin.pengaturan');
});
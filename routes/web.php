<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HeaderController;
use App\Http\Controllers\Admin\AboutUsController;
use App\Models\Header;

// Route untuk halaman User (Frontend)
Route::get('/', function () {
    $header = Header::first(); // Ambil data header dari database
    return view('welcome', compact('header'));
});

// Route untuk halaman Admin
Route::prefix('admin')->group(function () {
    Route::get('/header', [HeaderController::class, 'edit'])->name('admin.header.edit');
    Route::post('/header', [HeaderController::class, 'update'])->name('admin.header.update');

    Route::get('/about-us', [AboutUsController::class, 'edit'])->name('admin.about_us.edit');
    Route::post('/about-us', [AboutUsController::class, 'update'])->name('admin.about_us.update');
});
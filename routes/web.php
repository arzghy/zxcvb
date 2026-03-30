<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HeaderController;
use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\OrganizationController;
use App\Http\Controllers\Admin\SimulationController;
use App\Http\Controllers\Admin\DictionaryController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\ReportController;
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

    Route::get('/organization', [OrganizationController::class, 'index'])->name('admin.organization.index');
    Route::get('/organization/create', [OrganizationController::class, 'create'])->name('admin.organization.create');
    Route::post('/organization', [OrganizationController::class, 'store'])->name('admin.organization.store');
    Route::delete('/organization/{id}', [OrganizationController::class, 'destroy'])->name('admin.organization.destroy');

    // Route Simulasi Nabung
    Route::get('/simulation', [SimulationController::class, 'index'])->name('admin.simulation.index');
    Route::post('/simulation', [SimulationController::class, 'update'])->name('admin.simulation.update');

    // Route Kamus Pasar Modal
    Route::get('/dictionary', [DictionaryController::class, 'index'])->name('admin.dictionary.index');
    Route::post('/dictionary', [DictionaryController::class, 'store'])->name('admin.dictionary.store');
    Route::delete('/dictionary/{id}', [DictionaryController::class, 'destroy'])->name('admin.dictionary.destroy');

    // Route Event
    Route::get('/event', [EventController::class, 'index'])->name('admin.event.index');
    Route::post('/event', [EventController::class, 'store'])->name('admin.event.store');
    Route::delete('/event/{id}', [EventController::class, 'destroy'])->name('admin.event.destroy');

    // Route Report
    Route::get('/report', [ReportController::class, 'index'])->name('admin.report.index');
    Route::post('/report', [ReportController::class, 'store'])->name('admin.report.store');
    Route::delete('/report/{id}', [ReportController::class, 'destroy'])->name('admin.report.destroy');
});
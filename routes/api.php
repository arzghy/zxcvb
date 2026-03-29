<?php

use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\HeaderController;
use App\Http\Controllers\Admin\AboutUsController;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route Register
Route::post('/register', [AuthController::class, 'register']);
// Route Login
Route::post('/login', [AuthController::class, 'login']);
// Route Admin Login
Route::post('/admin/login', [AuthController::class, 'loginAdmin']);
// Route Admin Header
Route::post('/admin/header', [HeaderController::class, 'updateApi']);
// Route Admin About Us
Route::post('/admin/about-us', [AboutUsController::class, 'updateApi']);
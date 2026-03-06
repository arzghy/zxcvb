<?php

use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
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

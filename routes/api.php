<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProdukApiController;
use App\Http\Controllers\Api\CartApiController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;

// ==========================================
// 1. PUBLIC ROUTES (BEBAS DIAKSES FLUTTER)
// ==========================================

// AUTH
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// PRODUK (PUBLIC – UNTUK FLUTTER)
Route::get('/produk', [ProdukApiController::class, 'index']);
Route::post('/produk', [ProdukApiController::class, 'store']);
Route::put('/produk/{id}', [ProdukApiController::class, 'update']);
Route::delete('/produk/{id}', [ProdukApiController::class, 'destroy']);

// ==========================================
// 🔥 ROUTE KHUSUS GAMBAR (ANTI CORS FLUTTER WEB)
// ==========================================
// CONTOH AKSES:
// http://127.0.0.1:8000/api/image/produk/default.jpg

Route::get('/image/{path}', function ($path) {
    $fullPath = storage_path('app/public/' . $path);

    if (!file_exists($fullPath)) {
        abort(404);
    }

    return response()->file($fullPath, [
        'Access-Control-Allow-Origin' => '*',
        'Access-Control-Allow-Methods' => 'GET, OPTIONS',
        'Access-Control-Allow-Headers' => '*',
    ]);
})->where('path', '.*');

// ==========================================
// 2. PROTECTED ROUTES (WAJIB LOGIN)
// ==========================================
Route::middleware('auth:sanctum')->group(function () {

    Route::get('/cart', [CartApiController::class, 'index']);
    Route::post('/cart', [CartApiController::class, 'store']);
    Route::patch('/cart/{id}', [CartApiController::class, 'update']);
    Route::delete('/cart/{id}', [CartApiController::class, 'destroy']);

});

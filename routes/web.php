<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProdukController; // Admin ProdukController
use App\Http\Controllers\Customer\ProdukController as CustomerProdukController; 
use App\Http\Controllers\Customer\CartController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    return redirect()->route('produk.index');
})->middleware(['auth', 'verified'])->name('dashboard');




Route::middleware('auth')->group(function () {
    Route::resource('produk', ProdukController::class);
});


Route::middleware('auth')->group(function () {
    Route::get('/customer/produk', function () {
        $user = Auth::user();
        if (strtolower($user->role) === 'customer') {
            return app(CustomerProdukController::class)->index();
        }
        abort(403, 'Akses ditolak.');
    })->name('customer.produk');
});


Route::middleware('auth')->group(function () {

   
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

   
    Route::post('/cart/{produkId}', [CartController::class, 'store'])->name('cart.store');

    
    Route::patch('/cart/{id}', [CartController::class, 'update'])->name('cart.update');

    
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
});


Route::post('/logout', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

require __DIR__.'/auth.php';

<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\View\View;

class ProdukController extends Controller
{
    public function index(): View
    {
        $produk = Produk::all(); 
        return view('customer.produk.index', compact('produk'));
    }
}

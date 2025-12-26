<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;

class CartController extends Controller
{
    
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('customer.produk.cart.index', compact('cart'));
    }

    public function store($produkId)
    {
        $product = Produk::findOrFail($produkId);

        $cart = session()->get('cart', []);

        if (isset($cart[$produkId])) {
            $cart[$produkId]['jumlah']++;
        } else {
            $cart[$produkId] = [
                "id" => $product->id,
                "nama" => $product->Nama_produk,
                "harga" => $product->Harga,
                "gambar" => $product->gambar,
                "jumlah" => 1,
            ];
        }

        session()->put('cart', $cart);

       
        return redirect()->route('cart.index')
            ->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

  
    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['jumlah'] = max(1, $request->jumlah);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')
            ->with('success', 'Keranjang berhasil diperbarui!');
    }

    
    public function destroy($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')
            ->with('success', 'Produk berhasil dihapus dari keranjang!');
    }
}

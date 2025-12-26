<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartApiController extends Controller
{
    
    public function index(Request $request)
    {
        $cart = Cart::with('produk')
            ->where('user_id', $request->user()->id)
            ->get();

        return response()->json([
            'data' => $cart
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:produk,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = Cart::create([
            'user_id' => $request->user()->id,
            'produk_id' => $request->produk_id,
            'quantity' => $request->quantity,
        ]);

        return response()->json([
            'message' => 'Produk ditambahkan ke cart',
            'data' => $cart
        ], 201);
    }

    
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = Cart::where('id', $id)
            ->where('user_id', $request->user()->id)
            ->firstOrFail();

        $cart->update([
            'quantity' => $request->quantity,
        ]);

        return response()->json([
            'message' => 'Quantity cart diupdate',
            'data' => $cart
        ]);
    }

   
    public function destroy(Request $request, $id)
    {
        $cart = Cart::where('id', $id)
            ->where('user_id', $request->user()->id)
            ->firstOrFail();

        $cart->delete();

        return response()->json([
            'message' => 'Item cart dihapus'
        ]);
    }
}

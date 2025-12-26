<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukApiController extends Controller
{
 
    public function index()
    {
        return response()->json([
            'data' => Produk::all()
        ]);
    }

  
    public function store(Request $request)
    {
        
        if ($request->user()->role !== 'admin') {
            return response()->json([
                'message' => 'Akses ditolak. Hanya admin yang boleh menambah produk.'
            ], 403);
        }

        
        $request->validate([
            'Nama_produk' => 'required|string',
            'Deskripsi_produk' => 'required|string',
            'Kategori_produk' => 'required|string',
            'Varian_produk' => 'required|string',
            'Harga' => 'required|numeric',
            'gambar' => 'nullable|string',
        ]);

       
        $produk = Produk::create([
            'Nama_produk' => $request->Nama_produk,
            'Deskripsi_produk' => $request->Deskripsi_produk,
            'Kategori_produk' => $request->Kategori_produk,
            'Varian_produk' => $request->Varian_produk,
            'Harga' => $request->Harga,
            'gambar' => $request->gambar ?? null,
        ]);

        return response()->json([
            'message' => 'Produk berhasil ditambahkan',
            'data' => $produk
        ], 201);
    }

  
    public function update(Request $request, $id)
    {
       
        if ($request->user()->role !== 'admin') {
            return response()->json([
                'message' => 'Akses ditolak. Hanya admin yang boleh update produk.'
            ], 403);
        }

        $produk = Produk::findOrFail($id);

      
        $request->validate([
            'Nama_produk' => 'sometimes|string',
            'Deskripsi_produk' => 'sometimes|string',
            'Kategori_produk' => 'sometimes|string',
            'Varian_produk' => 'sometimes|string',
            'Harga' => 'sometimes|numeric',
            'gambar' => 'nullable|string',
        ]);

       
        $produk->update($request->only([
            'Nama_produk',
            'Deskripsi_produk',
            'Kategori_produk',
            'Varian_produk',
            'Harga',
            'gambar',
        ]));

        return response()->json([
            'message' => 'Produk berhasil diupdate',
            'data' => $produk
        ]);
    }

   
    public function destroy(Request $request, $id)
    {
       
        if ($request->user()->role !== 'admin') {
            return response()->json([
                'message' => 'Akses ditolak. Hanya admin yang boleh menghapus produk.'
            ], 403);
        }

        $produk = Produk::findOrFail($id);
        $produk->delete();

        return response()->json([
            'message' => 'Produk berhasil dihapus'
        ]);
    }
}

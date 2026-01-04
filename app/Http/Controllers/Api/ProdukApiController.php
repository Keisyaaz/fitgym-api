<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class ProdukApiController extends Controller
{
    // ==================================
    // GET ALL PRODUK
    // ==================================
    public function index()
    {
        $produk = Produk::all()->map(function ($item) {

            $gambar = $item->gambar ?? 'produk/default.jpg';

            return [
                'id' => $item->id,
                'Nama_produk' => $item->Nama_produk,
                'Deskripsi_produk' => $item->Deskripsi_produk,
                'Kategori_produk' => $item->Kategori_produk,
                'Varian_produk' => $item->Varian_produk,
                'Harga' => $item->Harga,
                'gambar' => $gambar,
                'gambar_url' => asset($gambar), // 🔥 PENTING (WEB + FLUTTER)
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
            ];
        });

        return response()->json([
            'data' => $produk
        ]);
    }

    // ==================================
    // STORE PRODUK (ADMIN)
    // ==================================
    public function store(Request $request)
    {
        // Cek role admin
        $user = $request->user();
        if ($user && $user->role !== 'admin') {
            return response()->json(['message' => 'Akses ditolak'], 403);
        }

        // Validasi
        $validator = Validator::make($request->all(), [
            'Nama_produk'      => 'required|string',
            'Deskripsi_produk' => 'required|string',
            'Kategori_produk'  => 'required|string',
            'Varian_produk'    => 'required|string',
            'Harga'            => 'required|numeric',
            'gambar'           => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $input = $request->except(['gambar']);

        // Upload gambar ke PUBLIC
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $nama = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('produk'), $nama);
            $input['gambar'] = 'produk/' . $nama;
        }

        $produk = Produk::create($input);

        return response()->json([
            'message' => 'Produk berhasil ditambahkan',
            'data' => [
                'id' => $produk->id,
                'Nama_produk' => $produk->Nama_produk,
                'Harga' => $produk->Harga,
                'gambar_url' => asset($produk->gambar ?? 'produk/default.jpg'),
            ]
        ], 201);
    }

    // ==================================
    // UPDATE PRODUK (ADMIN)
    // ==================================
    public function update(Request $request, $id)
    {
        $user = $request->user();
        if ($user && $user->role !== 'admin') {
            return response()->json(['message' => 'Akses ditolak'], 403);
        }

        $produk = Produk::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'Nama_produk' => 'sometimes|string',
            'Deskripsi_produk' => 'sometimes|string',
            'Kategori_produk' => 'sometimes|string',
            'Varian_produk' => 'sometimes|string',
            'Harga' => 'sometimes|numeric',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $input = $request->except(['gambar']);

        // Upload gambar baru
        if ($request->hasFile('gambar')) {

            // Hapus gambar lama
            if ($produk->gambar && File::exists(public_path($produk->gambar))) {
                File::delete(public_path($produk->gambar));
            }

            $file = $request->file('gambar');
            $nama = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('produk'), $nama);

            $input['gambar'] = 'produk/' . $nama;
        }

        $produk->update($input);

        return response()->json([
            'message' => 'Produk berhasil diupdate',
            'data' => [
                'id' => $produk->id,
                'Nama_produk' => $produk->Nama_produk,
                'Harga' => $produk->Harga,
                'gambar_url' => asset($produk->gambar ?? 'produk/default.jpg'),
            ]
        ]);
    }

    // ==================================
    // DELETE PRODUK (ADMIN)
    // ==================================
    public function destroy(Request $request, $id)
    {
        $user = $request->user();
        if ($user && $user->role !== 'admin') {
            return response()->json(['message' => 'Akses ditolak'], 403);
        }

        $produk = Produk::findOrFail($id);

        // Hapus gambar
        if ($produk->gambar && File::exists(public_path($produk->gambar))) {
            File::delete(public_path($produk->gambar));
        }

        $produk->delete();

        return response()->json([
            'message' => 'Produk berhasil dihapus'
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::all();
        return view('produk.index', compact('produk'));
    }

    public function create()
    {
        return view('produk.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Nama_produk' => 'required|string|max:255',
            'Deskripsi_produk' => 'nullable|string',
            'Kategori_produk' => 'nullable|string',
            'Varian_produk' => 'required|string',
            'Harga' => 'required|numeric',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // SIMPAN GAMBAR KE public/produk
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $nama = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('produk'), $nama);

            $validated['gambar'] = 'produk/'.$nama;
        }

        Produk::create($validated);

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit(Produk $produk)
    {
        return view('produk.edit', compact('produk'));
    }

    public function update(Request $request, Produk $produk)
    {
        $validated = $request->validate([
            'Nama_produk' => 'required|string|max:255',
            'Deskripsi_produk' => 'nullable|string',
            'Kategori_produk' => 'nullable|string',
            'Varian_produk' => 'required|string',
            'Harga' => 'required|numeric',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            // hapus gambar lama
            if ($produk->gambar && File::exists(public_path($produk->gambar))) {
                File::delete(public_path($produk->gambar));
            }

            $file = $request->file('gambar');
            $nama = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('produk'), $nama);

            $validated['gambar'] = 'produk/'.$nama;
        }

        $produk->update($validated);

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy(Produk $produk)
    {
        if ($produk->gambar && File::exists(public_path($produk->gambar))) {
            File::delete(public_path($produk->gambar));
        }

        $produk->delete();

        return redirect()->route('produk.index')
            ->with('success', 'Produk berhasil dihapus!');
    }

    public function show(Produk $produk)
    {
        return view('produk.show', compact('produk'));
    }
}

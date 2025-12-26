<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('produk', 'public');
        }

        Produk::create([
            'Nama_produk' => $validated['Nama_produk'],
            'Deskripsi_produk' => $validated['Deskripsi_produk'],
            'Kategori_produk' => $validated['Kategori_produk'],
            'Varian_produk' => $validated['Varian_produk'],
            'Harga' => $validated['Harga'],
            'gambar' => $gambarPath,
        ]);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan!');
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
            // Hapus gambar lama jika ada
            if ($produk->gambar) {
                Storage::disk('public')->delete($produk->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('produk', 'public');
        } else {
            $validated['gambar'] = $produk->gambar; 
        }

        $produk->update($validated);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui!');
    }

   
    public function destroy(Produk $produk)
    {
        if ($produk->gambar) {
            Storage::disk('public')->delete($produk->gambar);
        }
        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus!');
    }

    

    
    public function show(Produk $produk)
    {
        return view('produk.show', compact('produk'));
    }
}

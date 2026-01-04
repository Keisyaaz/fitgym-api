@extends('layouts.admin')

@section('title', 'Daftar Produk')

@section('content')
<style>
    .container-table { max-width: 1400px; margin: 20px auto; background: #fff; padding: 25px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
    h2 { text-align: center; margin-bottom: 20px; }
    table { width: 100%; border-collapse: collapse; }
    th, td { padding: 12px; border: 1px solid #ddd; text-align: center; }
    th { background: #f4f4f4; }
    .btn { padding: 5px 10px; border-radius: 4px; text-decoration: none; color: white; display: inline-block; margin: 2px; }
    .btn-primary { background: blue; } .btn-warning { background: orange; } .btn-danger { background: red; }
</style>

<div class="container-table">
    <h2>Daftar Produk</h2>
    <a href="{{ route('produk.create') }}" class="btn btn-primary" style="margin-bottom: 15px;">Tambah Produk</a>

    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Kategori</th>
                <th>Varian</th>
                <th>Harga</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($produk as $item)
                <tr>
                    <td>{{ $item->Nama_produk }}</td>
                    <td>{{ $item->Deskripsi_produk }}</td>
                    <td>{{ $item->Kategori_produk }}</td>
                    <td>{{ $item->Varian_produk }}</td>
                    <td>Rp {{ number_format($item->Harga, 0, ',', '.') }}</td>
                    <td>
                        @if($item->gambar)
                            {{-- PENTING: Panggil via folder STORAGE --}}
                            <img src="{{ asset($produk->gambar) }}"
 
                                 alt="Produk" width="80" height="80" style="object-fit: cover; border-radius: 5px;">
                        @else
                            <span style="color:red; font-size: 12px;">No Image</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('produk.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('produk.destroy', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
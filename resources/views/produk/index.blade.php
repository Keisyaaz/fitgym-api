@extends('layouts.admin')

@section('title', 'Daftar Produk')

@section('content')
<style>
    .container-table {
        max-width: 1400px;
        margin: 20px auto;
        background: #fff;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    h2 {
        text-align: center;
        margin-bottom: 20px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        padding: 12px;
        border: 1px solid #ddd;
        text-align: center;
        vertical-align: middle;
    }
    th {
        background: #f4f4f4;
    }
    .btn {
        padding: 6px 12px;
        border-radius: 4px;
        text-decoration: none;
        color: white;
        display: inline-block;
        margin: 2px;
        font-size: 14px;
    }
    .btn-primary { background: #007bff; }
    .btn-warning { background: #ffc107; color: #000; }
    .btn-danger  { background: #dc3545; }
    img {
        object-fit: cover;
        border-radius: 6px;
    }
</style>

<div class="container-table">
    <h2>Daftar Produk</h2>

    <a href="{{ route('produk.create') }}" class="btn btn-primary" style="margin-bottom: 15px;">
        + Tambah Produk
    </a>

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
            @forelse($produk as $item)
                <tr>
                    <td>{{ $item->Nama_produk }}</td>
                    <td>{{ $item->Deskripsi_produk }}</td>
                    <td>{{ $item->Kategori_produk }}</td>
                    <td>{{ $item->Varian_produk }}</td>
                    <td>Rp {{ number_format($item->Harga, 0, ',', '.') }}</td>

                    <td>
                        @if($item->gambar && file_exists(public_path($item->gambar)))
                            <img src="{{ asset($item->gambar) }}" width="80" height="80">
                        @else
                            <span style="color:red; font-size:12px;">No Image</span>
                        @endif
                    </td>

                    <td>
                        <a href="{{ route('produk.edit', $item->id) }}" class="btn btn-warning">
                            Edit
                        </a>

                        <form action="{{ route('produk.destroy', $item->id) }}"
                              method="POST"
                              style="display:inline;"
                              onsubmit="return confirm('Yakin hapus produk ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align:center; color:#888;">
                        Belum ada produk
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
@section('title', 'Produk Terbaru')
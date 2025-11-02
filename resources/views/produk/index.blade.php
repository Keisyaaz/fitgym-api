<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
            color: #333;
        }

        h2 {
            color: #2c3e50;
            margin-bottom: 20px;
        }

        a {
            text-decoration: none;
            color: #3498db;
            margin-right: 10px;
        }

        a:hover {
            text-decoration: underline;
            color: #2980b9;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #2c3e50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        img {
            border-radius: 5px;
        }

        td a {
            margin-right: 8px;
            font-weight: bold;
        }

        td a:hover {
            color: #e74c3c;
        }

        .actions {
            margin-bottom: 20px;
        }

        .actions a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #2979FF;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .actions a:hover {
            background-color: #1a5ed9;
        }

        form {
            display: inline;
        }

        button.delete-btn {
            background-color: red;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.2s;
        }

        button.delete-btn:hover {
            background-color: darkred;
        }
    </style>
</head>
<body>

<h2>Dashboard Produk</h2>

<div class="actions">
    <a href="{{ route('produk.create') }}">+ Tambah Produk</a>
</div>

<table>
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Deskripsi</th>
        <th>Kategori</th>
        <th>Varian</th>
        <th>Harga</th>
        <th>Gambar</th>
        <th>Aksi</th>
    </tr>

    @foreach($produk as $no => $item)
    <tr>
        <td>{{ $no + 1 }}</td>
        <td>{{ $item->Nama_produk }}</td>
        <td>{{ $item->Deskripsi_produk }}</td>
        <td>{{ $item->Kategori_produk }}</td>
        <td>{{ $item->Varian_produk }}</td>
        <td>Rp{{ number_format($item->Harga, 0, ',', '.') }}</td>
        <td>
            @if ($item->gambar)
                <img src="{{ asset('storage/' . $item->gambar) }}" width="100" alt="Gambar Produk">
            @else
                (Tidak ada gambar)
            @endif
        </td>
        <td>
            <a href="{{ route('produk.edit', $item->id) }}">Edit</a> |

            <form action="{{ route('produk.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin hapus produk ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-btn">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

</body>
</html>

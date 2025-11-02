<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Produk</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f7f9fc;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background: #fff;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            width: 400px;
        }

        h2 { text-align: center; color: #333; margin-bottom: 25px; }

        label {
            font-weight: 500;
            display: block;
            margin-bottom: 6px;
            color: #444;
        }

        input[type="text"], input[type="number"], textarea, input[type="file"] {
            width: 100%;
            padding: 10px 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
            background-color: #fafafa;
        }

        img {
            display: block;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #007bff;
            color: white;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover { background: #42F5F2; }
    </style>
</head>
<body>

<form method="post" enctype="multipart/form-data" action="{{ route('produk.update', $produk) }}">
    @csrf
    @method('PUT')

    <h2>Edit Produk</h2>

    <label for="nama">Nama Produk</label>
    <input name="nama" id="nama" value="{{ $produk->Nama_produk }}" required>

    <label for="deskripsi">Deskripsi</label>
    <textarea name="deskripsi" id="deskripsi">{{ $produk->Deskripsi_produk }}</textarea>

    <label for="kategori">Kategori</label>
    <textarea name="kategori" id="kategori">{{ $produk->Kategori_produk }}</textarea>

    <label for="varian">Varian</label>
    <input name="varian" id="varian" value="{{ $produk->Varian_produk }}" required>

    <label for="harga">Harga</label>
    <input type="number" name="harga" id="harga" value="{{ $produk->Harga }}" required>

    <label for="gambar">Gambar Baru (Opsional)</label>
    <input type="file" name="gambar" id="gambar" accept=".png,.jpg,.jpeg">

    @if ($produk->gambar)
        <img src="{{ asset('uploads/' . $produk->gambar) }}" width="100" alt="Gambar Produk">
    @endif

    <button type="submit">Update</button>
</form>

</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Produk</title>
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

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 25px;
        }

        label {
            font-weight: 500;
            display: block;
            margin-bottom: 6px;
            color: #444;
        }

        input[type="text"],
        input[type="number"],
        textarea,
        input[type="file"] {
            width: 100%;
            padding: 10px 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
            background-color: #fafafa;
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

        button:hover {
            background: #0056b3;
        }

        .back {
            text-align: center;
            margin-bottom: 15px;
        }

        .back a {
            text-decoration: none;
            color: #007bff;
        }

        .back a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <h2>Tambah Produk</h2>

    <div class="back">
        <a href="{{ route('produk.index') }}">← Kembali</a>
    </div>

    <label for="nama">Nama Produk</label>
    <input name="nama" id="nama" required>

    <label for="deskripsi">Deskripsi</label>
    <textarea name="deskripsi" id="deskripsi"></textarea>

    <label for="kategori">Kategori</label>
    <input name="kategori" id="kategori">

    <label for="varian">Varian</label>
    <input name="varian" id="varian" required>

    <label for="harga">Harga</label>
    <input type="number" name="harga" id="harga" required>

    <label for="gambar">Gambar (PNG/JPG)</label>
    <input type="file" name="gambar" id="gambar" accept=".png,.jpg,.jpeg">

    <button type="submit">Simpan</button>
</form>

</body>
</html>

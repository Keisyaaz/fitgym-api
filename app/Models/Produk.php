<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';

    protected $fillable = [
        'Nama_produk',
        'Deskripsi_produk',
        'Kategori_produk',
        'Varian_produk',
        'Harga',
        'gambar',
    ];
}


<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produk;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        
        $products = [
            [
                'Nama_produk' => 'Kaos FitGym Premium',
                'Deskripsi_produk' => 'Kaos gym bahan katun combed 30s, adem dan nyaman untuk latihan.',
                'Kategori_produk' => 'Kaos',
                'Varian_produk' => 'M',
                'Harga' => 85000,
                'gambar' => 'produk/kaos1.jpg',
            ],
            [
                'Nama_produk' => 'Hoodie FitGym Sport',
                'Deskripsi_produk' => 'Hoodie nyaman dan fleksibel, cocok untuk olahraga indoor maupun outdoor.',
                'Kategori_produk' => 'Hoodie',
                'Varian_produk' => 'L',
                'Harga' => 150000,
                'gambar' => 'produk/hoodie1.jpg',
            ],
            [
                'Nama_produk' => 'Celana Training FitGym',
                'Deskripsi_produk' => 'Celana training quick-dry yang membuat latihan lebih maksimal.',
                'Kategori_produk' => 'Celana',
                'Varian_produk' => 'XL',
                'Harga' => 120000,
                'gambar' => 'produk/celana1.jpg',
            ],
            [
                'Nama_produk' => 'Wristband FitGym',
                'Deskripsi_produk' => 'Wristband penyerap keringat untuk olahraga sehari-hari.',
                'Kategori_produk' => 'Aksesoris',
                'Varian_produk' => 'All Size',
                'Harga' => 25000,
                'gambar' => 'produk/wristband1.jpg',
            ],
        ];

        foreach ($products as $product) {
            Produk::create($product);
        }

       
        Produk::factory()->count(5)->create();
    }
}

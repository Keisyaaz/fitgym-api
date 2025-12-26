<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProdukFactory extends Factory
{
    public function definition(): array
    {
        return [
            'Nama_produk' => 'FitGym ' . $this->faker->word(),
            'Deskripsi_produk' => $this->faker->sentence(12),
            'Kategori_produk' => $this->faker->randomElement([
                'Kaos', 'Celana', 'Hoodie', 'Aksesoris'
            ]),
            'Varian_produk' => $this->faker->randomElement(['S', 'M', 'L', 'XL', 'All Size']),
            'Harga' => $this->faker->numberBetween(30000, 200000),
            'gambar' => 'produk/default.jpg',
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProdukFactory extends Factory
{
    public function definition(): array
    {
        return [
            'Nama_produk' => $this->faker->words(2, true),
            'Deskripsi_produk' => $this->faker->sentence(10),
            'Kategori_produk' => $this->faker->randomElement(['Kaos', 'Hoodie', 'Celana', 'Aksesoris']),
            'Varian_produk' => $this->faker->randomElement(['S', 'M', 'L', 'XL']),
            'Harga' => $this->faker->numberBetween(50000, 200000),
            'gambar' => 'default.jpg',
        ];
    }
}

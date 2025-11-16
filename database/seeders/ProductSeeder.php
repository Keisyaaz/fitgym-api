<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produk;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Produk::factory()->count(10)->create();
    }
}

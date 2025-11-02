<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pemesanan_produk', function (Blueprint $table) {
            $table->id('item_id');
            $table->string('order_id');
            $table->string('product_name');
            $table->string('varian')->nullable();
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pemesanan_produk');
    }
};

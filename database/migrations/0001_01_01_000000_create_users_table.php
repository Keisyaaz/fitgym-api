<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pelanggan', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('address')->nullable();
            $table->string('username')->unique();
            $table->string('password');
            $table->enum('role', ['admin', 'customer'])->default('customer');
            $table->enum('status_membership', ['aktif', 'nonaktif'])->default('nonaktif');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

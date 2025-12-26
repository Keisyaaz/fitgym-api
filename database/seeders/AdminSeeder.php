<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin FitGym',
            'email' => 'admin@fitgym.com',
            'username' => 'adminfitgym',
            'phone' => '081234567890',
            'address' => 'Jl. FitGym No.1',
            'password' => Hash::make('password123'), 
            'role' => 'admin',
            'status_membership' => 'aktif', 
        ]);

        $this->command->info('Admin user created successfully!');
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // =====================
    // REGISTER (AUTO ROLE BY EMAIL)
    // =====================
    public function register(Request $request)
    {
        // 1️⃣ Validasi input (TANPA role)
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        // 2️⃣ Tentukan role BERDASARKAN EMAIL
        $role = str_ends_with($request->email, '@fitgym.com')
            ? 'admin'
            : 'customer';

        // 3️⃣ Simpan user (HASH + ROLE OTOMATIS)
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $role,
        ]);

        // 4️⃣ Buat token Sanctum
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'message' => 'Register berhasil',
            'token' => $token,
            'role' => $user->role,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ]
        ], 201);
    }

    // =====================
    // LOGIN
    // =====================
    public function login(Request $request)
    {
        // 1️⃣ Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 2️⃣ Cari user berdasarkan email
        $user = User::where('email', $request->email)->first();

        // 3️⃣ Cek password (HASH)
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Email atau password salah'
            ], 401);
        }

        // 4️⃣ Buat token
        $token = $user->createToken('api-token')->plainTextToken;

        // 5️⃣ Response JSON
        return response()->json([
            'message' => 'Login berhasil',
            'token' => $token,
            'role' => $user->role,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ]
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Akun Admin & Akun Customer Uji Coba
        User::create([
            'name' => 'Admin Facc Game Store',
            'email' => 'admin@facc.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // 2. Buat Minimal 3 Kategori Game
        $mlbb = Category::create(['name' => 'Mobile Legends', 'slug' => 'mobile-legends']);
        $efootball = Category::create(['name' => 'eFootball Mobile', 'slug' => 'efootball-mobile']);
        $pubg = Category::create(['name' => 'PUBG Mobile', 'slug' => 'pubg-mobile']);

    }
}
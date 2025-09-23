<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat pengguna admin untuk sistem kasir
        User::factory()->create([
            'name' => 'Admin Kasir',
            'email' => 'admin@kasir.com',
        ]);

        // Buat pengguna kasir
        User::factory()->create([
            'name' => 'Kasir Utama',
            'email' => 'kasir@toko.com',
        ]);

        // Buat produk-produk contoh untuk toko
        $products = [
            [
                'name' => 'Nasi Gudeg Jogja',
                'description' => 'Nasi gudeg khas Yogyakarta dengan ayam dan telur',
                'price' => 25000,
                'stock' => 50
            ],
            [
                'name' => 'Soto Ayam Lamongan',
                'description' => 'Soto ayam segar dengan kuah bening dan rempah-rempah',
                'price' => 18000,
                'stock' => 30
            ],
            [
                'name' => 'Rendang Daging Sapi',
                'description' => 'Rendang daging sapi Padang dengan bumbu tradisional',
                'price' => 35000,
                'stock' => 25
            ],
            [
                'name' => 'Gado-gado Jakarta',
                'description' => 'Gado-gado dengan sayuran segar dan bumbu kacang',
                'price' => 15000,
                'stock' => 40
            ],
            [
                'name' => 'Bakso Malang',
                'description' => 'Bakso daging sapi dengan mie dan pangsit goreng',
                'price' => 20000,
                'stock' => 35
            ],
            [
                'name' => 'Nasi Liwet Solo',
                'description' => 'Nasi liwet khas Solo dengan lauk pauk lengkap',
                'price' => 22000,
                'stock' => 20
            ],
            [
                'name' => 'Es Teh Manis',
                'description' => 'Es teh manis segar untuk menemani makan',
                'price' => 5000,
                'stock' => 100
            ],
            [
                'name' => 'Es Jeruk Nipis',
                'description' => 'Es jeruk nipis segar dengan gula aren',
                'price' => 8000,
                'stock' => 80
            ],
            [
                'name' => 'Kopi Tubruk Jawa',
                'description' => 'Kopi tubruk tradisional dengan gula jawa',
                'price' => 10000,
                'stock' => 60
            ],
            [
                'name' => 'Kerupuk Udang',
                'description' => 'Kerupuk udang renyah sebagai pelengkap',
                'price' => 3000,
                'stock' => 150
            ],
            [
                'name' => 'Sambal Terasi',
                'description' => 'Sambal terasi pedas khas Jawa',
                'price' => 2000,
                'stock' => 200
            ],
            [
                'name' => 'Nasi Putih',
                'description' => 'Nasi putih pulen sebagai makanan pokok',
                'price' => 4000,
                'stock' => 120
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}

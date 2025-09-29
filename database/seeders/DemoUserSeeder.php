<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoUserSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Create admin user if not exists
        if (!User::where('username', 'admin')->exists()) {
            User::create([
                'name' => 'Administrator',
                'username' => 'admin',
                'email' => 'admin@sistemkasir.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin'
            ]);
        }

        // Create demo user if not exists
        if (!User::where('username', 'user')->exists()) {
            User::create([
                'name' => 'User Demo',
                'username' => 'user',
                'email' => 'user@sistemkasir.com',
                'password' => Hash::make('user123'),
                'role' => 'user'
            ]);
        }
    }
}

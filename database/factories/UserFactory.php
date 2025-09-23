<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $indonesianNames = [
            'Budi Santoso', 'Siti Nurhaliza', 'Ahmad Fauzi', 'Dewi Sartika',
            'Rudi Hartono', 'Maya Sari', 'Andi Wijaya', 'Rina Susanti',
            'Dedi Kurniawan', 'Lestari Wulandari', 'Hendra Gunawan', 'Yuni Astuti',
            'Agus Salim', 'Indah Permata', 'Joko Widodo', 'Sri Mulyani',
            'Bambang Surya', 'Ratna Sari', 'Eko Prasetyo', 'Fitri Handayani'
        ];

        return [
            'name' => fake()->randomElement($indonesianNames),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}

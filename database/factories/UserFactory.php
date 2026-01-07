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
    protected static ?string $password;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'username' => fake()->unique()->userName(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'alamat' => fake()->address(),
            'no_hp' => fake()->phoneNumber(),
            'status_akun' => 'aktif',
        ];
    }

    public function siswa(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'siswa',
            'nomor_identitas' => fake()->unique()->numerify('####'),
            'kelas' => fake()->randomElement(['XII RPL 1', 'XII RPL 2', 'XII TKJ 1', 'XII MM 1']),
            'jurusan_id' => fake()->numberBetween(1, 3),
        ]);
    }

    public function guru(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'guru',
            'nomor_identitas' => fake()->unique()->numerify('19##########'),
        ]);
    }

    public function industri(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'industri',
            'nomor_identitas' => fake()->unique()->numerify('NIK####'),
        ]);
    }
}

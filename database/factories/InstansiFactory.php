<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class InstansiFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nama_perusahaan' => fake()->company() . ' ' . fake()->companySuffix(),
            'alamat' => fake()->address(),
            'email_perusahaan' => fake()->companyEmail(),
            'telepon' => fake()->phoneNumber(),
            'website' => fake()->url(),
        ];
    }
}

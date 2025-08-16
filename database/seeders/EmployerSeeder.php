<?php

namespace Database\Seeders;

use App\Models\Employer;
use App\Models\User;
use Illuminate\Database\Seeder;

class EmployerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 30 employers with associated users
        for ($i = 0; $i < 30; $i++) {
            $user = User::factory()->create([
                'name' => fake()->company() . ' Admin',
                'email' => fake()->unique()->companyEmail(),
            ]);

            Employer::factory()->create([
                'user_id' => $user->id,
                'name' => fake()->company(),
                'location' => fake()->city() . ', ' . fake()->state(),
                'description' => fake()->paragraph(2),
            ]);
        }
    }
}

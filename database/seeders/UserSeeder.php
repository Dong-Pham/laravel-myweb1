<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('users')->insert([
                'fullname'   => fake()->name(),
                'username'   => fake()->unique()->userName(),
                'email'      => fake()->unique()->safeEmail(),
                'password'   => bcrypt('123456'),
                'phone'      => fake()->unique()->numerify('09########'),
                'address'    => fake()->address(),
                'gender'     => fake()->numberBetween(0, 2),
                'birthday'   => fake()->date('Y-m-d', '2005-01-01'),
                'role'       => fake()->numberBetween(1, 2),
                'status'     => fake()->numberBetween(0, 1),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
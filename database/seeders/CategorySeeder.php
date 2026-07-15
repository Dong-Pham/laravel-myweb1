<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $name = fake()->unique()->word();
            DB::table('categories')->insert([
                'catename' => ucfirst($name),
                'slug' => Str::slug($name),
                'image'       => 'category-' . rand(1, 5) . '.jpg',
                'status' => fake()->numberBetween(0, 1),
                'sort_order' => $i,
                'description' => fake()->sentence(30),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}

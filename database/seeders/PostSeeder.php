<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $title = fake()->sentence(6);
            DB::table('posts')->insert([
                'title'       => $title,
                'slug'        => Str::slug($title) . '-' . $i,
                'content'     => fake()->paragraph(5),
                'image'       => 'post-' . rand(1, 5) . '.jpg',
                'status'      => rand(0, 1),
                'user_id'     => rand(1, 10), // giả sử bạn đã seed 10 user
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }
    }
}

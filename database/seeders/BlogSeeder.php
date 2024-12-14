<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('blogs')->insert([
            'title' => Str::random(10),
            'content' => Str::random(10),
            'image_path' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

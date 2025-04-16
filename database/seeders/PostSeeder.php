<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use Illuminate\Support\Str;
class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            Post::create([
                'title' => "Цікавий пост $i",
                'content' => "Контент статті $i — Lorem ipsum...",
                'slug' => Str::slug("Цікавий пост $i")
            ]);
        }
    }
}

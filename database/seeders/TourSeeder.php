<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tour;
use Illuminate\Support\Facades\DB;


class TourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        for ($i = 1; $i <= 5; $i++) {
            Tour::create([
                'title' => "Тур №$i",
                'description' => "Опис туру №$i",
                'price' => rand(1000, 5000),
                'city_id' => rand(1, 5),
                'category_id' => rand(1, 5),
            ]);
        }

    }
}

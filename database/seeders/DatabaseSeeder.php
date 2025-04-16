<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            CitySeeder::class,
            CategorySeeder::class,
            TagSeeder::class,
            UserSeeder::class,
            PostSeeder::class,
            TourSeeder::class,
        ]);

    }
}

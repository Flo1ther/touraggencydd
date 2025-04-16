<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cities')->insert([
            ['name' => 'Львів'],
            ['name' => 'Київ'],
            ['name' => 'Одеса'],
            ['name' => 'Харків'],
            ['name' => 'Івано-Франківськ'],
        ]);

    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Виклик інших сидерів
        $this->call([
            RoleSeeder::class,
            CitySeeder::class,
            CategorySeeder::class,
            TagSeeder::class,
            UserSeeder::class,
            PostSeeder::class,
            TourSeeder::class,
            ServiceSeeder::class,
        ]);

        // Прив’язка ролі до першого користувача
        $adminRole = Role::where('name', 'admin')->first();
        $user = User::find(1);

        if ($user && $adminRole) {
            $user->role()->associate($adminRole);
            $user->save();
        }
    }
}

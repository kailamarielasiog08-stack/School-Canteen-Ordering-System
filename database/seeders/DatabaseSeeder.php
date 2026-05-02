<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Student User',
            'email' => 'student@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'student',
        ]);

        $snacks = \App\Models\Category::create(['name' => 'Snacks']);
        $drinks = \App\Models\Category::create(['name' => 'Drinks']);
        $meals = \App\Models\Category::create(['name' => 'Meals']);

        \App\Models\MenuItem::create([
            'category_id' => $snacks->id,
            'name' => 'Burger',
            'description' => 'Cheesy beef burger',
            'price' => 50,
            'is_available' => true,
        ]);

        \App\Models\MenuItem::create([
            'category_id' => $drinks->id,
            'name' => 'Iced Tea',
            'description' => 'Refreshing lemon iced tea',
            'price' => 20,
            'is_available' => true,
        ]);

        \App\Models\MenuItem::create([
            'category_id' => $meals->id,
            'name' => 'Chicken Adobo',
            'description' => 'Traditional Filipino chicken adobo with rice',
            'price' => 75,
            'is_available' => true,
        ]);
    }
}

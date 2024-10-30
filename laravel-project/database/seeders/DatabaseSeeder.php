<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Restaurant;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        User::truncate();
        User::factory()->create([
            'name' => 'Test User222',
            'email' => 'test@example222.com',
            'password' => 'test1234',
            'restaurant' => 'Dummy Restaurant'
        ]);
        Restaurant::truncate();
        Restaurant::factory()->create([
            'name' => 'Dummy Restaurant',
            'address' => '123 Dummy St, Test City',
            'contact' => '123-456-7890',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

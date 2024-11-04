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
        $user = User::factory()->create([
            'name' => 'TestUser1',
            'email' => 'test1@example.com',
            'password' => 'test1234'
        ]);
        User::factory()->create([
            'name' => 'TestUser2',
            'email' => 'test2@example.com',
            'password' => 'test1234'
        ]);
        Restaurant::truncate();
        Restaurant::factory()->create([
            'name' => 'Dummy Restaurant',
            'address' => '123 Dummy St, Test City',
            'contact' => '123-456-7890',
            'owner_id' => $user->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

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
            'name' => 'Test Restaurant',
            'address' => '123 Main Street',
            'owner_id' => $user->id,
            'menu' => 'https://example.com/menu',
            'horarios' => '9am - 9pm',
            'telefono' => '1234567890',
            'logo' => 'https://example.com/logo.png',
            'latitude' => '-34.542138752398856',
            'longitude' => '-58.44274203966781'
        ]);
    }
}

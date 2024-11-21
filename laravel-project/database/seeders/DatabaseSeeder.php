<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Restaurant;
use App\Models\Order;
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
        Restaurant::truncate();
        Order::truncate();
        
        $user = User::factory()->create([
            'name' => 'TestUser1',
            'email' => 'test1@example.com',
            'password' => 'test1234'
        ]);
        $user2 = User::factory()->create([
            'name' => 'TestUser2',
            'email' => 'test2@example.com',
            'password' => 'test1234'
        ]);
        $restaurant1 = Restaurant::factory()->create([
            'name' => 'Crustaceo Cascarudo',
            'address' => 'Fondo de Bikini',
            'owner_id' => $user->id,
            'menu' => 'https://example.com/menu-con-kangreburger-y-papafritas',
            'timetable' => '9am - 9pm',
            'contact' => '1234567890',
            'logo' => 'https://static.wikia.nocookie.net/spongebob/images/7/77/KrustyKrabStock.png/',
            'tables' => "4",
            'latitude' => '-34.5438384634825',
            'longitude'=> '-58.44024928096965'
        ]);
        $restaurant2 = Restaurant::factory()->create([
            'name' => 'Balde de Carnada',
            'address' => 'Fondo de Bikini (zona shady)',
            'owner_id' => $user->id,
            'menu' => 'https://example.com/menu-con-comida-fea',
            'timetable' => '9am - 10am',
            'contact' => '111222333',
            'logo' => 'https://static.wikia.nocookie.net/spongefan/images/e/ee/The_chum_bucket.jpg',
            'tables' => "1",
            'latitude' => '-34.5393994395381',
            'longitude'=>'-58.439175855892884'
        ]);

        Order::factory()->create([
            'restaurant' => $restaurant1->id,
            'table' => '4',
            'content' => 'Un café con leche y un rol de canela',
            'status' => 'Por preparar',
            'user_id' => $user2->id,
        ]);
    }
}

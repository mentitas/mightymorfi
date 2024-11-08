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
        $restaurant1 = Restaurant::factory()->create([
            'name' => 'Crustaceo Cascarudo',
            'address' => 'Fondo de Bikini',
            'owner_id' => $user->id,
            'menu' => 'https://example.com/menu-con-kangreburger-y-papafritas',
            'timetable' => '9am - 9pm',
            'contact' => '1234567890',
            'logo' => 'https://example.com/kangreburger.png',
            'tables' => "25"
        ]);
        $restaurant2 = Restaurant::factory()->create([
            'name' => 'Balde de Carnada',
            'address' => 'Fondo de Bikini (zona shady)',
            'owner_id' => $user->id,
            'menu' => 'https://example.com/menu-con-comida-fea',
            'timetable' => '9am - 10am',
            'contact' => '111222333',
            'logo' => 'https://example.com/logo-malvado.png',
            'tables' => "1"
        ]);


        Order::factory()->create([
        'restaurant' => $restaurant1->id,
        'table' => '4',
        'content' => 'Un café con leche y un rol de canela',
        'status' => 'Esperando',
        ]);
    }
}

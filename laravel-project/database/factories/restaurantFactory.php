<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Restaurant>
 */
class RestaurantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'contact' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'tables' => fake()->randomNumber(3) ,
            'timetable' => fake()->time(),
            'menu' => fake()->imageUrl(),
            'logo' => fake()->imageUrl(),
            'latitude' => '-34.6055491862155',
            'longitude'=>'-58.5634932603933'
        ];
    }
}

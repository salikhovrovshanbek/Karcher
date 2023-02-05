<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Karcher>
 */
class KarcherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'longitude'=>fake()->longitude(),
            'latitude'=>fake()->latitude(),
            'address'=>fake()->address(),
            'director'=>fake()->name(),
            'phone'=>fake()->phoneNumber(),
            'countPersons'=>fake()->randomDigit(),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(5),
            'image' => 'book.png',
            'price' => $this->faker->numberBetween('100', '1000'),
            'discription' => $this->faker->paragraph(4),
            'status' => $this->faker->randomElement(['Available','Out of stock'])
        ];
    }
}

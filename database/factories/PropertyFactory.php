<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(),
            'address' => $this->faker->address(),
            'fields' => json_encode([
                'area' => $this->faker->randomNumber(),
                'yearOfConstruction' => $this->faker->year(),
                'rooms' => $this->faker->numberBetween(1, 7),
                'heatingType' => $this->faker->word(),
                'parking' => $this->faker->boolean(),
                'price' => $this->faker->randomFloat(2, 100000)
            ])
        ];
    }
}

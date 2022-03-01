<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SearchProfile>
 */
class SearchProfileFactory extends Factory
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
            'search_fields' => json_encode([
                'area' => json_encode([
                    $this->faker->randomNumber(3, true),
                    null
                ]),
                'yearOfConstruction' => json_encode([
                    null,
                    date('Y') - $this->faker->randomDigit()
                ]),
                'rooms' => json_encode([
                    $this->faker->numberBetween(2, 7),
                    null
                ]),
                'heatingType' => $this->faker->word(),
                'parking' => $this->faker->boolean(),
                'price' => json_encode([
                    null,
                    $this->faker->randomFloat(2, 50000)
                ]),
                'tightSecurity' => $this->faker->boolean()
            ])
        ];
    }
}

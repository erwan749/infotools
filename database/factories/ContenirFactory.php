<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Contenir;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contenir>
 */
class ContenirFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'NoProd'=>$this->faker->numberBetween(103, 332),
            'NoFact'=>$this->faker->numberBetween(0, 100),
            'Qte'=>$this->faker->numberBetween(0, 5),
        ];
    }
}

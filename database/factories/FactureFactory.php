<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Facture;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Facture>
 */
class FactureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'DateFact' => $this->faker->date(),
            'NoClient'=>$this->faker->numberBetween(0, 100),
        ];
    }
}

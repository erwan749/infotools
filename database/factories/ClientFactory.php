<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Client;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'CPClient' => $this->faker->postcode(),
            'VilleClient'=>$this->faker->city(),
            'AdresseClient'=>$this->faker->unique()->streetAddress(),
            'NoProspects'=>$this->faker->numberBetween(0, 100),
        ];
    }
}

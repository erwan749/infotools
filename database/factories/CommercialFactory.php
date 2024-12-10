<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Commercial;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Commercial>
 */
class CommercialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cpCom' => $this->faker->postcode(),
            'villeCom'=>$this->faker->city(),
            'rueCom'=>$this->faker->unique()->streetAddress(),
            'telCom'=>$this->faker->phonenumber(),
            'idUser'=>$this->faker->numberBetween(1, 100),
        ];
    }
}

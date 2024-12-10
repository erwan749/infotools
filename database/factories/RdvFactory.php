<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Rdv;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rdv>
 */
class RdvFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'DateRdv' => $this->faker->date('Y_m_d_h_m'),
            'NoCom'=>$this->faker->numberBetween(0, 100),
            'NoClient'=>$this->faker->numberBetween(0, 100),
        ];
    }
}

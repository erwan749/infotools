<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Prospect>
 */
class ProspectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'NomProspects' =>$this->faker->lastname(),
            'PrenomProspects' => $this->faker->firstname(),
            'telProspects'=>$this->faker->phoneNumber(),
            'EmailProspects'=>$this->faker->unique()->safeEmail(),
            'mdpProspect'=>bcrypt($this->faker->password()),
        ];
    }
}

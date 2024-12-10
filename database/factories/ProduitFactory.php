<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Produit;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produit>
 */
class ProduitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'typeProd' => $this->faker->text(5),
            'prixProd' => $this->faker->numerify('###.##'),
            'nomProd' => $this->faker->text(5),
            'descProd' => $this->faker->text(50),


        ];
    }
}

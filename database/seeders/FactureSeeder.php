<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Facture;
class FactureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Facture::factory()->count(100)->create(); 
    }
}

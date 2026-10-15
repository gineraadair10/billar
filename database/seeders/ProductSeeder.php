<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $mesas = [
            [
                'name' => 'Mesa Odyssey Clásica',
                'price' => 24999.00,
                'description' => 'Mesa de madera sólida, ideal para uso en casa.',
            ],
            [
                'name' => 'Mesa Odyssey Profesional',
                'price' => 45999.00,
                'description' => 'Pizarra italiana y bandas de competencia para juego profesional.',
            ],
            [
                'name' => 'Mesa Odyssey Moderna',
                'price' => 32999.00,
                'description' => 'Diseño minimalista con patas de acero.',
            ],
            [
                'name' => 'Mesa Odyssey Convertible',
                'price' => 38999.00,
                'description' => 'Mesa de billar con cubierta para usarse también como comedor.',
            ],
        ];

        foreach ($mesas as $mesa) {
            Product::updateOrCreate(['name' => $mesa['name']], $mesa);
        }
    }
}
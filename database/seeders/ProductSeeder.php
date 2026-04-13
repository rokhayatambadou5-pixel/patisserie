<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['nom' => 'Gâteau au chocolat', 'category_id' => 1, 'prix' => 5000, 'stock' => 10],
            ['nom' => 'Gâteau à la vanille', 'category_id' => 1, 'prix' => 4500, 'stock' => 8],
            ['nom' => 'Tarte aux pommes',    'category_id' => 2, 'prix' => 3500, 'stock' => 6],
            ['nom' => 'Tarte au citron',     'category_id' => 2, 'prix' => 3800, 'stock' => 5],
            ['nom' => 'Croissant',           'category_id' => 3, 'prix' => 800,  'stock' => 20],
            ['nom' => 'Pain au chocolat',    'category_id' => 3, 'prix' => 900,  'stock' => 20],
            ['nom' => 'Cupcake fraise',      'category_id' => 4, 'prix' => 1200, 'stock' => 15],
        ];

        foreach ($products as $p) {
            Product::create([
                'nom'         => $p['nom'],
                'slug'        => Str::slug($p['nom']),
                'prix'        => $p['prix'],
                'stock'       => $p['stock'],
                'category_id' => $p['category_id'],
                'disponible'  => true,
            ]);
        }
    }
}
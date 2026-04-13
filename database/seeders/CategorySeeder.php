<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['nom' => 'Gâteaux', 'description' => 'Gâteaux en tout genre'],
            ['nom' => 'Tartes', 'description' => 'Tartes sucrées et salées'],
            ['nom' => 'Viennoiseries', 'description' => 'Croissants, pains au chocolat...'],
            ['nom' => 'Cupcakes', 'description' => 'Cupcakes variés'],
        ];

        foreach ($categories as $cat) {
            Category::create([
                'nom'         => $cat['nom'],
                'slug'        => Str::slug($cat['nom']),
                'description' => $cat['description'],
            ]);
        }
    }
}

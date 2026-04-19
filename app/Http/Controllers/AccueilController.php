<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

class AccueilController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')->get();
        $produits_vedettes = Product::where('disponible', true)
                                    ->latest()
                                    ->take(8)
                                    ->get();
        return view('accueil', compact('categories', 'produits_vedettes'));
    }
}
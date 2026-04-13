<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class BoutiqueController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = Product::where('disponible', true)->get();
        return view('boutique.index', compact('categories', 'products'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        return view('boutique.show', compact('product'));
    }

    public function categorie($slug)
    {
        $categorie = Category::where('slug', $slug)->firstOrFail();
        $products = $categorie->products()->where('disponible', true)->get();
        return view('boutique.categorie', compact('categorie', 'products'));
    }
}
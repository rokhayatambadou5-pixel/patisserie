<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProduitController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->get();
        return view('admin.produits.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.produits.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom'         => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'prix'        => 'required|integer|min:0',
            'stock'       => 'required|integer|min:0',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->nom);
        $data['disponible'] = $request->has('disponible');

       
        if ($request->hasFile('image')) {
    $file = $request->file('image');
    $filename = time() . '_' . $file->getClientOriginalName();
    $file->move(public_path('produits'), $filename);
    $data['image'] = 'produits/' . $filename;
}

        Product::create($data);
        return redirect()->route('admin.produits.index')->with('success', 'Produit créé !');
    }

    public function edit(Product $produit)
    {
        $categories = Category::all();
        return view('admin.produits.edit', compact('produit', 'categories'));
    }

    public function update(Request $request, Product $produit)
    {
        $request->validate([
            'nom'         => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'prix'        => 'required|integer|min:0',
            'stock'       => 'required|integer|min:0',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->nom);
        $data['disponible'] = $request->has('disponible');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('produits', 'public');
        }

        $produit->update($data);
        return redirect()->route('admin.produits.index')->with('success', 'Produit mis à jour !');
    }

    public function destroy(Product $produit)
    {
        $produit->delete();
        return redirect()->route('admin.produits.index')->with('success', 'Produit supprimé !');
    }
}
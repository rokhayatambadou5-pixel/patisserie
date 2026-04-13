<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class PanierController extends Controller
{
    public function index()
    {
        $panier = session()->get('panier', []);
        $total = array_sum(array_map(fn($item) => $item['prix'] * $item['quantite'], $panier));
        return view('panier.index', compact('panier', 'total'));
    }

    public function ajouter(Request $request, Product $product)
    {
        $panier = session()->get('panier', []);

        if (isset($panier[$product->id])) {
            $panier[$product->id]['quantite']++;
        } else {
            $panier[$product->id] = [
                'nom'      => $product->nom,
                'prix'     => $product->prix,
                'quantite' => 1,
                'image'    => $product->image,
            ];
        }

        session()->put('panier', $panier);
        return redirect()->back()->with('success', 'Produit ajouté au panier !');
    }

    public function modifier(Request $request, Product $product)
    {
        $panier = session()->get('panier', []);

        if (isset($panier[$product->id])) {
            $panier[$product->id]['quantite'] = $request->quantite;
            session()->put('panier', $panier);
        }

        return redirect()->route('panier.index');
    }

    public function supprimer(Product $product)
    {
        $panier = session()->get('panier', []);
        unset($panier[$product->id]);
        session()->put('panier', $panier);
        return redirect()->route('panier.index')->with('success', 'Produit retiré du panier !');
    }
}
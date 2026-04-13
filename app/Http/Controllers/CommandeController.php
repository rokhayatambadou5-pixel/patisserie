<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    public function index()
    {
        $commandes = auth()->user()->orders()->latest()->get();
        return view('commandes.index', compact('commandes'));
    }

    public function store(Request $request)
    {
        $panier = session()->get('panier', []);

        if (empty($panier)) {
            return redirect()->route('panier.index')->with('error', 'Votre panier est vide !');
        }

        $total = array_sum(array_map(fn($item) => $item['prix'] * $item['quantite'], $panier));

        $commande = Order::create([
            'user_id'           => auth()->id(),
            'total'             => $total,
            'statut'            => 'en_attente',
            'adresse_livraison' => $request->adresse_livraison,
            'notes'             => $request->notes,
        ]);

        foreach ($panier as $productId => $item) {
            OrderItem::create([
                'order_id'      => $commande->id,
                'product_id'    => $productId,
                'quantite'      => $item['quantite'],
                'prix_unitaire' => $item['prix'],
            ]);
        }

        session()->forget('panier');
        return redirect()->route('commandes.show', $commande)->with('success', 'Commande passée avec succès !');
    }

    public function show(Order $order)
    {
        return view('commandes.show', compact('order'));
    }
}
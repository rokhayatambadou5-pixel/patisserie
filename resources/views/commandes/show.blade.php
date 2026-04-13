@extends('layouts.patisserie')

@section('title', 'Commande #'.$order->id)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">📦 Commande #{{ $order->id }}</h2>
    <a href="{{ route('commandes.index') }}" class="btn btn-outline-secondary">
        ← Retour
    </a>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card mb-3">
            <div class="card-header fw-bold">Articles commandés</div>
            <div class="card-body">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Produit</th>
                            <th>Prix unitaire</th>
                            <th>Quantité</th>
                            <th>Sous-total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                            <tr>
                                <td>{{ $item->product->nom }}</td>
                                <td>{{ number_format($item->prix_unitaire, 0, ',', ' ') }} FCFA</td>
                                <td>{{ $item->quantite }}</td>
                                <td class="text-danger fw-bold">
                                    {{ number_format($item->prix_unitaire * $item->quantite, 0, ',', ' ') }} FCFA
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-end fw-bold">Total</td>
                            <td class="text-danger fw-bold">
                                {{ number_format($order->total, 0, ',', ' ') }} FCFA
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card mb-3">
            <div class="card-header fw-bold">Informations</div>
            <div class="card-body">
                <p class="mb-2">
                    <strong>Statut :</strong>
                    <span class="badge bg-warning">{{ ucfirst($order->statut) }}</span>
                </p>
                <p class="mb-2">
                    <strong>Date :</strong>
                    {{ $order->created_at->format('d/m/Y à H:i') }}
                </p>
                <p class="mb-2">
                    <strong>Adresse :</strong><br>
                    {{ $order->adresse_livraison ?? 'Non renseignée' }}
                </p>
                @if($order->notes)
                    <p class="mb-0">
                        <strong>Notes :</strong><br>
                        {{ $order->notes }}
                    </p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
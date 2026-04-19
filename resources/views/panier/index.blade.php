@extends('layouts.patisserie')

@section('title', 'Mon Panier')

@section('content')
<h2 class="fw-bold mb-4">🛒 Mon Panier</h2>

@if(empty($panier))
    <div class="text-center py-5">
        <p style="font-size:4rem">🛒</p>
        <h5 class="text-muted">Votre panier est vide</h5>
        <a href="{{ route('boutique.index') }}" class="btn btn-primary mt-3">
            Voir la boutique
        </a>
    </div>
@else
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>Produit</th>
                                <th>Prix unitaire</th>
                                <th>Quantité</th>
                                <th>Sous-total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($panier as $id => $item)
                                <tr>
                                    <td class="fw-bold">{{ $item['nom'] }}</td>
                                    <td>{{ number_format($item['prix'], 0, ',', ' ') }} FCFA</td>
                                    <td>
                                        <form action="{{ route('panier.modifier', $id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <div class="input-group" style="width:100px">
                                                <input type="number"
                                                       name="quantite"
                                                       value="{{ $item['quantite'] }}"
                                                       min="1"
                                                       class="form-control form-control-sm"
                                                       onchange="this.form.submit()">
                                            </div>
                                        </form>
                                    </td>
                                    <td class="text-danger fw-bold">
                                        {{ number_format($item['prix'] * $item['quantite'], 0, ',', ' ') }} FCFA
                                    </td>
                                    <td>
                                        <form action="{{ route('panier.supprimer', $id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger">🗑</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">Récapitulatif</h5>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Sous-total</span>
                        <span>{{ number_format($total, 0, ',', ' ') }} FCFA</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between fw-bold mb-4">
                        <span>Total</span>
                        <span class="text-danger">{{ number_format($total, 0, ',', ' ') }} FCFA</span>
                    </div>

                    @auth
                        <button class="btn btn-primary w-100"
                                data-bs-toggle="modal"
                                data-bs-target="#modalCommande">
                            ✅ Passer la commande
                        </button>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary w-100">
                            🔒 Connectez-vous pour commander
                        </a>
                    @endauth

                    <a href="{{ route('boutique.index') }}"
                       class="btn btn-outline-secondary w-100 mt-2">
                        ← Continuer mes achats
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal commande --}}
    @auth
    <div class="modal fade" id="modalCommande" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Finaliser la commande</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('commandes.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Adresse de livraison</label>
                            <textarea name="adresse_livraison"
                                      class="form-control"
                                      rows="3"
                                      required
                                      placeholder="Votre adresse complète..."></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Notes (optionnel)</label>
                            <textarea name="notes"
                                      class="form-control"
                                      rows="2"
                                      placeholder="Instructions spéciales..."></textarea>
                        </div>
                        <div class="alert alert-info">
                            <strong>Total à payer :</strong>
                            {{ number_format($total, 0, ',', ' ') }} FCFA
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button"
                                class="btn btn-outline-secondary"
                                data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">
                            ✅ Confirmer la commande
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endauth
@endif
@endsection
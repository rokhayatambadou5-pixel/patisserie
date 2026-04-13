@extends('layouts.patisserie')

@section('title', 'Admin — Produits')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">🛠 Gestion des produits</h2>
    <a href="{{ route('admin.produits.create') }}" class="btn btn-primary">
        + Nouveau produit
    </a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Catégorie</th>
                    <th>Prix</th>
                    <th>Stock</th>
                    <th>Disponible</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr>
                        <td class="fw-bold">{{ $product->nom }}</td>
                        <td>
                            <span class="badge bg-secondary">
                                {{ $product->category->nom }}
                            </span>
                        </td>
                        <td>{{ number_format($product->prix, 0, ',', ' ') }} FCFA</td>
                        <td>
                            <span class="badge bg-{{ $product->stock > 5 ? 'success' : 'danger' }}">
                                {{ $product->stock }}
                            </span>
                        </td>
                        <td>
                            @if($product->disponible)
                                <span class="badge bg-success">Oui</span>
                            @else
                                <span class="badge bg-danger">Non</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.produits.edit', $product) }}"
                               class="btn btn-sm btn-outline-primary">✏️ Modifier</a>
                            <form action="{{ route('admin.produits.destroy', $product) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Supprimer ce produit ?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">🗑 Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Aucun produit.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
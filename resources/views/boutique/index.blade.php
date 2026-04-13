@extends('layouts.patisserie')

@section('title', 'Boutique — Goûts & Partages')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold">🍰 Notre Boutique</h2>
        <p class="text-muted">Découvrez nos délicieuses pâtisseries</p>
    </div>
</div>

{{-- Filtres catégories --}}
<div class="row mb-4">
    <div class="col-12">
        <a href="{{ route('boutique.index') }}" class="btn btn-sm btn-outline-danger me-2">Tous</a>
        @foreach($categories as $categorie)
            <a href="{{ route('boutique.categorie', $categorie->slug) }}"
               class="btn btn-sm btn-outline-secondary me-2">
                {{ $categorie->nom }}
            </a>
        @endforeach
    </div>
</div>

{{-- Grille produits --}}
<div class="row g-4">
    @forelse($products as $product)
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card h-100">
                @if($product->image)
                    <img src="{{ asset('storage/'.$product->image) }}"
                         class="card-img-top"
                         style="height:180px; object-fit:cover"
                         alt="{{ $product->nom }}">
                @else
                    <div class="bg-light d-flex align-items-center justify-content-center"
                         style="height:180px; font-size:3rem">
                        🍰
                    </div>
                @endif
                <div class="card-body d-flex flex-column">
                    <span class="badge bg-secondary mb-2" style="width:fit-content">
                        {{ $product->category->nom }}
                    </span>
                    <h6 class="card-title fw-bold">{{ $product->nom }}</h6>
                    <p class="text-danger fw-bold mt-auto mb-2">
                        {{ number_format($product->prix, 0, ',', ' ') }} FCFA
                    </p>
                    @if($product->stock > 0)
                        <form action="{{ route('panier.ajouter', $product) }}" method="POST">
                            @csrf
                            <button class="btn btn-primary btn-sm w-100">
                                🛒 Ajouter au panier
                            </button>
                        </form>
                    @else
                        <button class="btn btn-secondary btn-sm w-100" disabled>
                            Rupture de stock
                        </button>
                    @endif
                </div>
                <div class="card-footer">
                    <a href="{{ route('boutique.show', $product->slug) }}"
                       class="text-muted small">Voir les détails →</a>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <p class="text-muted">Aucun produit disponible pour le moment.</p>
        </div>
    @endforelse
</div>
@endsection
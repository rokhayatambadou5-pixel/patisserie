@extends('layouts.patisserie')

@section('title', 'Goûts & Partages — Pâtisserie Artisanale')

@section('content')


<div class="hero-section text-white rounded-4 mb-5 p-5 d-flex align-items-center"
     style="background: linear-gradient(135deg, #c0392b 0%, #922b21 100%); min-height: 480px;">
    <div class="row w-100 align-items-center">
        <div class="col-md-6">
            <p class="mb-2" style="color:#f9c9c5; font-style:italic; font-size:1.1rem">
                Bienvenue chez Goûts & Partages
            </p>
            <h1 class="display-3 fw-bold mb-3">
                Des pâtisseries<br>faites avec ❤️
            </h1>
            <p class="mb-4 opacity-75 fs-5">
                Découvrez nos gâteaux, tartes et viennoiseries artisanales,
                préparés chaque jour avec des ingrédients frais.
            </p>
            <div class="d-flex gap-3 flex-wrap">
                <a href="{{ route('boutique.index') }}" class="btn btn-warning btn-lg fw-bold px-4">
                    🛍️ Voir la boutique
                </a>
                <a href="#categories" class="btn btn-outline-light btn-lg px-4">
                    Nos catégories ↓
                </a>
            </div>
        </div>
        <div class="col-md-6 text-center d-none d-md-block">
            <!-- <img src="/storage/produits/gateau.png"  -->
            <img src="produits/gateau.png"
     alt="Gâteau" 
     style="width: 350px; max-width:100%; filter:drop-shadow(0 10px 20px rgba(0,0,0,0.4));">
        </div>
    </div>
</div>

{{-- ===== AVANTAGES ===== --}}
<div class="row g-4 mb-5">
    @foreach([
        ['🌿', 'Produits frais', 'Préparés chaque matin avec des ingrédients de qualité'],
        ['⭐', 'Qualité garantie', 'Recettes artisanales transmises de génération en génération'],
        ['🚀', 'Livraison rapide', 'Livraison à domicile rapide et soignée'],
        ['🔒', 'Paiement sécurisé', 'Vos transactions sont protégées et sécurisées'],
    ] as $avantage)
        <div class="col-sm-6 col-lg-3">
            <div class="card h-100 text-center p-4">
                <div style="font-size:2.5rem" class="mb-2">{{ $avantage[0] }}</div>
                <h6 class="fw-bold text-danger">{{ $avantage[1] }}</h6>
                <p class="text-muted small mb-0">{{ $avantage[2] }}</p>
            </div>
        </div>
    @endforeach
</div>

{{-- ===== CATÉGORIES ===== --}}
<div id="categories" class="text-center mb-4">
    <p style="color:#c0392b; font-style:italic">Explorer nos spécialités</p>
    <h2 class="fw-bold">Nos Catégories</h2>
</div>
<div class="row g-3 mb-5">
    @foreach($categories as $categorie)
        <div class="col-6 col-md-3">
            <a href="{{ route('boutique.categorie', $categorie->slug) }}" class="text-decoration-none">
                <div class="card text-center p-4 h-100 category-card">
                    <div style="font-size:2.5rem" class="mb-2">🍰</div>
                    <h6 class="fw-bold text-danger mb-1">{{ $categorie->nom }}</h6>
                    <small class="text-muted">
                        {{ $categorie->products_count }} produits
                    </small>
                </div>
            </a>
        </div>
    @endforeach
</div>

{{-- ===== STATS ===== --}}
<div class="rounded-4 text-white text-center py-5 mb-5"
     style="background: linear-gradient(135deg, #922b21, #c0392b)">
    <div class="row g-4">
        @foreach([
            ['🎂', '50+', 'Produits disponibles'],
            ['😊', '500+', 'Clients satisfaits'],
            ['🚚', '10+', 'Livraisons par jour'],
            ['🏆', '5+', 'Années d\'expérience'],
        ] as $stat)
            <div class="col-6 col-md-3">
                <div style="font-size:2rem">{{ $stat[0] }}</div>
                <h3 class="fw-bold mb-0">{{ $stat[1] }}</h3>
                <small class="opacity-75">{{ $stat[2] }}</small>
            </div>
        @endforeach
    </div>
</div>

{{-- ===== PRODUITS VEDETTES ===== --}}
<div class="text-center mb-4">
    <p style="color:#c0392b; font-style:italic">Frais du four</p>
    <h2 class="fw-bold">Nos Produits Vedettes</h2>
</div>
<div class="row g-4 mb-4">
    @foreach($produits_vedettes as $product)
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card h-100 product-card">
                <div class="position-relative">
                    @if($product->image)
                        <!-- <img src="{{ asset('storage/'.$product->image) }}" -->
                         <img src="{{ asset($product->image) }}"
                             class="card-img-top"
                             style="height:200px; object-fit:cover"
                             alt="{{ $product->nom }}">
                    @else
                        <div class="d-flex align-items-center justify-content-center bg-light"
                             style="height:200px; font-size:4rem">🍰</div>
                    @endif
                </div>
                <div class="card-body d-flex flex-column">
                    <span class="badge bg-light text-danger border border-danger mb-2"
                          style="width:fit-content">
                        {{ $product->category->nom }}
                    </span>
                    <h6 class="fw-bold">{{ $product->nom }}</h6>
                    <div class="d-flex justify-content-between align-items-center mt-auto">
                        <span class="text-danger fw-bold fs-5">
                            {{ number_format($product->prix, 0, ',', ' ') }} FCFA
                        </span>
                        <a href="{{ route('boutique.show', $product->slug) }}"
                           class="text-muted small">Détails →</a>
                    </div>
                </div>
                <div class="card-footer bg-white border-0 pb-3">
                    <form action="{{ route('panier.ajouter', $product) }}" method="POST">
                        @csrf
                        <button class="btn btn-danger btn-sm w-100">
                            🛒 Ajouter au panier
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>

{{-- Bouton voir tout --}}
<div class="text-center mb-5">
    <a href="{{ route('boutique.index') }}" class="btn btn-outline-danger btn-lg px-5">
        Voir tous nos produits →
    </a>
</div>

{{-- ===== BANNIÈRE PROMO ===== --}}
<div class="rounded-4 p-5 mb-5 text-white text-center"
     style="background: linear-gradient(135deg, #1a1a2e, #c0392b)">
    <p style="color:#f9c9c5; font-style:italic">Offre spéciale</p>
    <h2 class="fw-bold display-5">Commandez dès maintenant !</h2>
    <p class="opacity-75 mb-4 fs-5">
        Profitez de nos pâtisseries fraîches livrées directement chez vous.
    </p>
    <a href="{{ route('boutique.index') }}" class="btn btn-warning btn-lg fw-bold px-5">
        Voir nos produits →
    </a>
</div>

{{-- ===== SERVICES ===== --}}
<div class="row g-4 mb-4">
    @foreach([
        ['🚚', 'Livraison à domicile', 'Livraison rapide et soignée partout en ville.'],
        ['🎁', 'Programme fidélité', 'Gagnez des points à chaque commande.'],
        ['📞', 'Support client', 'Une question ? On est là pour vous aider.'],
    ] as $service)
        <div class="col-md-4">
            <div class="card p-4 h-100 text-center">
                <div style="font-size:2rem" class="mb-2">{{ $service[0] }}</div>
                <h6 class="fw-bold">{{ $service[1] }}</h6>
                <p class="text-muted small mb-0">{{ $service[2] }}</p>
            </div>
        </div>
    @endforeach
</div>

@endsection

@push('styles')
<style>
    .category-card {
        transition: transform 0.2s, box-shadow 0.2s;
        border: 2px solid transparent;
    }
    .category-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(192,57,43,0.15) !important;
        border-color: #c0392b;
    }
    .product-card {
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.12) !important;
    }
</style>
@endpush
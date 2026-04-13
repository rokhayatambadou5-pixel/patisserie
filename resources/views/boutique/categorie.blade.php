@extends('layouts.patisserie')

@section('title', $categorie->nom)

@section('content')
<h2 class="fw-bold mb-1">{{ $categorie->nom }}</h2>
<p class="text-muted mb-4">{{ $categorie->description }}</p>

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
                    <h6 class="card-title fw-bold">{{ $product->nom }}</h6>
                    <p class="text-danger fw-bold mt-auto mb-2">
                        {{ number_format($product->prix, 0, ',', ' ') }} FCFA
                    </p>
                    <form action="{{ route('panier.ajouter', $product) }}" method="POST">
                        @csrf
                        <button class="btn btn-primary btn-sm w-100">
                            🛒 Ajouter au panier
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <p class="text-muted">Aucun produit dans cette catégorie.</p>
        </div>
    @endforelse
</div>
@endsection
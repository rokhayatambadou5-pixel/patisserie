@extends('layouts.patisserie')

@section('title', $product->nom)

@section('content')
<div class="row">
    <div class="col-md-5">
        @if($product->image)
            <!-- <img src="{{ asset('storage/'.$product->image) }}" -->
             <img src="{{ asset($product->image) }}"
                 class="img-fluid rounded shadow"
                 alt="{{ $product->nom }}">
        @else
            <div class="bg-light rounded d-flex align-items-center justify-content-center"
                 style="height:300px; font-size:5rem">
                🍰
            </div>
        @endif
    </div>
    <div class="col-md-7">
        <span class="badge bg-secondary mb-2">{{ $product->category->nom }}</span>
        <h2 class="fw-bold">{{ $product->nom }}</h2>
        <p class="text-muted">{{ $product->description ?? 'Aucune description disponible.' }}</p>
        <h3 class="text-danger fw-bold my-3">
            {{ number_format($product->prix, 0, ',', ' ') }} FCFA
        </h3>
        <p class="text-muted small">
            @if($product->stock > 0)
                <span class="text-success">✅ En stock ({{ $product->stock }} disponibles)</span>
            @else
                <span class="text-danger">❌ Rupture de stock</span>
            @endif
        </p>
        @if($product->stock > 0)
            <form action="{{ route('panier.ajouter', $product) }}" method="POST">
                @csrf
                <button class="btn btn-primary btn-lg">
                    🛒 Ajouter au panier
                </button>
            </form>
        @endif
        <a href="{{ route('boutique.index') }}" class="btn btn-outline-secondary mt-3">
            ← Retour à la boutique
        </a>
    </div>
</div>
@endsection
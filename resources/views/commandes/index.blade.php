@extends('layouts.patisserie')

@section('title', 'Mes Commandes')

@section('content')
<h2 class="fw-bold mb-4">📦 Mes Commandes</h2>

@forelse($commandes as $commande)
    <div class="card mb-3">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <h6 class="fw-bold mb-1">Commande #{{ $commande->id }}</h6>
                <small class="text-muted">
                    {{ $commande->created_at->format('d/m/Y à H:i') }}
                </small>
            </div>
            <div class="text-center">
                @php
                    $badges = [
                        'en_attente' => 'warning',
                        'confirmée'  => 'info',
                        'prête'      => 'primary',
                        'livrée'     => 'success',
                        'annulée'    => 'danger',
                    ];
                @endphp
                <span class="badge bg-{{ $badges[$commande->statut] ?? 'secondary' }}">
                    {{ ucfirst($commande->statut) }}
                </span>
            </div>
            <div class="text-danger fw-bold">
                {{ number_format($commande->total, 0, ',', ' ') }} FCFA
            </div>
            <a href="{{ route('commandes.show', $commande) }}"
               class="btn btn-sm btn-outline-primary">
                Voir détails →
            </a>
        </div>
    </div>
@empty
    <div class="text-center py-5">
        <p style="font-size:4rem">📦</p>
        <h5 class="text-muted">Vous n'avez pas encore de commande</h5>
        <a href="{{ route('boutique.index') }}" class="btn btn-primary mt-3">
            Faire mes achats
        </a>
    </div>
@endforelse
@endsection
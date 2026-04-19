@extends('layouts.patisserie')

@section('title', 'Modifier — '.$produit->nom)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">✏️ Modifier : {{ $produit->nom }}</h2>
    <a href="{{ route('admin.produits.index') }}" class="btn btn-outline-secondary">← Retour</a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.produits.update', $produit) }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Nom du produit</label>
                    <input type="text"
                           name="nom"
                           class="form-control @error('nom') is-invalid @enderror"
                           value="{{ old('nom', $produit->nom) }}"
                           required>
                    @error('nom')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">Catégorie</label>
                    <select name="category_id"
                            class="form-select @error('category_id') is-invalid @enderror"
                            required>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}"
                                {{ $produit->category_id == $cat->id ? 'selected' : '' }}>
                                {{ $cat->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-bold">Prix (FCFA)</label>
                    <input type="number"
                           name="prix"
                           class="form-control @error('prix') is-invalid @enderror"
                           value="{{ old('prix', $produit->prix) }}"
                           min="0"
                           required>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-bold">Stock</label>
                    <input type="number"
                           name="stock"
                           class="form-control @error('stock') is-invalid @enderror"
                           value="{{ old('stock', $produit->stock) }}"
                           min="0"
                           required>
                </div>

                <div class="col-md-4 d-flex align-items-end">
                    <div class="form-check mb-2">
                        <input type="checkbox"
                               name="disponible"
                               class="form-check-input"
                               id="disponible"
                               {{ $produit->disponible ? 'checked' : '' }}>
                        <label class="form-check-label fw-bold" for="disponible">
                            Disponible à la vente
                        </label>
                    </div>
                </div>

                <div class="col-md-12">
                    <label class="form-label fw-bold">Description</label>
                    <textarea name="description"
                              class="form-control"
                              rows="3">{{ old('description', $produit->description) }}</textarea>
                </div>

                <div class="col-md-12">
                    <label class="form-label fw-bold">Image du produit</label>
                    @if($produit->image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/'.$produit->image) }}"
                                 style="height:80px; object-fit:cover"
                                 class="rounded">
                            <small class="text-muted ms-2">Image actuelle</small>
                        </div>
                    @endif
                    <input type="file"
                           name="image"
                           class="form-control"
                           accept="image/*">
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary px-4">
                        💾 Mettre à jour
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
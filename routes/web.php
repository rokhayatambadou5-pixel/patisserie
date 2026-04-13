<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BoutiqueController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\Admin\ProduitController;
use App\Http\Controllers\Admin\CategorieController;
use App\Http\Controllers\Admin\CommandeController as AdminCommandeController;
use Illuminate\Support\Facades\Route;

// ===== BOUTIQUE PUBLIQUE =====
Route::get('/', [BoutiqueController::class, 'index'])->name('boutique.index');
Route::get('/produit/{slug}', [BoutiqueController::class, 'show'])->name('boutique.show');
Route::get('/categorie/{slug}', [BoutiqueController::class, 'categorie'])->name('boutique.categorie');

// ===== PANIER =====
Route::get('/panier', [PanierController::class, 'index'])->name('panier.index');
Route::post('/panier/ajouter/{product}', [PanierController::class, 'ajouter'])->name('panier.ajouter');
Route::patch('/panier/modifier/{product}', [PanierController::class, 'modifier'])->name('panier.modifier');
Route::delete('/panier/supprimer/{product}', [PanierController::class, 'supprimer'])->name('panier.supprimer');

// ===== COMMANDES (clients connectés) =====
Route::middleware(['auth'])->group(function () {
    Route::get('/commandes', [CommandeController::class, 'index'])->name('commandes.index');
    Route::post('/commandes', [CommandeController::class, 'store'])->name('commandes.store');
    Route::get('/commandes/{order}', [CommandeController::class, 'show'])->name('commandes.show');
});

// ===== ADMIN =====
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('produits', ProduitController::class);
    Route::resource('categories', CategorieController::class);
    Route::resource('commandes', AdminCommandeController::class);
});

// ===== PROFIL (Breeze) =====
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ===== AUTH =====
require __DIR__.'/auth.php';
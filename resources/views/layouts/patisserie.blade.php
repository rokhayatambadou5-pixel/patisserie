<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Goûts & Partages')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background-color: #fdf6f0; }
        .navbar { background-color: #c0392b !important; }
        .navbar-brand, .nav-link { color: white !important; }
        .btn-primary { background-color: #c0392b; border-color: #c0392b; }
        .btn-primary:hover { background-color: #a93226; border-color: #a93226; }
        .card { border: none; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
    <div class="container">
        <li class="nav-item">
    <a class="nav-link" href="{{ route('accueil') }}">Accueil</a>
</li>
        <a class="navbar-brand fw-bold" href="{{ route('boutique.index') }}">
            🍰 Goûts & Partages
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="nav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('boutique.index') }}">Boutique</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item me-3">
                    <a class="nav-link" href="{{ route('panier.index') }}">
                        🛒 Panier
                        @php $panier = session()->get('panier', []); @endphp
                        @if(count($panier) > 0)
                            <span class="badge bg-warning text-dark">{{ count($panier) }}</span>
                        @endif
                    </a>
                </li>
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('commandes.index') }}">Mes commandes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.produits.index') }}">Admin</a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-light ms-2">
                                Déconnexion
                            </button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Connexion</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-sm btn-warning ms-2" href="{{ route('register') }}">
                            Inscription
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<div class="container my-4">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @yield('content')
</div>

<footer class="text-center py-4 mt-5 text-muted border-top">
    <small>© {{ date('Y') }} Goûts & Partages — Tous droits réservés</small>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
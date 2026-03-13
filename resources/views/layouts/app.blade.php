<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'JT Art - Créations fait main')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body>
    <nav class="navbar">
        <div class="nav-brand">
            <a href="{{ route('home') }}">
                <i class="bi bi-palette"></i> JT Art
            </a>
        </div>

        <div class="nav-links">
            <a href="{{ route('home') }}">
                <i class="bi bi-house"></i> Accueil
            </a>
            <a href="{{ route('products.index') }}">
                <i class="bi bi-grid"></i> Produits
            </a>
            @auth
                <a href="{{ route('cart.index') }}">
                    <i class="bi bi-cart3"></i> Panier
                </a>
            @endauth
        </div>

        <div class="nav-auth">
            @auth
                @role('admin')
                    <a href="{{ route('products.create') }}" class="nav-btn nav-btn-create">
                        <i class="bi bi-plus-circle"></i> Créer
                    </a>
                @endrole
                <span class="user-badge">
                    <i class="bi bi-person-circle"></i>
                    {{ Auth::user()->name }}
                    @role('admin')
                        <span class="role-badge">Admin</span>
                    @endrole
                </span>
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="nav-btn nav-btn-logout">
                        <i class="bi bi-box-arrow-right"></i> Déconnexion
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="nav-btn">
                    <i class="bi bi-box-arrow-in-right"></i> Connexion
                </a>
                <a href="{{ route('register') }}" class="nav-btn nav-btn-register">
                    <i class="bi bi-person-plus"></i> Inscription
                </a>
            @endauth
        </div>
    </nav>

    <main class="main-content">
        @if(session('success'))
            <div class="alert alert-success">
                <i class="bi bi-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                <i class="bi bi-exclamation-circle"></i> {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-brand">
                <i class="bi bi-palette"></i> JT Art
                <p>Créations artisanales en point de croix</p>
            </div>
            <div class="footer-links">
                <a href="#">Mentions légales</a>
                @role('admin')
                <a href="http://glpi.local/front/ticket.form.php">GLPI</a>
                <a href="/phpmyadmin" target="_blank">phpMyAdmin</a>
                <a href="docs/index.html">Documentation</a>
                @endrole
            </div>
            <div class="footer-social">
                <a href="#"><i class="bi bi-instagram"></i></a>
                <a href="#"><i class="bi bi-facebook"></i></a>
                <a href="#"><i class="bi bi-pinterest"></i></a>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} JT Art - Tous droits réservés</p>
        </div>
    </footer>
</body>
</html>

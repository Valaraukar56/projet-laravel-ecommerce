<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'JT Art')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

    {{-- NAV COMMUNE --}}
    <nav class="navbar">
         <a href="{{ route('home') }}">Accueil</a>
        <a href="{{ route('cart.index') }}">🛒 Panier</a>
        
        @auth
            {{-- Affiché seulement si connecté --}}
            <span style="color:lime">Connecté : {{ Auth::user()->getRoleNames()->first() ?? 'Utilisateur' }}</span>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="deconnection">Déconnexion</button>
            </form>
        @endauth
        
        @guest
            {{-- Affiché seulement si NON connecté --}}
            <a href="{{ route('login') }}">Connexion</a>
            <span style="color:orange">Pas connecté</span>
        @endguest
        
        <a href="docs/index.html">Documentation</a>
    </nav>

    {{-- CONTENU DE CHAQUE PAGE --}}
    <main>
        @yield('content')
    </main>

    {{-- FOOTER COMMUN --}}
    <footer class="footer">
        Mentions légales | Contact | Réseaux sociaux
    </footer>

</body>
</html>

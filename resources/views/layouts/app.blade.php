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
        <a href="{{ route('login') }}">Connexion</a>
        @auth
            <span style="color:lime">Connecté : {{ Auth::user()->getRoleNames()->first() ?? 'Utilisateur' }}</span>
        @endauth

        @guest
            <span style="color:orange">Pas connecté</span>
        @endguest
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="deconnection">Déconnexion</button>
        </form>

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

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@yield('title','JT Art')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

{{-- NAVBAR COMMUNE --}}
<nav>
    <h1>JTArt</h1>
    <a href="{{ route('home') }}">Accueil</a>
    <a href="{{ route('cart.index') }}">🛒 Panier</a>
    <a href="{{ route('login') }}">Connexion</a>
</nav>

{{-- CONTENU SPÉCIFIQUE A CHAQUE PAGE --}}
@yield('content')

{{-- FOOTER COMMUN --}}
<footer>
    Mentions légales | Contact | Réseaux sociaux
</footer>

</body>
</html>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion — JT Art</title>
    <style>
        body { margin:0; font-family:sans-serif; background:#2b0000; color:white; }
        nav { background:#ff5b5b; padding:15px; display:flex; gap:30px; align-items:center; }
        nav a { color:white; text-decoration:none; font-weight:bold; }
        .login-box { width:350px; margin:80px auto; background:#660000; padding:30px; border-radius:6px; }
        input { width:100%; padding:10px; margin:10px 0; border:none; border-radius:4px; }
        button { width:100%; padding:10px; background:white; color:#660000; border:none; font-weight:bold; border-radius:4px; }
        footer { background:#eee; color:#222; text-align:center; padding:15px; margin-top:80px; }
    </style>
</head>
<body>

<nav>
    <a href="{{ route('home') }}">Accueil</a>
    <a href="{{ route('cart.index') }}">🛒 Panier</a>
    <a href="#">Connexion</a>
</nav>

<div class="login-box">
    <h2>Connexion</h2>
    <form>
        <input type="email" placeholder="Email">
        <input type="password" placeholder="Mot de passe">
        <button type="submit">Se connecter</button>
    </form>
    <p style="text-align:center;margin-top:10px;">Pas encore inscrit ? <a href="#" style="color:#ffaaaa;">Créer un compte</a></p>
</div>

<footer>
    Mentions légales | Contact | Réseaux sociaux
</footer>

</body>
</html>

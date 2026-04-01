# Projet Laravel E-commerce — Guide d'installation

Application web e-commerce développée avec **Laravel 12**.

---

## Prérequis

Avant de commencer, assurez-vous d'avoir installé :

- **PHP 8.2** ou supérieur
- **Composer**
- **Node.js** et **npm**
- **MySQL** (ou MariaDB)
- **XAMPP** (ou tout autre serveur Apache/MySQL local)

---

## Installation

### 1. Cloner le dépôt

```bash
git clone https://github.com/Valaraukar56/projet-laravel-ecommerce.git
cd projet-laravel-ecommerce
```

> Si vous utilisez XAMPP, placez le projet dans `C:\xampp\htdocs\`.

---

### 2. Installer les dépendances PHP

```bash
composer install
```

---

### 3. Configurer l'environnement

Copiez le fichier d'exemple `.env` :

```bash
cp .env.example .env
```

Puis générez la clé d'application :

```bash
php artisan key:generate
```

---

### 4. Configurer la base de données

Modifiez le fichier `.env` avec vos paramètres MySQL :

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ecommerce
DB_USERNAME=root
DB_PASSWORD=
```

> Créez la base de données `ecommerce` dans phpMyAdmin ou en ligne de commande avant de continuer.

---

### 5. Créer les tables et insérer les données

```bash
php artisan migrate --seed
```

Cette commande crée toutes les tables et insère les données de démonstration (produits, compte administrateur).

---

### 6. Installer les dépendances front-end et compiler les assets

```bash
npm install
npm run build
```

---

### 7. Lancer le serveur

```bash
php artisan serve
```

L'application est accessible à l'adresse : http://localhost:8000

> Avec XAMPP, vous pouvez également accéder au projet via : http://localhost/projet-laravel-ecommerce/public

---

## Compte administrateur

Un compte admin est créé automatiquement lors du seeding :

| Champ        | Valeur            |
|--------------|-------------------|
| Email        | `admin@admin.fr`  |
| Mot de passe | `admin123`        |

Le compte admin permet de **créer, modifier et supprimer** des produits depuis l'interface.

---

## Fonctionnalités

- Parcourir le catalogue de produits
- Consulter la fiche détaillée d'un produit
- Créer un compte utilisateur / se connecter
- Ajouter des produits au panier et gérer les quantités
- Interface d'administration pour gérer le catalogue (réservée au rôle admin)

---

## Technologies utilisées

- **Laravel 12** — Framework PHP
- **MySQL** — Base de données
- **Spatie Laravel Permission** — Gestion des rôles et permissions
- **Vite** — Bundler front-end
- **Bootstrap** — Framework CSS (via Laravel UI)

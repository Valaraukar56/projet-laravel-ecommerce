@extends('layouts.app')
@section('title', 'Panier — JT Art')
@section('content')

<div class="cart">
    <h2>Votre panier</h2>
    
    <div class="item">
        <img src="/path/to/image.jpg" alt="Produit">
        <div class="product-name">Nom du produit</div>
        <div class="price">25,00 €</div>
        <div class="quantity">
            <button>-</button>
            <span>2</span>
            <button>+</button>
        </div>
        <button class="remove">Supprimer</button>
    </div>
    
    <div class="item">
        <img src="/path/to/image.jpg" alt="Produit">
        <div class="product-name">Autre produit</div>
        <div class="price">30,00 €</div>
        <div class="quantity">
            <button>-</button>
            <span>1</span>
            <button>+</button>
        </div>
        <button class="remove">Supprimer</button>
    </div>
    
    <h3>Total : 80,00 €</h3>
    <button>Procéder au paiement</button>
</div>

@endsection
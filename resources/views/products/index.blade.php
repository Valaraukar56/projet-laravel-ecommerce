@extends('layouts.app')
@section('title', 'Produits — JT Art')
@section('content')
<header class="banner">
    @role('admin')
    <a href="{{ route('products.create') }}" class="btn">Créer un produit</a>
    @endrole
    <p>Des créations faites main en point de croix</p>
</header>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<main class="products">
    @foreach($products as $product)
        <div class="product">
            @if($product->image)
                <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">
            @endif
            <h1>{{ $product->name }}</h1>
            <p><strong>{{ number_format($product->price, 2, ',', ' ') }} €</strong></p>
            <a href="{{ route('products.show', $product) }}" class="btn">Voir</a>
            
            @auth
                <form action="{{ route('cart.store', $product) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn">Ajouter au panier</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn">Se connecter pour acheter</a>
            @endauth

            @role('admin')
                <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Supprimer ce produit ?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
            @endrole
        </div>
    @endforeach
</main>
@endsection
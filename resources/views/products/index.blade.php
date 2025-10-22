@extends('layouts.app')

@section('title', 'Produits — JT Art')

@section('content')
<header class="banner">
    <p>Des créations faites main en point de croix</p>
</header>

<main class="products">
    @foreach($products as $product)
        <div class="product">
            @if($product->image)
                <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">
            @endif

            <h3>{{ $product->name }}</h3>
            <p><strong>{{ number_format($product->price, 2, ',', ' ') }} €</strong></p>
            <a href="{{ route('products.show', $product) }}" class="btn">Voir</a>
            <a href="#" class="btn">Ajouter au panier</a>
        </div>
                <div class="product">
            @if($product->image)
                <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">
            @endif

            <h3>{{ $product->name }}</h3>
            <p><strong>{{ number_format($product->price, 2, ',', ' ') }} €</strong></p>
            <a href="{{ route('products.show', $product) }}" class="btn">Voir</a>
            <a href="#" class="btn">Ajouter au panier</a>
        </div>
                </div>
                <div class="product">
            @if($product->image)
                <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">
            @endif

            <h3>{{ $product->name }}</h3>
            <p><strong>{{ number_format($product->price, 2, ',', ' ') }} €</strong></p>
            <a href="{{ route('products.show', $product) }}" class="btn">Voir</a>
            <a href="#" class="btn">Ajouter au panier</a>
        </div>
                </div>
                <div class="product">
            @if($product->image)
                <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">
            @endif

            <h3>{{ $product->name }}</h3>
            <p><strong>{{ number_format($product->price, 2, ',', ' ') }} €</strong></p>
            <a href="{{ route('products.show', $product) }}" class="btn">Voir</a>
            <a href="#" class="btn">Ajouter au panier</a>
        </div>
    @endforeach
</main>
@endsection

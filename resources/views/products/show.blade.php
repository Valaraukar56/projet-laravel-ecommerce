@extends('layouts.app')
@section('title', $product->name . ' — JT Art')

@section('content')
<div class="product-detail">
    <div class="product-detail-grid">
        @if($product->image)
            <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="product-detail-image">
        @else
            <div class="product-detail-placeholder">
                <i class="bi bi-image"></i>
            </div>
        @endif

        <div class="product-detail-content">
            <h1 class="product-detail-title">{{ $product->name }}</h1>

            @if($product->description)
                <p class="product-detail-description">{{ $product->description }}</p>
            @else
                <p class="product-detail-description">Création artisanale unique en point de croix.</p>
            @endif

            <p class="product-detail-price">{{ number_format($product->price, 2, ',', ' ') }} €</p>

            <div class="product-detail-actions">
                @auth
                    <form action="{{ route('cart.store', $product) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-cart-plus"></i> Ajouter au panier
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary">
                        <i class="bi bi-box-arrow-in-right"></i> Connectez-vous pour acheter
                    </a>
                @endauth

                @role('admin')
                    <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Supprimer ce produit ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash"></i> Supprimer
                        </button>
                    </form>
                @endrole
            </div>

            <a href="{{ route('products.index') }}" class="back-link">
                <i class="bi bi-arrow-left"></i> Retour aux produits
            </a>
        </div>
    </div>
</div>
@endsection

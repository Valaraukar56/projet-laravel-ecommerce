@extends('layouts.app')
@section('title', 'Produits — JT Art')

@section('content')
<header class="banner">
    <h1><i class="bi bi-palette2"></i> Nos Créations</h1>
    <p>Des créations uniques faites main en point de croix</p>

    <div class="currency-form">
        <form method="GET" action="{{ route('products.index') }}">
            <label for="currency"><i class="bi bi-currency-exchange"></i> Devise :</label>
            <select name="currency" id="currency" onchange="this.form.submit()">
                <option value="EUR" {{ $currency == 'EUR' ? 'selected' : '' }}>EUR (€)</option>
                <option value="USD" {{ $currency == 'USD' ? 'selected' : '' }}>USD ($)</option>
                <option value="GBP" {{ $currency == 'GBP' ? 'selected' : '' }}>GBP (£)</option>
            </select>
        </form>
    </div>
</header>

<section class="products">
    @forelse($products as $product)
        <article class="product">
            @if($product->image)
                <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="product-image">
            @else
                <div class="product-placeholder">
                    <i class="bi bi-image"></i>
                </div>
            @endif

            <div class="product-content">
                <h2 class="product-title">{{ $product->name }}</h2>

                @if($product->description)
                    <p class="product-description">{{ Str::limit($product->description, 80) }}</p>
                @endif

                <p class="product-price">
                    @if ($currency === 'USD')
                        {{ number_format($product->converted_price, 2, ',', ' ') }} $
                    @elseif ($currency === 'GBP')
                        {{ number_format($product->converted_price, 2, ',', ' ') }} £
                    @else
                        {{ number_format($product->converted_price, 2, ',', ' ') }} €
                    @endif
                </p>

                <div class="product-actions">
                    <a href="{{ route('products.show', $product) }}" class="btn">
                        <i class="bi bi-eye"></i> Voir détails
                    </a>

                    @auth
                        <form action="{{ route('cart.store', $product) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-cart-plus"></i> Ajouter au panier
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-sm">
                            <i class="bi bi-box-arrow-in-right"></i> Connectez-vous
                        </a>
                    @endauth

                    @role('admin')
                        <div class="btn-group">
                            <a href="{{ route('products.edit', $product) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil"></i> Modifier
                            </a>
                            <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Supprimer ce produit ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i> Supprimer
                                </button>
                            </form>
                        </div>
                    @endrole
                </div>
            </div>
        </article>
    @empty
        <div class="cart-empty">
            <i class="bi bi-emoji-frown"></i>
            <p>Aucun produit disponible pour le moment.</p>
        </div>
    @endforelse
</section>
@endsection

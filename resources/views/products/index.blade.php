@extends('layouts.app')
@section('title', 'Produits — JT Art')

@section('content')
<header class="banner">
    @role('admin')
    <a href="{{ route('products.create') }}" class="btn">Créer un produit</a>
    @endrole

    <p>Des créations faites main en point de croix</p>

    
    <form method="GET" action="{{ route('products.index') }}" style="margin-top: 10px;">
        <label for="currency">Devise :</label>
        <select name="currency" id="currency" onchange="this.form.submit()">
            <option value="EUR" {{ $currency == 'EUR' ? 'selected' : '' }}>EUR (€)</option>
            <option value="USD" {{ $currency == 'USD' ? 'selected' : '' }}>USD ($)</option>
            <option value="GBP" {{ $currency == 'GBP' ? 'selected' : '' }}>GBP (£)</option>
        </select>
    </form>
</header>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<main class="products">
    @foreach($products as $product)
        <div class="product">

            @if($product->image)
                <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">
            @endif

            <h1>{{ $product->name }}</h1>

            
            <p><strong>
                @if ($currency === 'USD')
                    {{ number_format($product->converted_price, 2, ',', ' ') }} $
                @elseif ($currency === 'GBP')
                    {{ number_format($product->converted_price, 2, ',', ' ') }} £
                @else
                    {{ number_format($product->converted_price, 2, ',', ' ') }} €
                @endif
            </strong></p>

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

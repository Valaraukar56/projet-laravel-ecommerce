@extends('layouts.app')
@section('title', 'Panier — JT Art')
@section('content')
<div class="cart">
    <h2>Votre panier</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @forelse($items as $item)
        <div class="item">
            @if($item->product->image)
                <img src="{{ asset('storage/'.$item->product->image) }}" alt="{{ $item->product->name }}">
            @endif
            <div class="product-name">{{ $item->product->name }}</div>
            <div class="price">{{ number_format($item->product->price, 2, ',', ' ') }} €</div>
            <div class="quantity">
                <form action="{{ route('cart.update', $item) }}" method="POST" style="display:inline-flex;gap:5px;">
                    @csrf
                    @method('PATCH')
                    <button type="submit" name="quantity" value="{{ $item->quantity - 1 }}" {{ $item->quantity <= 1 ? 'disabled' : '' }}>-</button>
                    <span>{{ $item->quantity }}</span>
                    <button type="submit" name="quantity" value="{{ $item->quantity + 1 }}">+</button>
                </form>
            </div>
            <div class="subtotal">
                {{ number_format($item->product->price * $item->quantity, 2, ',', ' ') }} €
            </div>
            <form action="{{ route('cart.remove', $item) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="remove">Supprimer</button>
            </form>
        </div>
    @empty
        <p>Votre panier est vide.</p>
        <a href="{{ route('products.index') }}" class="btn">Voir les produits</a>
    @endforelse

    @if($items->count() > 0)
        <div class="cart-total">
            <h3>Total : {{ number_format($total, 2, ',', ' ') }} €</h3>
            <a href="#" class="btn btn-primary">Procéder au paiement</a>
        </div>
    @endif
</div>
@endsection
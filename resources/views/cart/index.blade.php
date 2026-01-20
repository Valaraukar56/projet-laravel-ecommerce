@extends('layouts.app')
@section('title', 'Panier — JT Art')

@section('content')
<div class="cart">
    <h2><i class="bi bi-cart3"></i> Votre panier</h2>

    @forelse($items as $item)
        <div class="item">
            @if($item->product->image)
                <img src="{{ asset('storage/'.$item->product->image) }}" alt="{{ $item->product->name }}">
            @else
                <div style="width: 100px; height: 100px; background: #f0f0f0; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-image" style="font-size: 2rem; color: #ccc;"></i>
                </div>
            @endif

            <div class="product-name">{{ $item->product->name }}</div>

            <div class="price">{{ number_format($item->product->price, 2, ',', ' ') }} €</div>

            <div class="quantity">
                <form action="{{ route('cart.update', $item) }}" method="POST" style="display:inline-flex;gap:5px;align-items:center;">
                    @csrf
                    @method('PATCH')
                    <button type="submit" name="quantity" value="{{ $item->quantity - 1 }}" {{ $item->quantity <= 1 ? 'disabled' : '' }}>
                        <i class="bi bi-dash"></i>
                    </button>
                    <span>{{ $item->quantity }}</span>
                    <button type="submit" name="quantity" value="{{ $item->quantity + 1 }}">
                        <i class="bi bi-plus"></i>
                    </button>
                </form>
            </div>

            <div class="subtotal">
                {{ number_format($item->product->price * $item->quantity, 2, ',', ' ') }} €
            </div>

            <form action="{{ route('cart.remove', $item) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="remove">
                    <i class="bi bi-trash"></i>
                </button>
            </form>
        </div>
    @empty
        <div class="cart-empty">
            <i class="bi bi-cart-x"></i>
            <p>Votre panier est vide</p>
            <a href="{{ route('products.index') }}" class="btn btn-primary">
                <i class="bi bi-arrow-left"></i> Découvrir nos créations
            </a>
        </div>
    @endforelse

    @if($items->count() > 0)
        <div class="cart-total">
            <h3>Total : <span>{{ number_format($total, 2, ',', ' ') }} €</span></h3>
            <a href="#" class="btn btn-primary" style="width: 100%; justify-content: center;">
                <i class="bi bi-credit-card"></i> Procéder au paiement
            </a>
        </div>
    @endif
</div>
@endsection

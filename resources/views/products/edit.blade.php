@extends('layouts.app')
@section('title', 'Modifier un produit — JT Art')

@section('content')
<div class="form-container">
    <h1><i class="bi bi-pencil"></i> Modifier le produit</h1>

    <form method="POST" action="{{ route('products.update', $product) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name"><i class="bi bi-tag"></i> Nom du produit</label>
            <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required placeholder="Ex: Tableau point de croix fleurs">
            @error('name')
                <p class="error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="description"><i class="bi bi-text-paragraph"></i> Description</label>
            <textarea id="description" name="description" placeholder="Décrivez votre création...">{{ old('description', $product->description) }}</textarea>
            @error('description')
                <p class="error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="price"><i class="bi bi-currency-euro"></i> Prix (€)</label>
            <input type="number" id="price" step="0.01" min="0.01" name="price" value="{{ old('price', $product->price) }}" required placeholder="29.99">
            @error('price')
                <p class="error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="image"><i class="bi bi-image"></i> Image</label>
            @if($product->image)
                <div class="current-image">
                    <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" style="max-width: 200px; margin-bottom: 10px; border-radius: 8px;">
                    <p><small>Image actuelle</small></p>
                </div>
            @endif
            <input type="file" id="image" name="image" accept="image/*">
            <p><small>Laissez vide pour conserver l'image actuelle</small></p>
            @error('image')
                <p class="error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</p>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-circle"></i> Enregistrer les modifications
            </button>
            <a href="{{ route('products.index') }}" class="btn">
                <i class="bi bi-x-circle"></i> Annuler
            </a>
        </div>
    </form>
</div>
@endsection

@extends('layouts.app')
@section('title', 'Créer un produit — JT Art')

@section('content')
<div class="form-container">
    <h1><i class="bi bi-plus-circle"></i> Créer un produit</h1>

    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name"><i class="bi bi-tag"></i> Nom du produit</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="Ex: Tableau point de croix fleurs">
            @error('name')
                <p class="error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="description"><i class="bi bi-text-paragraph"></i> Description</label>
            <textarea id="description" name="description" placeholder="Décrivez votre création...">{{ old('description') }}</textarea>
            @error('description')
                <p class="error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="price"><i class="bi bi-currency-euro"></i> Prix (€)</label>
            <input type="number" id="price" step="0.01" min="0.01" name="price" value="{{ old('price') }}" required placeholder="29.99">
            @error('price')
                <p class="error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="image"><i class="bi bi-image"></i> Image</label>
            <input type="file" id="image" name="image" accept="image/*">
            @error('image')
                <p class="error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</p>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-circle"></i> Créer le produit
            </button>
            <a href="{{ route('products.index') }}" class="btn">
                <i class="bi bi-x-circle"></i> Annuler
            </a>
        </div>
    </form>
</div>
@endsection

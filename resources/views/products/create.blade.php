@extends('layouts.app')

@section('content')
    <h1>Créer un produit</h1>

    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
        @csrf

        <label>Nom :</label>
        <input type="text" name="name" required>
        @error('name')
            <p style="color:red;">{{ $message }}</p>
        @enderror
        <label>Prix :</label>
        <input type="number" step="0.01" name="price" required>
        @error('price')
            <p style="color:red;">{{ $message }}</p>
        @enderror
        <label>Image :</label>
        <input type="file" name="image">

        <button type="submit">Créer</button>
    </form>
@endsection

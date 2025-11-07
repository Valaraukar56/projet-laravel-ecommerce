@extends('layouts.app')

@section('content')
    <h1>Créer un produit</h1>

    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
        @csrf

        <label>Nom :</label>
        <input type="text" name="name" required>

        <label>Prix :</label>
        <input type="number" step="0.01" name="price" required>

        <label>Image :</label>
        <input type="file" name="image">

        <button type="submit">Créer</button>
    </form>
@endsection

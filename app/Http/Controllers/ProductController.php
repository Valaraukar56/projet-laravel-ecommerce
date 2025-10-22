<?php

namespace App\Http\Controllers;

use App\Models\Product; // <-- important
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // Récupère tous les produits
        $products = Product::all();

        // Envoie à la vue products/index.blade.php
        return view('products.index', compact('products'));
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
}

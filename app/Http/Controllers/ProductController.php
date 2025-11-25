<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    
    public function index(Request $request)
    {
        $currency = $request->get('currency', 'EUR'); 
        $products = Product::all();

        foreach ($products as $product) {
            $price = $product->price;

            if ($currency === 'USD') {
                $price = $price * 1.14;
            } elseif ($currency === 'GBP') {
                $price = $price / 1.18;
            }

            
            $product->converted_price = $price;
        }

        return view('products.index', compact('products', 'currency'));
    }

    // Page d'un produit
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    // Formulaire de création
    public function create()
    {
        return view('products.create');
    }

    // Enregistrement d'un nouveau produit
    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();

        // Upload si image envoyée
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $data['image'] = $path;
        }

        Product::create($data);

        return redirect()
            ->route('products.index')
            ->with('success', 'Produit créé avec succès !');
    }

    // Suppression d'un produit
    public function destroy(Product $product)
    {
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Produit supprimé.');
    }
}

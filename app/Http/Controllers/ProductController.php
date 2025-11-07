<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Lister tous les produits
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    // Page d'un produit
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    // Formulaire de création (admin only)
    public function create()
    {
        return view('products.create');
    }

    // Enregistrement d'un nouveau produit
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'  => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'nullable|file|mimetypes:image/*'
        ]);

        // Upload si image envoyée
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public'); // storage/app/public/images
            $data['image'] = $path;
        }

        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Produit créé avec succès !');
    }
    public function destroy(Product $product)
    {
        // si tu veux supprimer aussi l'image du storage :
        if ($product->image && \Storage::disk('public')->exists($product->image)) {
            \Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produit supprimé.');
    }

}

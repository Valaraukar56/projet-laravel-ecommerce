<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $items = CartItem::where('user_id', Auth::id())
            ->with('product')
            ->get();
        
        $total = $items->sum(function($item) {
            return $item->product->price * $item->quantity;
        });

        return view('cart.index', compact('items', 'total'));
    }

    public function store(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'nullable|integer|min:1'
        ]);

        $quantity = $request->input('quantity', 1);

        // Vérifier si le produit existe déjà dans le panier
        $cartItem = CartItem::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            // Si existe, augmenter la quantité
            $cartItem->increment('quantity', $quantity);
            return redirect()->back()->with('success', 'Quantité mise à jour dans le panier !');
        }

        // Sinon, créer un nouveau cart item
        CartItem::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'quantity' => $quantity,
        ]);

        return redirect()->back()->with('success', 'Produit ajouté au panier !');
    }

    public function update(Request $request, CartItem $cartItem)
    {
        // Vérifier que l'item appartient bien à l'utilisateur connecté
        if ($cartItem->user_id !== Auth::id()) {
            abort(403);
        }

        $quantity = $request->input('quantity');

        if ($quantity < 1) {
            $cartItem->delete();
            return redirect()->route('cart.index')->with('success', 'Produit retiré du panier.');
        }

        $cartItem->update(['quantity' => $quantity]);

        return redirect()->route('cart.index')->with('success', 'Quantité mise à jour.');
    }

    public function destroy(CartItem $cartItem)
    {
        // Vérifier que l'item appartient bien à l'utilisateur connecté
        if ($cartItem->user_id !== Auth::id()) {
            abort(403);
        }

        $cartItem->delete();

        return redirect()->route('cart.index')->with('success', 'Produit retiré du panier.');
    }
}
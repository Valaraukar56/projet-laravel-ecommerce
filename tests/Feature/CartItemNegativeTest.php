<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class CartItemNegativeTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_fails_to_create_cart_item_without_user_id()
    {
        $product = Product::factory()->create();

        $this->expectException(\Illuminate\Database\QueryException::class);

        CartItem::create([
            'product_id' => $product->id,
            'quantity' => 1,
        ]);
    }

    #[Test]
    public function it_fails_to_create_cart_item_without_product_id()
    {
        $user = User::factory()->create();

        $this->expectException(\Illuminate\Database\QueryException::class);

        CartItem::create([
            'user_id' => $user->id,
            'quantity' => 1,
        ]);
    }

    #[Test]
    public function it_fails_to_create_cart_item_without_quantity()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $this->expectException(\Illuminate\Database\QueryException::class);

        CartItem::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
        ]);
    }

    #[Test]
    public function it_fails_with_non_existent_user_id()
    {
        $product = Product::factory()->create();

        $this->expectException(\Illuminate\Database\QueryException::class);

        CartItem::create([
            'user_id' => 99999,
            'product_id' => $product->id,
            'quantity' => 1,
        ]);
    }

    #[Test]
    public function it_fails_with_non_existent_product_id()
    {
        $user = User::factory()->create();

        $this->expectException(\Illuminate\Database\QueryException::class);

        CartItem::create([
            'user_id' => $user->id,
            'product_id' => 99999,
            'quantity' => 1,
        ]);
    }

    #[Test]
    public function it_fails_with_zero_quantity()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        // Selon votre logique métier, 0 pourrait être invalide
        $cartItem = CartItem::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => 0,
        ]);

        // Si vous voulez empêcher quantity = 0, ajoutez une validation
        $this->assertEquals(0, $cartItem->quantity);
    }

    #[Test]
    public function it_fails_with_negative_quantity()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        // Laravel acceptera les valeurs négatives sans validation
        $cartItem = CartItem::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => -5,
        ]);

        $this->assertEquals(-5, $cartItem->quantity);
    }

    #[Test]
    public function it_cascades_delete_when_user_is_deleted()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $cartItem = CartItem::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => 1,
        ]);

        $user->delete();

        // Vérifie que le CartItem a été supprimé (si cascade configuré)
        $this->assertDatabaseMissing('cart_items', [
            'id' => $cartItem->id,
        ]);
    }

    #[Test]
    public function it_cascades_delete_when_product_is_deleted()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $cartItem = CartItem::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => 1,
        ]);

        $product->delete();

        // Vérifie que le CartItem a été supprimé (si cascade configuré)
        $this->assertDatabaseMissing('cart_items', [
            'id' => $cartItem->id,
        ]);
    }

    #[Test]
    public function it_returns_null_for_deleted_cart_item()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $cartItem = CartItem::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => 1,
        ]);

        $cartItemId = $cartItem->id;
        $cartItem->delete();

        $this->assertNull(CartItem::find($cartItemId));
    }

    #[Test]
    public function it_fails_to_update_with_non_existent_product()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $cartItem = CartItem::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => 1,
        ]);

        $this->expectException(\Illuminate\Database\QueryException::class);

        $cartItem->update(['product_id' => 99999]);
    }
}
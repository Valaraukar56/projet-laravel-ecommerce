<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use PHPUnit\Framework\Attributes\Test;

class CartItemTest extends TestCase
{
    #[Test]
    public function test_cart_page_is_visible()
    {
        // on crée un user
        $user = User::factory()->create();
        // on simule connexion
        $this->actingAs($user);
        // on visite la route cart
        $response = $this->get('/cart');
        // on vérifie 200
        $response->assertStatus(200);
        // on vérifie que le texte existe bien sur la page
        $response->assertSee('Votre panier');
    }
}

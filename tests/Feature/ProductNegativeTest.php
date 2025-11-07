<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class ProductNegativeTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_fails_to_create_product_without_name()
    {
        $this->expectException(\Illuminate\Database\QueryException::class);

        Product::create([
            'description' => 'Test description',
            'price' => 100.00,
            'image' => 'test.jpg',
        ]);
    }

    #[Test]
    public function it_fails_to_create_product_without_price()
    {
        $this->expectException(\Illuminate\Database\QueryException::class);

        Product::create([
            'name' => 'Test Product',
            'description' => 'Test description',
            'image' => 'test.jpg',
        ]);
    }

    #[Test]
    public function it_allows_null_description()
    {
        // Si votre migration permet NULL pour description
        $product = Product::create([
            'name' => 'Test Product',
            'price' => 100.00,
            'image' => 'test.jpg',
        ]);

        $this->assertNull($product->description);
    }

    #[Test]
    public function it_allows_null_image()
    {
        // Si votre migration permet NULL pour image
        $product = Product::create([
            'name' => 'Test Product',
            'description' => 'Test description',
            'price' => 100.00,
        ]);

        $this->assertNull($product->image);
    }

    #[Test]
    public function it_accepts_zero_price()
    {
        $product = Product::create([
            'name' => 'Free Product',
            'description' => 'Test description',
            'price' => 0,
            'image' => 'test.jpg',
        ]);

        $this->assertEquals(0, $product->price);
    }

    #[Test]
    public function it_accepts_negative_price()
    {
        // Laravel acceptera sans validation
        $product = Product::create([
            'name' => 'Discount Product',
            'description' => 'Test description',
            'price' => -10.00,
            'image' => 'test.jpg',
        ]);

        $this->assertEquals(-10.00, $product->price);
    }

    #[Test]
    public function it_cannot_find_deleted_product()
    {
        $product = Product::factory()->create();
        $productId = $product->id;

        $product->delete();

        $this->assertNull(Product::find($productId));
    }

    #[Test]
    public function it_fails_with_invalid_price_format()
    {
        $this->expectException(\Illuminate\Database\QueryException::class);

        Product::create([
            'name' => 'Test Product',
            'description' => 'Test description',
            'price' => 'invalid_price',
            'image' => 'test.jpg',
        ]);
    }

    #[Test]
    public function it_allows_very_long_product_name()
    {
        $longName = str_repeat('A', 500);

        // Devrait échouer si votre colonne name a une limite
        try {
            $product = Product::create([
                'name' => $longName,
                'description' => 'Test',
                'price' => 100,
                'image' => 'test.jpg',
            ]);

            // Si ça passe, vérifiez la longueur
            $this->assertLessThanOrEqual(255, strlen($product->name));
        } catch (\Illuminate\Database\QueryException $e) {
            $this->assertTrue(true); // Expected to fail
        }
    }

    #[Test]
    public function it_returns_empty_collection_when_no_products_exist()
    {
        $products = Product::all();

        $this->assertCount(0, $products);
        $this->assertTrue($products->isEmpty());
    }
}
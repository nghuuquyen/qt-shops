<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Support\Facades\Session;

class CheckoutTest extends TestCase
{
    public function test_can_render_checkout_page()
    {
        $this->get(route('checkout.index'))
                ->assertOk()
                ->assertViewIs('checkout');
    }

    // public function test_display_correct_cart_data()
    // {
    //     $cart = new CartService();

    //     $products = Product::factory()->count(3)->create();

    //     foreach ($products as $product) {
    //         $cart_item = [
    //             'product_id' => $product->id,
    //             'quantity' => 5,
    //             'notes' => 'here my notes',
    //         ];
    
    //         $cart->addCartItem($cart_item);    
    //     }

    //     $response = $this->get(route('checkout.index'));

    //     foreach ($products as $product) {
    //         $response->assertSee($product->name);
    //     }
    // }
}
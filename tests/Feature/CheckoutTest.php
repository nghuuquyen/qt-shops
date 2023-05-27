<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class CheckoutTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_render_checkout_page()
    {
        $this->get(route('checkout.index'))
            ->assertOk()
            ->assertViewIs('checkout');
    }

    public function test_display_correct_cart_data()
    {
        Session::put('user_id', 'DUMMY_USER_ID');

        $cart = new CartService();

        $products = Product::factory()->count(3)->create();

        foreach ($products as $product) {
            $cart_item = [
                'product_id' => $product->id,
                'quantity' => 5,
                'notes' => 'here my notes',
            ];

            $cart->addCartItem($cart_item);
        }

        $response = $this->withSession(['user_id' => 'DUMMY_USER_ID'])
            ->get(route('checkout.index'));

        foreach ($products as $product) {
            $response
                ->assertSee($product->name)
                ->assertSee($product->getFormattedTotalAmount(5));
        }
    }

    public function test_got_validation_errors()
    {
        $this->post(route('checkout.store'), [])
            ->assertInvalid([
                'full_name',
                'phone_number',
                'email',
                'shipping_address',
            ]);
    }

    public function test_can_create_order_when_submit_checkout()
    {
        Session::put('user_id', 'DUMMY_USER_ID');

        $cart = new CartService();

        $products = Product::factory()->count(3)->create();

        foreach ($products as $product) {
            $cart_item = [
                'product_id' => $product->id,
                'quantity' => 5,
                'notes' => 'here my notes',
            ];

            $cart->addCartItem($cart_item);
        }

        // should do this because after created order, get card will return new instance
        $original_cart = $cart->getCart();

        $body = [
            'full_name' => 'John',
            'phone_number' => '+84111122222',
            'email' => 'john@example.com',
            'shipping_address' => 'lorem ipsum',
        ];

        $response = $this->withSession(['user_id' => 'DUMMY_USER_ID'])
            ->post(route('checkout.store'), $body);

        $order = Order::query()->where('cart_id', $original_cart->id)->first();

        $response->assertRedirectToSignedRoute('orders.complete', ['order' => $order->id]);
    }
}

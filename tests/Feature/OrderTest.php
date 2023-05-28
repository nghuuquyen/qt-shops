<?php

namespace Tests\Feature;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Services\CartService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_render_order_detail_page()
    {
        $cart = new CartService();

        $order = $cart->getCart()->order()->save(
            Order::factory()->make()
        );

        $this->get(URL::signedRoute('orders.show', ['order' => $order->id]))
            ->assertOk()
            ->assertViewIs('orders.show');
    }

    public function test_order_detail_page_display_correct_data()
    {
        $cart = Cart::factory()
            ->has(CartItem::factory()->count(3), 'items')
            ->has(Order::factory(), 'order')
            ->create();

        $order = $cart->order;

        $response = $this->get(URL::signedRoute('orders.show', ['order' => $order->id]))
            ->assertOk()
            ->assertViewIs('orders.show');

        // verify display cart items
        foreach ($cart->items as $cart_item) {
            $response
                ->assertSee($cart_item->product->name)
                ->assertSee($cart_item->product->formatted_price)
                ->assertSee($cart_item->notes)
                ->assertSee($cart_item->quantity)
                ->assertSee($cart_item->product->getFormattedTotalAmount(5));
        }

        // verify display order informations
        $response
            ->assertSee($order->code)
            ->assertSee($order->full_name)
            ->assertSee($order->email_address)
            ->assertSee($order->phone_number)
            ->assertSee($order->shipping_address)
            ->assertSee($order->notes);
    }
}
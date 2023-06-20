<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\URL;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_able_to_get_cart()
    {
        $order = Order::factory()->create();

        $this->assertInstanceOf(Cart::class, $order->cart);
    }

    public function test_able_to_get_signed_path_to_order_detail_page()
    {
        $order = Order::factory()->create();

        $path = $order->getPath();

        $this->loginAsAministrator();

        $this->get($path)->assertOk()->assertViewIs('orders.show');
    }
}

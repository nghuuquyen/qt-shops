<?php

namespace Tests\Unit\Controllers;

use Tests\TestCase;
use App\Models\Order;
use Illuminate\Support\Facades\URL;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderCompleteControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_render_order_complete_page()
    {
        $order = Order::factory()->create();

        $this->get(URL::signedRoute('orders.complete', ['order' => $order->id]))
            ->assertOk()
            ->assertViewIs('orders.complete')
            ->assertSee($order->code)
            ->assertSee($order->email);
    }

    public function test_can_not_access_order_complete_page_with_invalid_signature()
    {
        $order = Order::factory()->create();

        $this->get(route('orders.complete', [ 'order' => $order->id ]))
            ->assertUnauthorized();
    }

}

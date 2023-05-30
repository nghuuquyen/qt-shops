<?php

namespace Tests\Feature\Livewire;

use App\Events\LivewireEvent;
use App\Http\Livewire\CartBar;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CartBarTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_contains_add_cart_item_popup()
    {
        $this->get('/')->assertSeeLivewire(CartBar::class);
    }

    public function test_cart_bar_display_correct_cart_items()
    {
        $cart = Cart::factory()
            ->has(CartItem::factory()->count(3), 'items')
            ->create();

        // verify internal data
        $component = Livewire::test(CartBar::class)
            ->emit(LivewireEvent::CART_UPDATED_EVENT)
            ->assertSet('cart.id', $cart->id)
            ->assertSet('display', true);

        // verify rendered HTML content
        foreach ($cart->items as $item) {
            $component->assertSee($item->product->name);
        }

        // verify total amount is display correct
        $component->assertSee($cart->formatted_total_amount);
    }

    public function test_can_remove_cart_item()
    {
        $cart = Cart::factory()
            ->has(CartItem::factory()->count(3), 'items')
            ->create();

        $cart_item = $cart->items->first();

        $this->assertNotNull(
            $cart->items->where('product_id', $cart_item->product_id)->first()
        );

        Livewire::test(CartBar::class)
            ->call('removeCartItem', $cart_item->product_id);

        $cart->refresh();

        $this->assertNull(
            $cart->items->where('product_id', $cart_item->product_id)->first()
        );
    }

    public function test_can_move_to_checkout_page()
    {
        Livewire::test(CartBar::class)
            ->call('checkout')
            ->assertRedirect(route('checkout.index'));
    }
}

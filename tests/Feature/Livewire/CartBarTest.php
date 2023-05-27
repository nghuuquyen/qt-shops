<?php

namespace Tests\Feature;

use Tests\TestCase;
use Livewire\Livewire;
use App\Models\Product;
use App\Events\BrowserEvent;
use App\Events\LivewireEvent;
use App\Services\CartService;
use App\Http\Livewire\CartBar;
use App\Http\Livewire\AddCartItemPopup;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CartBarTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_contains_add_cart_item_popup()
    {
        $this->get('/')->assertSeeLivewire(CartBar::class);
    }

    public function test_cart_bar_display_correct_cart_items()
    {
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

        // verify internal data
        $component = Livewire::test(CartBar::class)
            ->emit(LivewireEvent::CART_UPDATED_EVENT)
            ->assertSet('cart.id', $cart->getCart()->id)
            ->assertSet('display', true);

        // verify rendered HTML content
        foreach ($products as $product) {
            $component->assertSee($product->name);   
        }

        // verify total amount is display correct
        $component->assertSee($cart->getCart()->getFormattedTotalAmount());
    }

    public function test_can_remove_cart_item()
    {
        $product = Product::factory()->create();

        $cart = new CartService();

        $cart_item = [
            'product_id' => $product->id,
            'quantity' => 5,
            'notes' => 'here my notes',
        ];

        $cart->addCartItem($cart_item);
        
        $this->assertNotNull($cart->getCartItem($product->id));

        Livewire::test(CartBar::class)->call('removeCartItem', $product->id);

        $this->assertNull($cart->getCartItem($product->id));
    }

    public function test_can_move_to_checkout_page()
    {
        $product = Product::factory()->create();

        $cart = new CartService();

        $cart_item = [
            'product_id' => $product->id,
            'quantity' => 5,
            'notes' => 'here my notes',
        ];

        $cart->addCartItem($cart_item);
        
        $this->assertNotNull($cart->getCartItem($product->id));

        Livewire::test(CartBar::class)
            ->call('checkout')
            ->assertRedirect(route('checkout.index'));
    }
}
<?php

namespace Tests\Feature;

use App\Events\BrowserEvent;
use App\Events\LivewireEvent;
use App\Http\Livewire\AddCartItemPopup;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AddCartItemPopupTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_contains_add_cart_item_popup()
    {
        $this->get('/')->assertSeeLivewire(AddCartItemPopup::class);
    }

    public function test_popup_display_correct_selected_product_data()
    {
        $product = Product::factory()->create();

        // verify internal component data is correct
        $component = Livewire::test(AddCartItemPopup::class)
            ->emit(LivewireEvent::USER_SELECT_PRODUCT, $product->id)
            ->assertSet('product.id', $product->id)
            ->assertSet('product.name', $product->name)
            ->assertDispatchedBrowserEvent(BrowserEvent::DISPLAY_OFFCANVAS);

        // verify render HTML content is correct
        $component
            ->assertSee($product->display_image_url)
            ->assertSee($product->name)
            ->assertSee($product->display_price)
            ->assertSee($product->description);
    }

    public function test_popup_display_correct_cart_item_data()
    {
        $cart = Cart::factory()
            ->has(CartItem::factory()->count(3), 'items')
            ->create();

        $cart_item = $cart->items->random();

        $component = Livewire::test(AddCartItemPopup::class)
            ->emit(LivewireEvent::USER_SELECT_PRODUCT, $cart_item->product->id)
            ->assertSet('product.id', $cart_item->product->id)
            ->assertSet('quantity', $cart_item->quantity)
            ->assertSet('notes', $cart_item->notes);
    }

    public function test_popup_should_reset_form_data_on_multiple_times_called()
    {
        $cart = Cart::factory()
            ->has(CartItem::factory()->count(3), 'items')
            ->create();

        $cart_item = $cart->items->random();

        // case product have cart item, then should display property cart item data
        $component = Livewire::test(AddCartItemPopup::class)
            ->emit(LivewireEvent::USER_SELECT_PRODUCT, $cart_item->product->id)
            ->assertSet('product.id', $cart_item->product->id)
            ->assertSet('quantity', $cart_item->quantity)
            ->assertSet('notes', $cart_item->notes);

        // case product does have cart item, form should reset previous note and quantity to default value
        $other_product = Product::factory()->create();

        $component->emit(LivewireEvent::USER_SELECT_PRODUCT, $other_product->id)
            ->assertSet('product.id', $other_product->id)
            ->assertSet('quantity', AddCartItemPopup::MIN_QUANTITY)
            ->assertSet('notes', '');

        // continue call with other product
        $component
            ->emit(LivewireEvent::USER_SELECT_PRODUCT, $cart_item->product->id)
            ->assertSet('product.id', $cart_item->product->id)
            ->assertSet('quantity', $cart_item->quantity)
            ->assertSet('notes', $cart_item->notes);
    }

    public function test_can_increment_and_decrement_quantity()
    {
        Livewire::test(AddCartItemPopup::class)
            ->assertSet('quantity', AddCartItemPopup::MIN_QUANTITY)
            ->call('increment')
            ->assertSet('quantity', AddCartItemPopup::MIN_QUANTITY + 1);

        Livewire::test(AddCartItemPopup::class)
            ->set('quantity', AddCartItemPopup::MIN_QUANTITY + 1)
            ->call('decrement')
            ->assertSet('quantity', AddCartItemPopup::MIN_QUANTITY);
    }

    public function test_display_correct_total_amount()
    {
        $product = Product::factory()->create();

        Livewire::test(AddCartItemPopup::class)
            ->emit(LivewireEvent::USER_SELECT_PRODUCT, $product->id)
            ->set('quantity', 10)
            ->assertSee($product->getFormattedTotalAmount(10));

        Livewire::test(AddCartItemPopup::class)
            ->emit(LivewireEvent::USER_SELECT_PRODUCT, $product->id)
            ->set('quantity', 3)
            ->assertSee($product->getFormattedTotalAmount(3));
    }

    public function test_can_not_decrement_quantity_less_than_min_quantity()
    {
        Livewire::test(AddCartItemPopup::class)
            ->assertSet('quantity', AddCartItemPopup::MIN_QUANTITY)
            ->call('decrement')
            ->assertSet('quantity', AddCartItemPopup::MIN_QUANTITY);
    }

    public function test_can_add_cart_item()
    {
        $product = Product::factory()->create();

        $component = Livewire::test(AddCartItemPopup::class)
            ->emit(LivewireEvent::USER_SELECT_PRODUCT, $product->id)
            ->set('quantity', 5)
            ->set('notes', 'here my notes')
            ->call('addCartItem')
            ->assertEmitted('CART_UPDATED_EVENT')
            ->assertDispatchedBrowserEvent(BrowserEvent::CLOSE_OFFCANVAS);

        $cart = new CartService();

        $cart_item = $cart->getCartItem($product->id);

        $this->assertTrue($cart_item['quantity'] == 5);

        $this->assertTrue($cart_item['notes'] == 'here my notes');
    }
}

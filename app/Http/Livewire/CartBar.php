<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use Livewire\Component;
use App\Services\CartService;

class CartBar extends Component
{
    public Cart $cart;

    public $display = false;

    protected $listeners = [
        'cartItemAdded' => 'loadingCartData',
    ];

    public function mount()
    {
        $this->loadingCartData();
    }

    public function loadingCartData()
    {
        $cart = new CartService();

        $this->cart = $cart->getCart();

        $this->display = $this->cart->items->isNotEmpty();
    }

    public function removeCartItem($product_id)
    {
        $cart = new CartService();

        $cart->removeCartitem($product_id);

        $this->loadingCartData();
    }

    public function render()
    {
        return view('livewire.cart-bar');
    }
}

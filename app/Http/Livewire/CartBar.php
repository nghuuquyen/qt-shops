<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use App\Services\CartService;
use Livewire\Component;

class CartBar extends Component
{
    public Cart $cart;

    public $display = false;

    protected $listeners = [
        'CART_UPDATED_EVENT' => 'loadingCartData',
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

        $cart->removeCartItem($product_id);

        $this->loadingCartData();
    }

    public function render()
    {
        return view('livewire.cart-bar');
    }
}

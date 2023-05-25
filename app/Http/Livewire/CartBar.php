<?php

namespace App\Http\Livewire;

use App\Services\CartService;
use Livewire\Component;

class CartBar extends Component
{
    public $cart;

    public $name = 'Quyen';

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

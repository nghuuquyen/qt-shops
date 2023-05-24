<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Services\CartService;
use App\Datasets\ProductDataset;

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

        $dataset = new ProductDataset();

        $this->cart = $cart->getCart();

        $total_amount = 0;

        foreach ($this->cart['items'] as &$item) {
            $product = $dataset->getProduct($item['id']);

            $item['price'] = $product['price'];
            $item['name'] = $product['name'];

            $total_amount += $item['price'] * $item['quantity'];

            $this->cart['currency'] =$product['currency'];
        }

        $this->cart['total_amount'] = $total_amount;
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

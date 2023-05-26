<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Services\CartService;

class AddCartItemPopup extends Component
{
    const MIN_QUANTITY = 1;

    public $product;

    public $quantity = self::MIN_QUANTITY;

    public $notes = '';

    protected $listeners = [
        'selectProduct' => 'displayAddCartItem',
    ];

    public function displayAddCartItem(CartService $cart, $product_id)
    {
        $this->product = Product::find($product_id);

        $this->resetFormData();

        $cart_item = $cart->getCartItem($product_id);

        if ($cart_item) {
            $this->quantity = $cart_item->quantity;
            $this->notes = $cart_item->notes;
        }

        $this->dispatchBrowserEvent('display-offcanvas');
    }

    public function increment()
    {
        $this->quantity++;
    }

    public function decrement()
    {
        if ($this->quantity > self::MIN_QUANTITY) {
            $this->quantity--;
        }
    }

    public function addCartItem(CartService $cart)
    {
        $cart_item = $this->getCartItemInstance();

        $cart->addCartItem($cart_item);

        $this->emit('cartItemAdded', $cart_item);

        $this->dispatchBrowserEvent('close-offcanvas');
    }

    private function resetFormData()
    {
        $this->quantity = self::MIN_QUANTITY;
        $this->notes = '';
    }

    private function getCartItemInstance()
    {
        return [
            'product_id' => $this->product->id,
            'quantity' => $this->quantity,
            'notes' => $this->notes,
        ];
    }

    public function render()
    {
        return view('livewire.add-cart-item-popup');
    }
}

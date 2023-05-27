<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Product;
use App\Models\CartItem;
use Illuminate\Support\Facades\Session;

class CartService
{
    /**
     * Add new or update exists cart item
     *
     * @param  mixed  $item
     * @return bool
     */
    public function addCartItem($item): bool
    {
        $cart = $this->getCart();

        $query_condition = [
            'cart_id' => $cart->id, 'product_id' => $item['product_id'],
        ];

        CartItem::updateOrCreate($query_condition, $item);

        return true;
    }

    /**
     * Remove exists cart item
     *
     * @param  mixed  $product_id
     * @return bool
     */
    public function removeCartItem($product_id): bool
    {
        $cart_item = $this->getCartItem($product_id);

        if ($cart_item) {
            $cart_item->forceDelete();

            return true;
        }

        return false;
    }

    public function getCartItem($product_id): ?CartItem
    {
        $cart = $this->getCart();

        return $cart->items()->where('product_id', $product_id)->first();
    }

    /**
     * Get cart from session
     *
     * @return mixed
     */
    public function getCart(): Cart
    {
        $session_id = Session::getId();

        $cart = Cart::query()->with('items')
                    ->where('session_id', $session_id)
                    ->doesntHave('order')
                    ->first();

        if (!$cart) {
            $cart = Cart::factory()->create([
                'session_id' => $session_id,
            ]);
        }

        return $cart;
    }
}

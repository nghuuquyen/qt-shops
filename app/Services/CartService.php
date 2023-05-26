<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Product;
use App\Models\CartItem;

class CartService
{
    public $dataset;

    public function __construct()
    {
        // 
    }

    /**
     * Add new or update exists cart item
     *
     * @param  mixed  $item
     * @return void
     */
    public function addCartItem($item)
    {
        $cart = $this->getCart();

        $query_condition = [
            'cart_id' => $cart->id, 'product_id' => $item['product_id']
        ];

        CartItem::updateOrCreate($query_condition, $item);
    }

    /**
     * Remove exists cart item
     *
     * @param  mixed  $product_id
     * @return void
     */
    public function removeCartitem($product_id)
    {
        $cart_item = $this->getCartItem($product_id);

        if ($cart_item) {
            $cart_item->forceDelete();
        }

        return false;
    }

    public function getCartItem($product_id)
    {
        $cart = $this->getCart();

        return CartItem::query()
            ->where('cart_id', $cart->id)
            ->where('product_id', $product_id)
            ->first();
    }

    /**
     * Get cart from session
     *
     * @return mixed
     */
    public function getCart()
    {
        $session_id = session()->getId();

        $cart = Cart::query()->with('items')->where('session_id', $session_id)->first();

        if ($cart) {
            $cart['currency'] = Product::DEFAULT_CURRENCY;

            $cart['items'] = collect($cart['items'])->map(function ($item) {
                return $this->getCartItemInstance($item);
            });

            $cart['total_amount'] = collect($cart['items'])->sum(function ($item) {
                return $item['price'] * $item['quantity'];
            });

            return $cart;
        }

        $cart = Cart::factory()->create([
            'session_id' => $session_id,
        ]);

        return $cart;
    }

    /**
     * Get cart item instance with full data
     *
     * @param  mixed  $item
     * @return void
     */
    private function getCartItemInstance($item)
    {
        $product = $item->product;

        return [
            'id' => $item['id'],
            'product_id' => $item['product_id'],
            'quantity' => $item['quantity'],
            'notes' => $item['notes'],
            'name' => $product['name'],
            'description' => $product['description'],
            'price' => $product['price'],
            'currency' => $product['currency'],
            'display_image_url' => $product['display_image_url'],
        ];
    }

    /**
     * Store cart to session
     *
     * @param  mixed  $cart
     * @return void
     */
    public function storeCart($cart)
    {
        session(['cart' => $cart]);
    }
}

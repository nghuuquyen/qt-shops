<?php

namespace App\Services;

use App\Datasets\ProductDataset;

class CartService
{
    public $dataset;

    public function __construct()
    {
        $this->dataset = new ProductDataset();
    }

    /**
     * Add new or update exists cart item
     *
     * @param  mixed  $item
     * @return void
     */
    public function addCartItem($item)
    {
        return $this->isCartItemExists($item)
                    ? $this->replaceExistsCartItem($item)
                    : $this->addNewCartItem($item);
    }

    /**
     * Add new cart item
     *
     * @param  mixed  $item
     * @return void
     */
    public function addNewCartItem($item)
    {
        $cart = $this->getCart();

        $items = collect($cart['items']);

        $cart['items'] = $items->push($this->getCartItemInstance($item))->all();

        $this->storeCart($cart);

        return true;
    }

    /**
     * Replace exists cart item
     *
     * @param  mixed  $item
     * @return void
     */
    public function replaceExistsCartItem($item)
    {
        $cart = $this->getCart();

        $items = collect($cart['items']);

        $index = $items->search(function ($i) use ($item) {
            return $i['id'] == $item['id'];
        });

        if ($index !== false) {

            $cart['items'] = $items->replace([$index => $item])->all();

            $this->storeCart($cart);

            return true;
        }

        return false;
    }

    /**
     * Remove exists cart item
     *
     * @param  mixed  $product_id
     * @return void
     */
    public function removeCartitem($product_id)
    {
        $cart = $this->getCart();

        $items = collect($cart['items']);

        $index = $items->search(function ($i) use ($product_id) {
            return $i['id'] == $product_id;
        });

        if ($index !== false) {
            $items->splice($index, 1);

            $cart['items'] = $items->all();

            $this->storeCart($cart);

            return true;
        }

        return false;
    }

    /**
     * Check is item exists in cart or not
     *
     * @param  mixed  $item
     * @return bool
     */
    public function isCartItemExists($item)
    {
        return $this->getCartItem($item['id']) != null;
    }

    public function getCartItem($product_id)
    {
        $cart = $this->getCart();

        $items = collect($cart['items']);

        if ($items->isEmpty()) {
            return null;
        }

        return $items->where('id', $product_id)->first();
    }

    /**
     * Get cart from session
     *
     * @return mixed
     */
    public function getCart()
    {
        if (session()->has('cart')) {
            $cart = session('cart');

            $cart['currency'] = ProductDataset::DEFAULT_CURRENCY;

            $cart['items'] = collect($cart['items'])->map(function ($item) {
                return $this->getCartItemInstance($item);
            });

            $cart['total_amount'] = collect($cart['items'])->sum(function($item) {
                return $item['price'] * $item['quantity'];
            });

            return $cart;
        }

        $cart = [
            'total_amount' => 0,
            'currency' => ProductDataset::DEFAULT_CURRENCY,
            'items' => collect([]),
        ];

        $this->storeCart($cart);

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
        $product = $this->dataset->getProduct($item['id']);

        return [
            'id' => $item['id'],
            'quantity' => $item['quantity'],
            'notes' => $item['notes'],
            'name' => $product['name'],
            'description' => $product['description'],
            'price' => $product['price'],
            'currency' => $product['currency'],
            'image_url' => $product['image_url'],
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

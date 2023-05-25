<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CartService;
use App\Datasets\ProductDataset;

class CheckoutController extends Controller
{
    public function index(ProductDataset $dataset, CartService $cart) 
    {
        return view('checkout', [
            'cart' => $cart->getCart()
        ]);
    }
}

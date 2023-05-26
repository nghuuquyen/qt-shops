<?php

namespace App\Http\Controllers;

use App\Datasets\ProductDataset;
use App\Services\CartService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index(ProductDataset $dataset, CartService $cart)
    {
        return view('checkout', [
            'cart' => $cart->getCart(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'full_name' => 'required|string',
            'phone_number' => 'required|numeric',
            'email' => 'required|email',
            'shipping_address' => 'required',
            'coupon_code' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        dd($validated);
    }
}

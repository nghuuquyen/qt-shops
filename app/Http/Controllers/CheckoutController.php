<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Services\CartService;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\RedirectResponse;

class CheckoutController extends Controller
{
    public function index(CartService $cart)
    {
        return view('checkout', [
            'cart' => $cart->getCart(),
        ]);
    }

    public function store(Request $request, CartService $cart): RedirectResponse
    {
        $validated = $request->validate([
            'full_name' => 'required|string',
            'phone_number' => 'required|numeric',
            'email' => 'required|email',
            'shipping_address' => 'required',
            'coupon_code' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $order = $cart->getCart()->order()->save(
            Order::factory()->make(
                array_merge($validated, [ 'code' => fake()->numerify('OR-######') ])
            )
        );

        return redirect(URL::signedRoute('orders.complete', [ 'order' => $order->id ]));
    }
}

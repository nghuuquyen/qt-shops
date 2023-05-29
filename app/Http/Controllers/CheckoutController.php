<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Services\CartService;
use App\Notifications\OrderCreated;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Notification;

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
            'phone_number' => 'required|string',
            'email' => 'required|email',
            'shipping_address' => 'required',
            'coupon_code' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $order = $cart->getCart()->order()->save(
            Order::factory()->make($validated)
        );

        Notification::route('mail', [ $order->email => $order->full_name ])
            ->notify(new OrderCreated($order));

        return redirect(URL::signedRoute('orders.complete', [ 'order' => $order->id ]));
    }
}

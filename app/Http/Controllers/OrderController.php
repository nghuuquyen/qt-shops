<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Order::class);

        return view('orders.index');
    }

    public function show(Request $request, Order $order)
    {
        if (! $request->hasValidSignature()) {
            abort(401);
        }

        $this->authorize('view', $order);

        $layout = 'layouts.user';

        return view('orders.show', compact('order', 'layout'));
    }

    public function downloadPdf(Request $request, Order $order)
    {
        if (! $request->hasValidSignature()) {
            abort(401);
        }

        $this->authorize('view', $order);

        $layout = 'layouts.print';

        return view('orders.show', compact('order', 'layout'));
    }
}

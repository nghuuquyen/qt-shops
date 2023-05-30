<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class OrderController extends Controller
{
    public function show(Request $request, Order $order)
    {
        if (! $request->hasValidSignature()) {
            abort(401);
        }

        $layout = 'layouts.base';

        return view('orders.show', compact('order', 'layout'));
    }

    public function downloadPdf(Request $request, Order $order)
    {
        if (! $request->hasValidSignature()) {
            abort(401);
        }

        $layout = 'layouts.print';

        return view('orders.show', compact('order', 'layout'));
    }
}

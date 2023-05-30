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

        return view('orders.show', compact('order'));
    }

    public function downloadPdf(Order $order)
    {
        $file = $order->exportPdf();

        return $file;
    }
}

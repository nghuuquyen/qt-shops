<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Datasets\ProductDataset;

class CheckoutController extends Controller
{
    public function index(ProductDataset $dataset) 
    {
        return view('checkout');
    }
}

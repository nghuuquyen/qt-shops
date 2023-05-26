<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Datasets\ProductDataset;

class HomepageController extends Controller
{

    public function index(ProductDataset $dataset) 
    {
        $categories = Category::query()->with('products')->get();
        
        return view('homepage', compact('categories'));
    }
}
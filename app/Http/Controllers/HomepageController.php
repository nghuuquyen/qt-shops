<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class HomepageController extends Controller
{
    public function index() 
    {   
        $categories = Category::query()->with('products')->get();
        
        return view('homepage', compact('categories'));
    }
}
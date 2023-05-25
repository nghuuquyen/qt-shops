<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Datasets\ProductDataset;

class HomepageController extends Controller
{

    public function index(ProductDataset $dataset) 
    {
        $categories = $dataset->getCategoeis()
                ->map(function ($category) use ($dataset) {

                    $category['products'] = $dataset->getProductsByCateogry($category);

                    return $category;
                });

        return view('homepage', compact('categories'));
    }
}

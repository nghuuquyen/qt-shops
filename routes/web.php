<?php

use App\Datasets\ProductDataset;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function (ProductDataset $dataset) {
    $categories = $dataset->getCategoeis()
                    ->map(function ($category) use ($dataset) {

                        $category['products'] = $dataset->getProductsByCateogry($category);

                        return $category;
                    });

    return view('welcome', compact('categories'));
});

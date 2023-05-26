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

/**
 * Homepage
 */
Route::get('/', [ \App\Http\Controllers\HomepageController::class, 'index' ])->name('homepage');

/**
 * Checkout
 */
Route::get('/checkout', [ \App\Http\Controllers\CheckoutController::class, 'index' ])->name('checkout.index');
Route::post('/checkout', [ \App\Http\Controllers\CheckoutController::class, 'store' ])->name('checkout.store');
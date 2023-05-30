<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\OrderCompleteController;

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
 * General
 */
Route::get('/', [ HomepageController::class, 'index' ])->name('homepage');
Route::get('/order-complete/{order}', OrderCompleteController::class)->name('orders.complete');

/**
 * Checkout
 */
Route::get('/checkout',  [ CheckoutController::class, 'index' ])->name('checkout.index');
Route::post('/checkout', [ CheckoutController::class, 'store' ])->name('checkout.store');

/**
 * Order
 */
Route::get('/orders/{order}', [ OrderController::class, 'show' ])->name('orders.show');
Route::get('/orders/{order}/download-pdf', [ OrderController::class, 'downloadPdf' ])->name('orders.downloadPdf');
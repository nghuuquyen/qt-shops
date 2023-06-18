<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\ReportFileController;
use App\Http\Controllers\OrderCompleteController;
use App\Http\Controllers\GenerateReportFileController;

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
Route::get('/', [HomepageController::class, 'index'])->name('homepage');
Route::get('/order-complete/{order}', OrderCompleteController::class)->name('orders.complete');

/**
 * Checkout
 */
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

/**
 * Order
 */
Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
Route::get('/orders/{order}/download-pdf', [OrderController::class, 'downloadPdf'])->name('orders.downloadPdf');

/**
 * Admin
 */
Route::group(['prefix' => '/admin'], function () {
    Route::singleton('profile', ProfileController::class);

    Route::resource('products', ProductController::class);

    Route::resource('orders', OrderController::class)->only(['index', 'show']);

    Route::resource('customers', CustomerController::class)->only(['index', 'show']);

    Route::resource('reports', ReportController::class);

    Route::resource('reports.report-files', ReportFileController::class);
});

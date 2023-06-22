<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportFileController;
use App\Http\Controllers\OrderCompleteController;
use App\Http\Controllers\SaleDashboardController;

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
 * User
 */
Route::get('/', [HomepageController::class, 'index'])->name('homepage');
Route::get('/order-complete/{order}', OrderCompleteController::class)->name('orders.complete');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/checkout/{order}', [CheckoutController::class, 'show'])->name('checkout.show');

/**
 * Admin
 */
Route::group(['prefix' => '/admin', 'middleware' => 'auth'], function () {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::singleton('profile', ProfileController::class);

    Route::resource('products', ProductController::class);

    Route::resource('orders', OrderController::class)->only(['index', 'show']);

    Route::resource('customers', CustomerController::class)->only(['index']);

    Route::resource('reports', ReportController::class);

    Route::resource('reports.report-files', ReportFileController::class)->only(['store', 'show']);

    Route::resource('roles', RoleController::class);
});

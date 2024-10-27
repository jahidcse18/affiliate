<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AffiliateController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RefundController;
use App\Http\Controllers\Admin\CommissionRateController;
use App\Http\Controllers\ProductController;

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


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route for generating affiliate link


    // Route for placing an order
    Route::post('/place-order', [OrderController::class, 'placeOrder'])->name('place.order');

    Route::get('/shop', [OrderController::class, 'showShop'])->name('shop');

    Route::get('/ref/{unique_code}', [AffiliateController::class, 'handleAffiliateLink'])->name('affiliate.link');


    // Route for processing a refund
    Route::post('/refund/{orderId}', [RefundController::class, 'processRefund'])->name('process.refund');

    // Admin route for setting commission rates
    Route::post('/admin/commission-rate', [CommissionRateController::class, 'store'])->name('admin.commission.rate.store');

    Route::get('/admin/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/admin/products', [ProductController::class, 'store'])->name('admin.products.store');
});


// Admin routes (only accessible by authenticated admin)
//Route::middleware(['auth'])->group(function () {
//    Route::get('/generate-link', [AffiliateController::class, 'generateReferralLink'])->name('generate.link');
//});

// Routes for admin to generate affiliate links for users
Route::middleware(['auth'])->group(function () {
    Route::get('/generate-link', [AffiliateController::class, 'showGenerateLinkForm'])->name('admin.generate.link.form');
    Route::post('/generate-link', [AffiliateController::class, 'generateReferralLink'])->name('admin.generate.link');
});





// User routes
Route::get('/order', [OrderController::class, 'showOrderPage'])->name('order.page');
Route::post('/order', [OrderController::class, 'placeOrder'])->name('order.place');


require __DIR__.'/auth.php';

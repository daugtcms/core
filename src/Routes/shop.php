<?php

use Illuminate\Support\Facades\Route;
use Sitebrew\Controllers\Shop\CartController;
use Sitebrew\Controllers\Shop\CheckoutController;
use Sitebrew\Controllers\Shop\ShopIndexController;
use Sitebrew\Controllers\Shop\ShowProductController;
use Sitebrew\Livewire\Shop\ProductTable;

Route::group(['middleware' => ['web', 'can:access admin panel'], 'prefix' => 'admin/shop', 'as' => 'admin.shop.'], function () {
    Route::get('/', function () {
        return redirect()->route('admin.shop.product.index');
    })->name('index');

    Route::get('/product', ProductTable::class)->name('product.index');

    Route::get('/order', \Sitebrew\Controllers\Admin\Shop\ShowOrdersController::class)->name('orders.index');

});

Route::stripeWebhooks('/shop/stripe/webhook');

Route::group(['middleware' => ['web']], function () {
    Route::get('/shop', ShopIndexController::class)->name('shop.index');
    Route::get('/shop/{slug}', ShowProductController::class)->name('shop.product.show');

    Route::get('cart/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::delete('cart/{product}', [CartController::class, 'remove'])->name('cart.remove');

    Route::get('checkout', [CheckoutController::class, 'checkout'])->name('checkout')->middleware(['auth', 'verified']);
});

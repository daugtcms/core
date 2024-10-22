<?php

use Daugt\Controllers\Admin\Shop\ShowOrdersController;
use Daugt\Livewire\Shop\EditProduct;
use Illuminate\Support\Facades\Route;
use Daugt\Controllers\Shop\CartController;
use Daugt\Controllers\Shop\CheckoutController;
use Daugt\Controllers\Shop\ShopIndexController;
use Daugt\Controllers\Shop\ShowProductController;
use Daugt\Livewire\Shop\ProductTable;

Route::group(['middleware' => ['web', 'can:access admin panel'], 'prefix' => 'admin/shop', 'as' => 'admin.shop.'], function () {
    Route::get('/', function () {
        return redirect()->route('daugt.admin.shop.product.index');
    })->name('index');

    Route::get('/product', ProductTable::class)->name('product.index');

    Route::get('/product/create', EditProduct::class)->name('product.create');
    Route::get('/product/{product}', EditProduct::class)->name('product.edit');

    Route::get('/order', ShowOrdersController::class)->name('orders.index');

});

if(function_exists('tenancy')) {
    Route::stripeWebhooks('/shop/stripe/webhook')->name('shop.stripe.webhook')->withoutMiddleware([
        'web',
        Stancl\Tenancy\Middleware\InitializeTenancyByDomain::class,
        Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains::class
    ]);
} else {
    Route::stripeWebhooks('/shop/stripe/webhook')->name('shop.stripe.webhook');
}

Route::group(['middleware' => ['web']], function () {
    Route::get('/shop', ShopIndexController::class)->name('shop.index');
    Route::get('/shop/{slug}', ShowProductController::class)->name('shop.product.show');

    Route::get('cart/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::delete('cart/{product}', [CartController::class, 'remove'])->name('cart.remove');

    Route::get('checkout', [CheckoutController::class, 'checkout'])->name('checkout')->middleware(['auth:tenant', 'verified']);
});

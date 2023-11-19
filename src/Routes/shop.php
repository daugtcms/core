<?php

use Illuminate\Support\Facades\Route;
use Sitebrew\Livewire\Shop\ProductTable;

Route::group(['middleware' => ['web', 'can:access admin panel'], 'prefix' => 'admin/shop', 'as' => 'admin.shop.'], function () {
    Route::get('/', function () {
        return redirect()->route('admin.shop.product.index');
    })->name('index');

    Route::get('/product', ProductTable::class)->name('product.index');
});
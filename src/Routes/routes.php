<?php

namespace Daugt;

use Illuminate\Support\Facades\Route;
use Daugt\Livewire\Listing\NavigationEditor;

Route::group(['middleware' => ['web'], 'as' => 'daugt.'], function () {
    Route::get('/admin', function () {
        return view('daugt::admin.index');
    })->name('admin.index')->middleware('can:access admin panel');

    Route::get('/admin/homepage', function() {
        return redirect()->to('/');
    })->name('admin.homepage.index')->middleware('can:access admin panel');

    require __DIR__ . '/auth.php';
    require __DIR__ . '/blocks.php';
    require __DIR__ . '/listing.php';
    require __DIR__ . '/media.php';
    require __DIR__ . '/users.php';
    require __DIR__ . '/shop.php';
    require __DIR__ . '/member-area.php';
    require __DIR__ . '/analytics.php';

    // !!! always leave this at the end, because it has a catch-all route for content
    require __DIR__ . '/content.php';
});

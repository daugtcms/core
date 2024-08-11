<?php

namespace Daugt;

use Illuminate\Support\Facades\Route;
use Daugt\Livewire\Listing\NavigationEditor;

Route::group(['middleware' => ['web']], function () {
    Route::get('/admin', function () {
        return view('daugt::admin.index');
    })->name('admin.index')->middleware('can:access admin panel');

    Route::get('/admin/homepage', function() {
        return redirect()->to('/');
    })->name('admin.homepage.index')->middleware('can:access admin panel');

    require __DIR__.'/Routes/auth.php';
    require __DIR__.'/Routes/blocks.php';
    require __DIR__ . '/Routes/listing.php';
    require __DIR__.'/Routes/media.php';
    require __DIR__.'/Routes/users.php';
    require __DIR__.'/Routes/shop.php';
    require __DIR__.'/Routes/member-area.php';
    require __DIR__ . '/Routes/content.php';
});

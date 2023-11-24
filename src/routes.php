<?php

namespace Sitebrew;

use Illuminate\Support\Facades\Route;
use Sitebrew\Livewire\Listing\NavigationEditor;

Route::group(['middleware' => ['web']], function () {
    Route::get('/admin', function () {
        return view('sitebrew::admin.index');
    })->name('admin.index')->middleware('can:access admin panel');

    require __DIR__.'/Routes/auth.php';
    require __DIR__.'/Routes/blocks.php';
    require __DIR__ . '/Routes/listing.php';
    require __DIR__.'/Routes/media.php';
    require __DIR__.'/Routes/users.php';
    require __DIR__.'/Routes/shop.php';
    require __DIR__.'/Routes/member-area.php';
    require __DIR__ . '/Routes/content.php';
});

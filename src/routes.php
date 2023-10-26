<?php

namespace Sitebrew;

use Illuminate\Support\Facades\Route;
use Sitebrew\Livewire\Navigation\NavigationEditor;

Route::group(['middleware' => ['web']], function () {
    Route::get('/admin', function () {
        return view('sitebrew::admin.index');
    })->name('admin.index');

    require __DIR__.'/Routes/auth.php';
    require __DIR__.'/Routes/blocks.php';
    require __DIR__.'/Routes/navigation.php';
    require __DIR__.'/Routes/pages.php';
});

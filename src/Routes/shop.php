<?php

use Illuminate\Support\Facades\Route;
use Sitebrew\Livewire\Media\MediaManager;
use Sitebrew\Livewire\Navigation\NavigationEditor;

Route::group(['middleware' => ['web', 'can:access admin panel'], 'prefix' => 'admin/shop', 'as' => 'admin.shop.'], function () {
    Route::get('/', MediaManager::class)->name('index');
});

<?php

use Illuminate\Support\Facades\Route;
use Sitebrew\Livewire\Media\MediaManager;
use Sitebrew\Livewire\Listing\NavigationEditor;

Route::group(['middleware' => ['web', 'can:access admin panel'], 'prefix' => 'admin/media', 'as' => 'admin.media.'], function () {
    Route::get('/', MediaManager::class)->name('index');
});

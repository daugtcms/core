<?php

use Illuminate\Support\Facades\Route;
use Sitebrew\Livewire\Media\MediaManager;
use Sitebrew\Livewire\Navigation\NavigationEditor;

Route::group(['middleware' => ['web'], 'prefix' => 'admin/media', 'as' => 'admin.media.'], function () {
    Route::get('/', MediaManager::class)->name('index');
});

<?php

use Illuminate\Support\Facades\Route;
use Sitebrew\Livewire\Media\MediaManager;
use Sitebrew\Livewire\Listing\NavigationEditor;

Route::group(['middleware' => ['web', 'verified'], 'prefix' => 'access', 'as' => 'member-area.'], function () {
    Route::get('/', \Sitebrew\Livewire\MemberArea\Dashboard::class)->name('index');
});

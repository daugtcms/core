<?php

use Illuminate\Support\Facades\Route;
use Sitebrew\Controllers\MemberArea\ShowPostController;
use Sitebrew\Livewire\Media\MediaManager;
use Sitebrew\Livewire\Listing\NavigationEditor;
use Sitebrew\Livewire\MemberArea\Dashboard;

Route::group(['middleware' => ['web', 'verified'], 'prefix' => 'access', 'as' => 'member-area.'], function () {
    Route::get('/', Dashboard::class)->name('index');
    Route::get('/post/{slug}', ShowPostController::class)->name('post.show');
});
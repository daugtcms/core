<?php

use Sitebrew\Controllers\Admin\Content\DeleteContentController;
use Sitebrew\Controllers\Admin\Content\ShowContentsController;
use Sitebrew\Controllers\Pages\ShowPageController;
use Illuminate\Support\Facades\Route;
use Sitebrew\Livewire\Content\ContentTable;

Route::group(['middleware' => ['web', 'can:access admin panel'], 'prefix' => 'admin/content', 'as' => 'admin.content.'], function () {
    Route::get('/', ContentTable::class)->name('index');
    Route::delete('/{page}', DeleteContentController::class);
});

Route::get('/{slug}', ShowPageController::class)->name('contents.index');

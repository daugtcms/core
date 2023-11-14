<?php

use Sitebrew\Controllers\Admin\Pages\DeletePageController;
use Sitebrew\Controllers\Admin\Pages\ShowPagesController;
use Sitebrew\Controllers\Pages\ShowPageController;
use Sitebrew\Livewire\Pages\PageEditor;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'can:access admin panel'], 'prefix' => 'admin/content', 'as' => 'admin.content.'], function () {
    Route::get('/', ShowPagesController::class)->name('index');
    Route::delete('/{page}', DeletePageController::class);
    Route::get('/{page}', PageEditor::class);
});

Route::get('/{slug}', ShowPageController::class)->name('pages.index');

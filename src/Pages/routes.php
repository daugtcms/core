<?php

use Sitebrew\Livewire\Pages\PageEditor;
use Sitebrew\Pages\Controllers\Admin\DeletePageController;
use Sitebrew\Pages\Controllers\Admin\ShowPagesController;
use Sitebrew\Pages\Controllers\ShowPageController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web'], 'prefix' => 'admin/pages', 'as' => 'admin.pages.'], function () {
    Route::get('/', ShowPagesController::class)->name('index');
    Route::delete('/{page}', DeletePageController::class);
    Route::get('/{page}', PageEditor::class);
});

Route::get('/{slug}', ShowPageController::class)->name('pages.index');

<?php

use Felixbeer\SiteCore\Livewire\Pages\PageEditor;
use Felixbeer\SiteCore\Pages\Controllers\Admin\DeletePageController;
use Felixbeer\SiteCore\Pages\Controllers\Admin\ShowPagesController;
use Felixbeer\SiteCore\Pages\Controllers\ShowPageController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web'], 'prefix' => 'admin/pages', 'as' => 'admin.pages.'], function () {
    Route::get('/', ShowPagesController::class)->name('index');
    Route::delete('/{page}', DeletePageController::class);
    Route::get('/{page}', PageEditor::class);
});

Route::get('/{slug}', ShowPageController::class)->name('pages.index');

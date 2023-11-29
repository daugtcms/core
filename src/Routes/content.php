<?php

use Sitebrew\Controllers\Admin\Content\DeleteContentController;
use Sitebrew\Controllers\Content\BlogIndexController;
use Sitebrew\Controllers\Content\ShowBlogController;
use Sitebrew\Controllers\Content\ShowPageController;
use Illuminate\Support\Facades\Route;
use Sitebrew\Livewire\Content\ContentTable;

Route::group(['middleware' => ['web', 'can:access admin panel'], 'prefix' => 'admin/content', 'as' => 'admin.content.'], function () {
    Route::get('/', ContentTable::class)->name('index');
    Route::delete('/{page}', DeleteContentController::class);
});

Route::group(['middleware' => ['web']], function () {
    Route::get('/', ShowPageController::class)->name('content.pages.index');
    Route::get('/blog', BlogIndexController::class)->name('content.blog.index');
    Route::get('/{slug}', ShowPageController::class)->name('content.pages.index');
    Route::get('/blog/{slug}', ShowBlogController::class)->name('content.blog.show');
});

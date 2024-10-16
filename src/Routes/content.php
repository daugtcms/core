<?php

use Daugt\Controllers\Admin\Content\DeleteContentController;
use Daugt\Controllers\Content\BlogIndexController;
use Daugt\Controllers\Content\ShowBlogController;
use Daugt\Controllers\Content\ShowContentController;
use Daugt\Livewire\Content\EditContent;
use Illuminate\Support\Facades\Route;
use Daugt\Livewire\Content\ContentTable;

Route::group(['middleware' => ['web', 'can:access admin panel'], 'prefix' => 'admin/content', 'as' => 'admin.content.'], function () {
    Route::get('/', ContentTable::class)->name('index');
    Route::get('/create', EditContent::class)->name('create');
    Route::get('/{content:id}', EditContent::class)->name('edit');
    Route::delete('/{page}', DeleteContentController::class);
});

Route::group(['middleware' => ['web']], function () {
    Route::get('/{first?}/{second?}', ShowContentController::class)->name('content.show');
});

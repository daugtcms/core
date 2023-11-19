<?php

use Sitebrew\Controllers\Admin\Content\DeleteContentController;
use Sitebrew\Controllers\Admin\Content\ShowContentsController;
use Sitebrew\Controllers\Pages\ShowPageController;
use Illuminate\Support\Facades\Route;
use Sitebrew\Livewire\Content\ContentTable;
use Sitebrew\Livewire\Content\CoursesTable;

Route::group(['middleware' => ['web', 'can:access admin panel'], 'prefix' => 'admin/content', 'as' => 'admin.content.'], function () {
    Route::get('/', ContentTable::class)->name('index');
    Route::delete('/{page}', DeleteContentController::class);
});

Route::group(['middleware' => ['web', 'can:access admin panel'], 'prefix' => 'admin/structure/courses', 'as' => 'admin.structure.courses.'], function () {
    Route::get('/', CoursesTable::class)->name('index');
    Route::delete('/{page}', DeleteContentController::class);
});

Route::get('/', ShowPageController::class)->name('contents.index');
Route::get('/{slug}', ShowPageController::class)->name('contents.index');

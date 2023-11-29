<?php

use Illuminate\Support\Facades\Route;
use Sitebrew\Controllers\MemberArea\ShowCourseController;
use Sitebrew\Controllers\MemberArea\ShowOrdersController;
use Sitebrew\Controllers\MemberArea\ShowPostController;
use Sitebrew\Livewire\Media\MediaManager;
use Sitebrew\Livewire\Listing\NavigationEditor;
use Sitebrew\Livewire\MemberArea\CoursePosts;
use Sitebrew\Livewire\MemberArea\Dashboard;

Route::group(['middleware' => ['web', 'verified'], 'prefix' => 'access', 'as' => 'member-area.'], function () {
    Route::get('/', Dashboard::class)->name('index');
    Route::get('/post/{slug}', ShowPostController::class)->name('post.show');

    Route::get('/course/{course}/{section}', ShowCourseController::class)->name('course.show');

    Route::get('/orders', ShowOrdersController::class)->name('orders.index');
});
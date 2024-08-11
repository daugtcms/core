<?php

use Illuminate\Support\Facades\Route;
use Daugt\Controllers\MemberArea\ShowCourseController;
use Daugt\Controllers\MemberArea\ShowOrdersController;
use Daugt\Controllers\MemberArea\ShowPostController;
use Daugt\Livewire\Media\MediaManager;
use Daugt\Livewire\Listing\NavigationEditor;
use Daugt\Livewire\MemberArea\CoursePosts;
use Daugt\Livewire\MemberArea\Dashboard;

Route::group(['middleware' => ['web', 'verified'], 'prefix' => 'access', 'as' => 'member-area.'], function () {
    Route::get('/', Dashboard::class)->name('index');
    Route::get('/post/{slug}', ShowPostController::class)->name('post.show');

    Route::get('/course/{course}/{section}', ShowCourseController::class)->name('course.show');

    Route::get('/orders', ShowOrdersController::class)->name('orders.index');
});
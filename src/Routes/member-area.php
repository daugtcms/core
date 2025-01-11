<?php

use Daugt\Controllers\MemberArea\CreateCourseCommentController;
use Illuminate\Support\Facades\Route;
use Daugt\Controllers\MemberArea\ShowCourseController;
use Daugt\Controllers\MemberArea\ShowOrdersController;
use Daugt\Livewire\MemberArea\Dashboard;

Route::group(['middleware' => ['web', 'verified:daugt.verification.notice'], 'prefix' => 'access', 'as' => 'member-area.'], function () {
    Route::get('/', Dashboard::class)->name('index');

    Route::get('/course/{course}/{section}', ShowCourseController::class)->name('course.show');

    Route::get('/course/{course}/{section}', ShowCourseController::class)->name('course.show');

    Route::post('/course/{course}/{section}/comment/create', CreateCourseCommentController::class)->name('course.comments.create');

    Route::get('/orders', ShowOrdersController::class)->name('orders.index');
});
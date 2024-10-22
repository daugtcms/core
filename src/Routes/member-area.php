<?php

use Illuminate\Support\Facades\Route;
use Daugt\Controllers\MemberArea\ShowCourseController;
use Daugt\Controllers\MemberArea\ShowOrdersController;
use Daugt\Livewire\MemberArea\Dashboard;

Route::group(['middleware' => ['web', 'verified'], 'prefix' => 'access', 'as' => 'member-area.'], function () {
    Route::get('/', Dashboard::class)->name('index');

    Route::get('/course/{course}/{section}', ShowCourseController::class)->name('course.show');

    Route::get('/orders', ShowOrdersController::class)->name('orders.index');
});
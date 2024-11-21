<?php

use Daugt\Livewire\Analytics\VisitorAnalytics;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'can:access admin panel'], 'prefix' => 'admin/analytics', 'as' => 'admin.analytics.'], function () {
    Route::get('/', VisitorAnalytics::class)->name('index');
});

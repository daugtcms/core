<?php

use Sitebrew\Controllers\Pages\ShowPageController;
use Illuminate\Support\Facades\Route;
use Sitebrew\Livewire\Users\UserTable;

Route::group(['middleware' => ['web', 'can:access admin panel'], 'prefix' => 'admin/users', 'as' => 'admin.users.'], function () {
    Route::get('/', UserTable::class)->name('index');
    // Route::delete('/{page}', DeleteContentController::class);
});
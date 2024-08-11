<?php

use Illuminate\Support\Facades\Route;
use Daugt\Livewire\Users\UserTable;

Route::group(['middleware' => ['web', 'can:access admin panel'], 'prefix' => 'admin/users', 'as' => 'admin.users.'], function () {
    Route::get('/', UserTable::class)->name('index');
    // Route::delete('/{page}', DeleteContentController::class);
});

Route::group(['middleware' => ['web']], function () {
    Route::impersonate();
});
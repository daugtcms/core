<?php

use Illuminate\Support\Facades\Route;
use Sitebrew\Livewire\Listing\ListingEditor;

Route::group(['middleware' => ['web', 'can:access admin panel'], 'prefix' => 'admin/structure', 'as' => 'admin.structure.'], function () {
    Route::get('/', function () {
        return redirect()->route('admin.structure.listing');
    })->name('index');

    Route::get('/listing', ListingEditor::class)->name('listing');
});

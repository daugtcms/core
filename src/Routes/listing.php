<?php

use Illuminate\Support\Facades\Route;
use Daugt\Livewire\Listing\ListingEditor;

Route::group(['middleware' => ['web', 'can:access admin panel'], 'prefix' => 'admin/structure', 'as' => 'admin.structure.'], function () {
    Route::get('/', function () {
        return redirect()->route('daugt.admin.structure.listing');
    })->name('index');

    Route::get('/listing', ListingEditor::class)->name('listing');
});

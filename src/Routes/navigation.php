<?php

use Illuminate\Support\Facades\Route;
use Sitebrew\Livewire\Navigation\NavigationEditor;

Route::group(['middleware' => ['web'], 'prefix' => 'admin/structure', 'as' => 'admin.structure.'], function () {
    Route::get('/', function () {
        return redirect()->route('admin.structure.navigation');
    })->name('index');

    Route::get('/navigation', NavigationEditor::class)->name('navigation');
});

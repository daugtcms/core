<?php

use Daugt\Livewire\Blocks\BlockDefaultsEditor;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'can:access admin panel'], 'prefix' => 'admin/structure', 'as' => 'admin.structure.'], function () {
    Route::get('/block-defaults', BlockDefaultsEditor::class)->name('block-defaults');
});

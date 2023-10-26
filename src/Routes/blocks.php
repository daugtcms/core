<?php

use Illuminate\Support\Facades\Route;
use Sitebrew\Livewire\Blocks\TemplateEditor;

Route::group(['middleware' => ['web'], 'prefix' => 'admin/structure', 'as' => 'admin.structure.'], function () {
    Route::get('/templates', TemplateEditor::class)->name('templates');
});

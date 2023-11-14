<?php

use Illuminate\Support\Facades\Route;
use Sitebrew\Livewire\Blocks\TemplateEditor;

Route::group(['middleware' => ['web', 'can:access admin panel'], 'prefix' => 'admin/structure', 'as' => 'admin.structure.'], function () {
    Route::get('/templates', TemplateEditor::class)->name('templates');
});

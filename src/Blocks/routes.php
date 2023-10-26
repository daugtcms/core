<?php

use Sitebrew\Livewire\Blocks\TemplateEditor;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web']], function () {
    Route::get('/template-editor', TemplateEditor::class);
});

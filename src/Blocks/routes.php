<?php

use Felixbeer\SiteCore\Livewire\Blocks\BlockEditor;
use Felixbeer\SiteCore\Livewire\Blocks\TemplateEditor;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web']], function () {
    Route::get('/block-editor', BlockEditor::class);
});

Route::group(['middleware' => ['web']], function () {
    Route::get('/template-editor', TemplateEditor::class);
});

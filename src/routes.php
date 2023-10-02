<?php

use Felixbeer\SiteCore\Livewire\BlockEditor;
use Felixbeer\SiteCore\Livewire\NavigationEditor;

Route::group(['middleware' => ['web']], function () {
    Route::get('/navigation-editor', NavigationEditor::class);
});

Route::group(['middleware' => ['web']], function () {
    Route::get('/block-editor', BlockEditor::class);
});

require __DIR__.'/Auth/routes.php';
require __DIR__.'/Page/routes.php';

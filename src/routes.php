<?php

use Felixbeer\SiteCore\Livewire\Navigation\NavigationEditor;

Route::group(['middleware' => ['web']], function () {
    Route::get('/navigation-editor', NavigationEditor::class);
});

require __DIR__ . '/Auth/routes.php';
require __DIR__ . '/Blocks/routes.php';

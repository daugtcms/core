<?php

use Felixbeer\SiteCore\Livewire\NavigationEditor;

Route::group(['middleware' => ['web']], function () {
    Route::get('/navigation-editor', NavigationEditor::class);
});

require __DIR__.'/Auth/routes.php';
require __DIR__.'/Page/routes.php';

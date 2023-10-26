<?php

use Sitebrew\Livewire\Navigation\NavigationEditor;

Route::group(['middleware' => ['web'], 'as' => 'sitebrew.'], function () {
    Route::get('/navigation-editor', NavigationEditor::class);

    require __DIR__.'/Auth/routes.php';
    require __DIR__.'/Blocks/routes.php';
    require __DIR__.'/Pages/routes.php';
});

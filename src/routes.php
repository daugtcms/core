<?php

namespace Sitebrew;

use Illuminate\Support\Facades\Route;
use Sitebrew\Livewire\Navigation\NavigationEditor;

Route::group(['middleware' => ['web']], function () {
    Route::get('/navigation-editor', NavigationEditor::class);

    require __DIR__.'/Routes/auth.php';
    require __DIR__.'/Routes/blocks.php';
    require __DIR__.'/Routes/pages.php';
});

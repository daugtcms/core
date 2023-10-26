<?php

namespace Sitebrew\Pages\Controllers;

use Sitebrew\Core\Controllers\Controller;
use Sitebrew\Pages\Models\Page;

class ShowPageController extends Controller
{
    public function __invoke($slug)
    {
        $page = Page::findBySlug($slug);

        return view('sitebrew::pages.index', compact('page'));
    }
}

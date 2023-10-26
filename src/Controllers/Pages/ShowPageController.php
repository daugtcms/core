<?php

namespace Sitebrew\Controllers\Pages;

use Sitebrew\Controllers\Controller;
use Sitebrew\Pages\Models\Page;

class ShowPageController extends Controller
{
    public function __invoke($slug)
    {
        $page = Page::findBySlug($slug);

        return view('sitebrew::pages.index', compact('page'));
    }
}

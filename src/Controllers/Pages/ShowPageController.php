<?php

namespace Sitebrew\Controllers\Pages;

use Sitebrew\Controllers\Controller;
use Sitebrew\Models\Content\Content;

class ShowPageController extends Controller
{
    public function __invoke($slug)
    {
        $page = Content::findBySlug($slug);

        return view('sitebrew::pages.index', compact('page'));
    }
}

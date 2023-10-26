<?php

namespace Felixbeer\SiteCore\Pages\Controllers;

use Felixbeer\SiteCore\Core\Controllers\Controller;
use Felixbeer\SiteCore\Pages\Models\Page;

class ShowPageController extends Controller
{
    public function __invoke($slug)
    {
        $page = Page::findBySlug($slug);

        return view('site-core::pages.index', compact('page'));
    }
}

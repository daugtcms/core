<?php

namespace Sitebrew\Controllers\Pages;

use Sitebrew\Controllers\Controller;
use Sitebrew\Enums\Blocks\TemplateUsage;
use Sitebrew\Models\Content\Content;

class ShowPageController extends Controller
{
    public function __invoke($slug = null)
    {

        $query = Content::where('type', 'page');

        if ($slug) {
            $query->where('slug', $slug);
        } else {
            $query->whereNull('slug')->orWhere('slug', '');
        }
        $page = $query->first();
        return view('sitebrew::pages.index', compact('page'));
    }
}

<?php

namespace Sitebrew\Controllers\Content;

use Sitebrew\Controllers\Controller;
use Sitebrew\Enums\Blocks\TemplateUsage;
use Sitebrew\Models\Content\Content;

class ShowPageController extends Controller
{
    public function __invoke($slug = null)
    {

        $query = Content::where('type', 'page')->where('enabled', true);

        if ($slug) {
            $query->where('slug', $slug);
        } else {
            $query->whereNull('slug')->orWhere('slug', '');
        }
        $page = $query->firstOrFail();
        return view('sitebrew::pages.index', compact('page'));
    }
}

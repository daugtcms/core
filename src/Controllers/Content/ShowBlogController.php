<?php

namespace Sitebrew\Controllers\Content;

use Sitebrew\Controllers\Controller;
use Sitebrew\Enums\Blocks\TemplateUsage;
use Sitebrew\Enums\Listing\ListingUsage;
use Sitebrew\Models\Content\Content;

class ShowBlogController extends Controller
{
    public function __invoke($slug = null)
    {

        $query = Content::where('type', 'blog')->where('enabled', true);

        if ($slug) {
            $query->where('slug', $slug);
        } else {
            $query->whereNull('slug')->orWhere('slug', '');
        }

        $page = $query->first();
        return view('sitebrew::pages.index', compact('page'));
    }
}

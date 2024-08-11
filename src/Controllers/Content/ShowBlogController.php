<?php

namespace Daugt\Controllers\Content;

use Daugt\Controllers\Controller;
use Daugt\Enums\Blocks\TemplateUsage;
use Daugt\Enums\Listing\ListingUsage;
use Daugt\Models\Content\Content;

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
        return view('daugt::pages.index', compact('page'));
    }
}

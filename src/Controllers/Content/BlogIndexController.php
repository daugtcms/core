<?php

namespace Sitebrew\Controllers\Content;

use Sitebrew\Controllers\Controller;
use Sitebrew\Enums\Blocks\TemplateUsage;
use Sitebrew\Enums\Listing\ListingUsage;
use Sitebrew\Models\Content\Content;

class BlogIndexController extends Controller
{
    public function __invoke($category = null)
    {

        $query = Content::where('type', 'blog')->where('enabled', true);

        $posts = $query->get();
        return view('sitebrew::content.blog.index', compact('posts'));
    }
}

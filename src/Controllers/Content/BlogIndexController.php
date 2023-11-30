<?php

namespace Sitebrew\Controllers\Content;

use Sitebrew\Controllers\Controller;
use Sitebrew\Enums\Blocks\TemplateUsage;
use Sitebrew\Enums\Listing\ListingUsage;
use Sitebrew\Models\Content\Content;
use Sitebrew\Models\Listing\ListingItem;

class BlogIndexController extends Controller
{
    public function __invoke()
    {

        $query = Content::where('type', 'blog')->where('published_at', '<=', now())->orderBy('published_at', 'DESC')->where('enabled', true);

        if(request()->query('category')) {
            $category = ListingItem::where('slug', request()->query('category'))->firstOrFail();
            $query->where('blocks->template->attributes->category', $category->id);
        }
        $posts = $query->get();
        return view('sitebrew::content.blog.index', compact('posts'));
    }
}

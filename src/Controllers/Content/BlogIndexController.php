<?php

namespace Daugt\Controllers\Content;

use Daugt\Controllers\Controller;
use Daugt\Enums\Blocks\TemplateUsage;
use Daugt\Enums\Listing\ListingUsage;
use Daugt\Models\Content\Content;
use Daugt\Models\Listing\ListingItem;

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
        return view('daugt::content.blog.index', compact('posts'));
    }
}

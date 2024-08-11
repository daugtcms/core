<?php

namespace Daugt\Controllers\Content;

use Daugt\Controllers\Controller;
use Daugt\Enums\Blocks\TemplateUsage;
use Daugt\Models\Content\Content;

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
        return view('daugt::pages.index', compact('page'));
    }
}

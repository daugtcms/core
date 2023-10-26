<?php

namespace Felixbeer\SiteCore\Pages\Controllers\Admin;

use Felixbeer\SiteCore\Core\Controllers\Controller;
use Felixbeer\SiteCore\Pages\Models\Page;

class DeletePageController extends Controller
{
    public function __invoke(Page $page)
    {
        $page->delete();

        return redirect()->back();
    }
}

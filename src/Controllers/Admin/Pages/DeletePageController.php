<?php

namespace Sitebrew\Controllers\Admin\Pages;

use Sitebrew\Controllers\Controller;
use Sitebrew\Models\Pages\Page;

class DeletePageController extends Controller
{
    public function __invoke(Page $page)
    {
        $page->delete();

        return redirect()->back();
    }
}

<?php

namespace Sitebrew\Pages\Controllers\Admin;

use Sitebrew\Core\Controllers\Controller;
use Sitebrew\Pages\Models\Page;

class DeletePageController extends Controller
{
    public function __invoke(Page $page)
    {
        $page->delete();

        return redirect()->back();
    }
}

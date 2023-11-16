<?php

namespace Sitebrew\Controllers\Admin\Content;

use Sitebrew\Controllers\Controller;
use Sitebrew\Models\Content\Content;

class DeleteContentController extends Controller
{
    public function __invoke(Content $page)
    {
        $page->delete();

        return redirect()->back();
    }
}

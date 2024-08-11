<?php

namespace Daugt\Controllers\Admin\Content;

use Daugt\Controllers\Controller;
use Daugt\Models\Content\Content;

class DeleteContentController extends Controller
{
    public function __invoke(Content $page)
    {
        $page->delete();

        return redirect()->back();
    }
}

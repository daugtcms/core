<?php

namespace Sitebrew\Controllers\Admin\Content;

use Sitebrew\Controllers\Controller;

class ShowContentsController extends Controller
{
    public function __invoke()
    {
        return view('sitebrew::admin.contents.index');
    }
}

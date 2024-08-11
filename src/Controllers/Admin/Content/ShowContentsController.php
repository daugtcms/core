<?php

namespace Daugt\Controllers\Admin\Content;

use Daugt\Controllers\Controller;

class ShowContentsController extends Controller
{
    public function __invoke()
    {
        return view('daugt::admin.contents.index');
    }
}

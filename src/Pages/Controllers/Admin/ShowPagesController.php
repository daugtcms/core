<?php

namespace Felixbeer\SiteCore\Pages\Controllers\Admin;

use Felixbeer\SiteCore\Core\Controllers\Controller;

class ShowPagesController extends Controller
{
    public function __invoke()
    {
        return view('site-core::pages.admin.index');
    }
}

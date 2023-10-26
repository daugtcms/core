<?php

namespace Sitebrew\Controllers\Admin\Pages;

use Sitebrew\Controllers\Controller;

class ShowPagesController extends Controller
{
    public function __invoke()
    {
        return view('sitebrew::pages.admin.index');
    }
}

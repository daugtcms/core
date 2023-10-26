<?php

namespace Sitebrew\Pages\Controllers\Admin;

use Sitebrew\Core\Controllers\Controller;

class ShowPagesController extends Controller
{
    public function __invoke()
    {
        return view('sitebrew::pages.admin.index');
    }
}

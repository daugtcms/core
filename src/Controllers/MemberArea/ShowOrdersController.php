<?php

namespace Sitebrew\Controllers\MemberArea;

use Sitebrew\Controllers\Controller;
use Sitebrew\Models\Content\Content;

class ShowOrdersController extends Controller
{
    public function __invoke($slug = null)
    {
        return view('sitebrew::member-area.orders.index', [
        ]);
    }
}
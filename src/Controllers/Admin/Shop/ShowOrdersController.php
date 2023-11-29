<?php

namespace Sitebrew\Controllers\Admin\Shop;

use Sitebrew\Controllers\Controller;
use Sitebrew\Models\Content\Content;

class ShowOrdersController extends Controller
{
    public function __invoke()
    {
        return view('sitebrew::admin.shop.orders', [
        ]);
    }
}
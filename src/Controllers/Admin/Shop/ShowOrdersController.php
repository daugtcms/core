<?php

namespace Daugt\Controllers\Admin\Shop;

use Daugt\Controllers\Controller;
use Daugt\Models\Content\Content;

class ShowOrdersController extends Controller
{
    public function __invoke()
    {
        return view('daugt::admin.shop.orders', [
        ]);
    }
}
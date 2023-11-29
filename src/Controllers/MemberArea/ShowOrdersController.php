<?php

namespace Sitebrew\Controllers\MemberArea;

use Sitebrew\Controllers\Controller;
use Sitebrew\Models\Content\Content;

class ShowOrdersController extends Controller
{
    public function __invoke($slug = null)
    {
        if (request()->exists('success')) {
            request()->session()->forget('cart');
        }
        return view('sitebrew::member-area.orders.index', [
        ]);
    }
}
<?php

namespace Daugt\Controllers\MemberArea;

use Daugt\Controllers\Controller;
use Daugt\Models\Content\Content;

class ShowOrdersController extends Controller
{
    public function __invoke($slug = null)
    {
        if (request()->exists('success')) {
            request()->session()->forget('cart');
        }
        return view('daugt::member-area.orders.index', [
        ]);
    }
}
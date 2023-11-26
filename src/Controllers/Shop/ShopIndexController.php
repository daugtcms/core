<?php

namespace Sitebrew\Controllers\Shop;

use Sitebrew\Controllers\Controller;
use Sitebrew\Enums\Blocks\TemplateUsage;
use Sitebrew\Models\Content\Content;
use Sitebrew\Models\Shop\Product;

class ShopIndexController extends Controller
{
    public function __invoke()
    {

        $query = Product::where('enabled', true);

        if(request()->has('category')) {
          $query->whereHas('categories', function($q) {
            $q->where('slug', request()->get('category'));
          });
        }

        $products = $query->paginate(20);

        return view('sitebrew::shop.index', compact('products'));
    }
}

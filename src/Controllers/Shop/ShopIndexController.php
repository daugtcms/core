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

        $products = $query->orderBy('updated_at', 'DESC')->get();

        return view('sitebrew::shop.index', compact('products'));
    }
}

<?php

namespace Daugt\Controllers\Shop;

use Daugt\Controllers\Controller;
use Daugt\Enums\Blocks\TemplateUsage;
use Daugt\Models\Content\Content;
use Daugt\Models\Shop\Product;

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

        return view('daugt::shop.index', compact('products'));
    }
}

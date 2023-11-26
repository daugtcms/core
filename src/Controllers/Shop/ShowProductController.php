<?php

namespace Sitebrew\Controllers\Shop;

use Sitebrew\Controllers\Controller;
use Sitebrew\Enums\Blocks\TemplateUsage;
use Sitebrew\Models\Content\Content;
use Sitebrew\Models\Shop\Product;

class ShowProductController extends Controller
{
    public function __invoke($slug = null)
    {

        $query = Product::where('enabled', true);

        if ($slug) {
            $query->where('slug', $slug);
        } else {
            $query->whereNull('slug')->orWhere('slug', '');
        }
        $product = $query->firstOrFail();
        return view('sitebrew::shop.product.show', compact('product'));
    }
}

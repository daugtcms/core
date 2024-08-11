<?php

namespace Daugt\Controllers\Shop;

use Daugt\Controllers\Controller;
use Daugt\Enums\Blocks\TemplateUsage;
use Daugt\Models\Content\Content;
use Daugt\Models\Shop\Product;

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
        return view('daugt::shop.product.show', compact('product'));
    }
}

<?php

namespace Daugt\Controllers\Shop;

use Daugt\Controllers\Controller;
use Daugt\Enums\Blocks\TemplateUsage;
use Daugt\Models\Content\Content;
use Daugt\Models\Shop\Product;

class ShowProductController extends Controller
{
    public function __invoke($slug)
    {

        $query = Product::where('enabled', true);

        $query->where('slug', $slug);

        $product = $query->firstOrFail();
        return view('daugt::shop.product.show', compact('product'));
    }
}

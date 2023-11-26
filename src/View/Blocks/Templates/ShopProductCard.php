<?php

namespace Sitebrew\View\Blocks\Templates;

use Sitebrew\Models\Shop\Product;
use Sitebrew\View\Blocks\Block as SitebrewBlock;
use Sitebrew\Enums\Blocks\AttributeType;

class ShopProductCard extends SitebrewBlock
{
    public static array $metadata = [
        'viewName' => 'sitebrew::blocks.templates.shop-product-card',
        'attributes' => [
            'product' => [
                'type' => AttributeType::PRODUCT,
                'title' => 'Product',
                'readonly' => true,
            ],
        ],
    ];

    public function __construct(
        public int|Product $product = 0,
    ) {
        parent::__construct();
    }
}

<?php

namespace Daugt\View\Blocks\Templates;

use Daugt\Models\Shop\Product;
use Daugt\View\Blocks\Block as DaugtBlock;
use Daugt\Enums\Blocks\AttributeType;

class ShopProduct extends DaugtBlock
{
    public static array $metadata = [
        'viewName' => 'daugt::blocks.templates.shop-product',
        'attributes' => [
            'product' => [
                'type' => AttributeType::PRODUCT,
                'title' => 'Product',
                'readonly' => true,
            ],
        ],
    ];

    public function __construct(
        public ?int $product = null,
    ) {
        parent::__construct();
    }
}

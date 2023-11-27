<?php

namespace Sitebrew\View\Blocks;

use Sitebrew\Enums\Blocks\AttributeType;

class FeaturedShopCategory extends Block
{
    public static array $metadata = [
        'name' => 'Featured Shop Category',
        'description' => 'A section containing a list of shop products from a category',
        'viewName' => 'sitebrew::blocks.featured-shop-category',
        'attributes' => [
        ],
    ];

    public function __construct(
    ) {
        parent::__construct();
    }
}

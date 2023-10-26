<?php

namespace Sitebrew\Blocks\View\Blocks;

use Sitebrew\Blocks\AttributeType;

class FeaturedShopCategory extends Block
{
    public static array $metadata = [
        'name' => 'Featured Shop Category',
        'description' => 'A section containing a list of shop products from a category',
        'viewName' => 'sitebrew::blocks.featured-shop-category',
        'attributes' => [
            'title' => [
                'type' => AttributeType::TEXT,
                'title' => 'Title',
            ],
            'subtitle' => [
                'type' => AttributeType::TEXT,
                'title' => 'Subtitle',
            ],
        ],
    ];

    public function __construct(
        public string $title = '',
        public string $subtitle = '',
    ) {
        parent::__construct();
    }
}

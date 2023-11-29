<?php

namespace Sitebrew\View\Blocks;

use Sitebrew\Enums\Blocks\AttributeType;

class FeaturedBlogCategory extends Block
{
    public static array $metadata = [
        'name' => 'Featured Shop Category',
        'description' => 'A section containing a list of shop products from a category',
        'viewName' => 'sitebrew::blocks.featured-blog-category',
        'attributes' => [
            'category' => [
                'type' => AttributeType::BLOG_CATEGORY,
                'title' => 'Category',
            ],
        ],
    ];

    public function __construct(
        public int $category = 0,
    ) {
        parent::__construct();
    }
}

<?php

namespace Daugt\View\Blocks;

use Daugt\Enums\Blocks\AttributeType;

class FeaturedBlogCategory extends Block
{
    public static array $metadata = [
        'name' => 'Featured Shop Category',
        'description' => 'A section containing a list of shop products from a category',
        'viewName' => 'daugt::blocks.featured-blog-category',
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

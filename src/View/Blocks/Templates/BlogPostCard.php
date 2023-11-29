<?php

namespace Sitebrew\View\Blocks\Templates;

use Sitebrew\Models\Content\Content;
use Sitebrew\Models\Shop\Product;
use Sitebrew\View\Blocks\Block as SitebrewBlock;
use Sitebrew\Enums\Blocks\AttributeType;

class BlogPostCard extends SitebrewBlock
{
    public static array $metadata = [
        'viewName' => 'sitebrew::blocks.templates.blog-post-card',
        'attributes' => [
            'content' => [
                'type' => AttributeType::CONTENT,
                'title' => 'Content',
                'readonly' => true,
            ],
        ],
    ];

    public function __construct(
        public int|Content $content = 0,
    ) {
        parent::__construct();
    }
}

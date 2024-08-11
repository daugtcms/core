<?php

namespace Daugt\View\Blocks\Templates;

use Daugt\Models\Content\Content;
use Daugt\Models\Shop\Product;
use Daugt\View\Blocks\Block as DaugtBlock;
use Daugt\Enums\Blocks\AttributeType;

class BlogPostCard extends DaugtBlock
{
    public static array $metadata = [
        'viewName' => 'daugt::blocks.templates.blog-post-card',
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

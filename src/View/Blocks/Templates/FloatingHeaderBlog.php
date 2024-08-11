<?php

namespace Daugt\View\Blocks\Templates;

use Daugt\Data\Media\MediaPickerData;
use Daugt\View\Blocks\Block as DaugtBlock;
use Daugt\Enums\Blocks\AttributeType;

class FloatingHeaderBlog extends DaugtBlock
{
    public static array $metadata = [
        'viewName' => 'daugt::blocks.templates.floating-header-blog',
        'attributes' => [
            'title' => [
                'type' => AttributeType::TEXT,
                'title' => 'Title',
            ],
            'category' => [
                'type' => AttributeType::BLOG_CATEGORY,
                'title' => 'Category',
            ],
            'backgroundImage' => [
                'type' => AttributeType::MEDIA,
                'title' => 'Background Image',
            ],
            'author' => [
                'type' => AttributeType::USER,
                'title' => 'Author',
            ]
        ],
    ];

    public function __construct(
        public string $title = '',
        public int $category = 0,
        public array $backgroundImage = [],
        public int $author = 0,
    ) {
        parent::__construct();
    }
}

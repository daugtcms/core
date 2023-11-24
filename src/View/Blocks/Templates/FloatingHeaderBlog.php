<?php

namespace Sitebrew\View\Blocks\Templates;

use Sitebrew\Data\Media\MediaPickerData;
use Sitebrew\View\Blocks\Block as SitebrewBlock;
use Sitebrew\Enums\Blocks\AttributeType;

class FloatingHeaderBlog extends SitebrewBlock
{
    public static array $metadata = [
        'viewName' => 'sitebrew::blocks.templates.floating-header-blog',
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

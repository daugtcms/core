<?php

namespace Sitebrew\View\Blocks;

use Sitebrew\Enums\Blocks\AttributeType;

class FeaturedContent extends Block
{
    public static array $metadata = [
        'name' => 'Featured Content',
        'description' => 'A card with images, text and an action button',
        'viewName' => 'sitebrew::blocks.featured-content',
        'attributes' => [
            'title' => [
                'type' => AttributeType::TEXT,
                'title' => 'Title',
            ],
            'subtitle' => [
                'type' => AttributeType::TEXT,
                'title' => 'Subtitle',
            ],
            'text' => [
                'type' => AttributeType::TEXT,
                'title' => 'Text',
            ],
            'featuredImage' => [
                'type' => AttributeType::IMAGE,
                'title' => 'Featured Image',
            ],
            'link' => [
                'type' => AttributeType::TEXT,
                'title' => 'Link',
            ],
            'linkText' => [
                'type' => AttributeType::TEXT,
                'title' => 'Link Text',
            ],
        ],
    ];

    public function __construct(
        public string $title = '',
        public string $subtitle = '',
        public string $text = '',
        public array $featuredImage = [],
        public string $link = '',
        public string $linkText = ''
    ) {
        parent::__construct();
    }
}

<?php

use Sitebrew\Enums\Blocks\AttributeType;
use Sitebrew\Enums\Content\ContentGroup;

return [
    'page' => [
        'name' => 'Page',
        'group' => ContentGroup::MARKETING,
        'categorized' => false,
        'listable' => false,
        'attributes' => [
            'title' => [
                'type' => AttributeType::TEXT,
                'name' => 'Title',
            ],
        ],
    ],
    'blog' => [
        'name' => 'Blog',
        'group' => ContentGroup::CONTENT,
        'categorized' => true,
        'listable' => true,
        'attributes' => [
            'title' => [
                'type' => AttributeType::TEXT,
                'name' => 'Title',
            ],
            'image' => [
                'type' => AttributeType::MEDIA,
                'name' => 'Image',
            ],
            'category' => [
                'type' => AttributeType::LISTING_ITEM,
                'name' => 'Blog Category',
            ],
        ],
    ],
];

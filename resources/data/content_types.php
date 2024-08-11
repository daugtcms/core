<?php

use Daugt\Enums\Blocks\AttributeType;
use Daugt\Enums\Content\ContentGroup;

return [
    'page' => [
        'name' => 'Page',
        'group' => ContentGroup::MARKETING,
        'categorized' => false,
        'listable' => false,
        'attributes' => [
        ],
    ],
    'blog' => [
        'name' => 'Blog',
        'group' => ContentGroup::CONTENT,
        'categorized' => true,
        'listable' => true,
        'attributes' => [
            'image' => [
                'type' => AttributeType::MEDIA,
                'name' => 'Image',
            ],
            'category' => [
                'type' => AttributeType::LISTING_ITEM,
                'name' => 'Blog Category',
                'options' => [
                    'type' => 'blog_categories'
                ]
            ],
        ],
    ],
];

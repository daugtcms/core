<?php

use Daugt\Enums\Blocks\AttributeType;
use Daugt\Enums\Content\ContentGroup;
use Daugt\Helpers\MemberArea\AccessHelper;

return [
    'page' => [
        'name' => 'Page',
        'path' => '',
        'group' => ContentGroup::MARKETING,
        'categorized' => false,
        'listable' => false,
        'attributes' => [
        ],
        'accessible' => true,
    ],
    'blog' => [
        'name' => 'Blog',
        'path' => 'blog',
        'group' => ContentGroup::CONTENT,
        'categorized' => true,
        'listable' => true,
        'attributes' => [
            'image' => [
                'type' => AttributeType::MEDIA,
                'name' => 'Image',
            ],
            'categories' => [
                'type' => AttributeType::LISTING_ITEM,
                'name' => 'Blog Categories',
                'options' => [
                    'listingType' => 'blog_categories',
                    'multi' => true
                ]
            ],
        ],
        'accessible' => true
    ],
    'post' => [
        'name' => 'Post',
        'path' => 'post',
        'group' => ContentGroup::CONTENT,
        'categorized' => false,
        'listable' => true,
        'attributes' => [
            'courseSection' => [
                'type' => AttributeType::LISTING_ITEM,
                'name' => 'Kurskategorie'
            ],
            'freeForAll' => [
                'type' => AttributeType::BOOLEAN,
                'name' => 'Freigeschaltet für jeden Kursteilnehmer (unabhängig von der Produktlaufzeit)'
            ]
        ],
        'accessible' => [AccessHelper::class, 'canAccessPost']
    ]
];

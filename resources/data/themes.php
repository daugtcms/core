<?php

use Daugt\Enums\Blocks\AttributeType;
use Daugt\Enums\Content\ContentGroup;

return [
    'default' => [
        'name' => 'Default',
        'blocks' => [
            'media' => [
                'name' => 'Medien',
                'viewPath' => __DIR__ . '/../views/blocks/media.blade.php',
                'description' => 'Can be used to display (multiple) media elements (images, videos, audio, ...)',
                'attributes' => [
                    'mediaList' => [
                        'type' => AttributeType::MEDIA,
                        'name' => 'Medien',
                        'options' => [
                            'multi' => true,
                            'withMetadata' => true
                        ]
                    ],
                    'showLabel' => [
                        'type' => AttributeType::BOOLEAN,
                        'name' => 'Show Label',
                        'description' => 'Whether or not to show a label (filename) for each media element'
                    ],
                    'maxItemHeight' => [
                        'type' => AttributeType::NUMBER,
                        'name' => 'Maximum item height',
                        'description' => 'The maximal height each item is given (in pixel)'
                    ]
                ],
                'groups' => [
                    ContentGroup::MARKETING,
                    ContentGroup::CONTENT
                ]
            ],
            'links' => [
                'name' => 'Links',
                'description' => 'Up to 3 links with optional text',
                'viewPath' => __DIR__ . '/../views/blocks/links.blade.php',
                'attributes' => [
                    'text' => [
                        'type' => AttributeType::TEXT,
                        'name' => 'Text',
                    ],
                    'link1' => [
                        'type' => AttributeType::LINK,
                        'name' => 'Link 1',
                    ],
                    'link2' => [
                        'type' => AttributeType::LINK,
                        'name' => 'Link 2',
                    ],
                    'link3' => [
                        'type' => AttributeType::LINK,
                        'name' => 'Link 3',
                    ],
                    'backgroundImage' => [
                        'type' => AttributeType::MEDIA,
                        'name' => 'Background Image',
                    ]
                ],
                'groups' => [
                    ContentGroup::MARKETING,
                    ContentGroup::CONTENT
                ]
            ],
            'featured-content-list' => [
                'name' => 'Featured Content List',
                'description' => 'List of featured content items',
                'viewPath' => __DIR__ . '/../views/blocks/featured-content-list.blade.php',
                'attributes' => [
                    'contentList' => [
                        'type' => AttributeType::CONTENT_LIST,
                        'name' => 'Content List',
                    ]
                ],
                'groups' => [
                    ContentGroup::MARKETING,
                ]
            ],
        ],
        'templates' => [
            'center-auth' => [
                'name' => 'Centered Authentication',
                'viewPath' => __DIR__ . '/../views/blocks/templates/center-auth.blade.php',
                'attributes' => [
                    'logo' => [
                        'type' => AttributeType::MEDIA,
                        'name' => 'Logo',
                    ],
                    'background' => [
                        'type' => AttributeType::MEDIA,
                        'name' => 'Background',
                    ]
                ],
                'usages' => [
                    'auth'
                ]
            ]
        ]
    ],

    'shop' => [
        'name' => 'Shop',
        'blocks' => [],
        'templates' => [
            'shop-product' => [
                'name' => 'Shop Product',
                'viewPath' => __DIR__ . '/../views/blocks/templates/shop-product.blade.php',
                'attributes' => [
                    'product' => [
                        'type' => AttributeType::PRODUCT,
                        'name' => 'Product',
                    ]
                ],
                'usages' => [
                    'shop_product'
                ]
            ],
            'shop-product-card' => [
                'name' => 'Shop Product Card',
                'viewPath' => __DIR__ . '/../views/blocks/templates/shop-product-card.blade.php',
                'attributes' => [
                    'product' => [
                        'type' => AttributeType::PRODUCT,
                        'name' => 'Product',
                    ]
                ],
                'usages' => [
                    'shop_product_card'
                ]
            ],
            'member-area' => [
                'name' => 'Member Area',
                'viewPath' => __DIR__ . '/../views/blocks/templates/member-area.blade.php',
                'attributes' => [
                    'logo' => [
                        'type' => AttributeType::MEDIA,
                        'name' => 'Logo',
                    ],
                    'background' => [
                        'type' => AttributeType::MEDIA,
                        'name' => 'Background',
                    ]
                ],
                'usages' => [
                    'member_area'
                ]
            ],
            'member-area-post' => [
                'name' => 'Member Area Post',
                'viewPath' => __DIR__ . '/../views/blocks/templates/member-area-post.blade.php',
                'attributes' => [
                    'content' => [
                        'type' => AttributeType::CONTENT,
                        'name' => 'Post',
                    ],
                    'image' => [
                        'type' => AttributeType::MEDIA,
                        'name' => 'Image'
                    ]
                ],
                'usages' => [
                    'post'
                ]
            ],
            'member-area-post-card' => [
                'name' => 'Member Area Post Card',
                'viewPath' => __DIR__ . '/../views/blocks/templates/member-area-post-card.blade.php',
                'attributes' => [
                    'content' => [
                        'type' => AttributeType::CONTENT,
                        'name' => 'Post',
                    ],
                    'image' => [
                        'type' => AttributeType::MEDIA,
                        'name' => 'Image'
                    ]
                ],
                'usages' => [
                    'post_card'
                ]
            ]
        ]
    ]
];
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
            ]
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
            ]
        ]
    ]
];
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
                        'title' => 'Logo',
                    ],
                    'background' => [
                        'type' => AttributeType::MEDIA,
                        'title' => 'Background',
                    ]
                ],
                'usages' => [
                    'auth'
                ]
            ]
        ]
    ],
];
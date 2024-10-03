<?php

use Daugt\Enums\Blocks\AttributeType;

return [
    'default' => [
        'name' => 'Default',
        'blocks' => [],
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
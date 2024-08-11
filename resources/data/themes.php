<?php

use Daugt\Enums\Blocks\AttributeType;

return [
    'default' => [
        'name' => 'Default',
        'blocks' => [],
        'templates' => [
            'center-auth' => [
                'name' => 'Centered Authentication',
                'viewName' => 'daugt::blocks.templates.center-auth',
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
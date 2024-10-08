<?php

use Daugt\Enums\Blocks\AttributeType;

return [
    'navigation' => [
        'name' => 'Navigation',
        'description' => 'A list of links.',
        'listAttributes' => [],
        'itemAttributes' => [
            'icon' => [
                'name' => 'Icon',
                'description' => 'The icon to display next to the link.',
                'type' => AttributeType::ICON,
            ],
            'url' => [
                'name' => 'URL',
                'description' => 'The URL the link points to.',
                'type' => AttributeType::TEXT,
            ],
            'new_tab' => [
                'name' => 'Open in new tab',
                'description' => 'Whether to open the link in a new tab.',
                'type' => AttributeType::BOOLEAN,
            ],
        ]
    ],
];
<?php

namespace Sitebrew\View\Blocks;

use Sitebrew\Enums\Blocks\AttributeType;

class Heading extends Block
{
    public static array $metadata = [
        'name' => 'Heading',
        'description' => 'A section for a heading with a subtitle',
        'viewName' => 'sitebrew::blocks.heading',
        'attributes' => [
            'title' => [
                'type' => AttributeType::TEXT,
                'title' => 'Title',
            ],
            'subtitle' => [
                'type' => AttributeType::TEXT,
                'title' => 'Subtitle',
            ],
            'alignment' => [
                'type' => AttributeType::CUSTOM_SELECT,
                'title' => 'Alignment',
                'options' => [
                    'left' => 'Left',
                    'center' => 'Center',
                    'right' => 'Right',
                ],
            ],
            'color' => [
                'type' => AttributeType::CUSTOM_SELECT,
                'title' => 'Color',
                'options' => [
                    'primary' => 'Primary',
                    'secondary' => 'Secondary',
                    'neutral' => 'Neutral',
                ],
            ],
        ],
    ];

    public function __construct(
        public string $title = '',
        public string $subtitle = '',
        public string $alignment = 'left',
        public string $color = 'neutral',
    ) {
        parent::__construct();
    }
}

<?php

namespace Sitebrew\View\Blocks;

use Sitebrew\Enums\Blocks\AttributeType;

class Header extends Block
{
    public static array $metadata = [
        'name' => 'Header',
        'description' => 'A simple header block',
        'viewName' => 'sitebrew::blocks.header',
        'attributes' => [
            'title' => [
                'type' => AttributeType::TEXT,
                'title' => 'Title',
                'description' => 'The top text',
            ],
            'subtitle' => [
                'type' => AttributeType::TEXT,
                'title' => 'Subtitle',
                'description' => 'The bottom text',
            ],
            'backgroundImage' => [
                'type' => AttributeType::IMAGE,
                'title' => 'Background Image',
            ],
        ],
    ];

    public function __construct(
        public string $title = '',
        public string $subtitle = '',
        public array $backgroundImage = [],
    ) {
        parent::__construct();
    }
}

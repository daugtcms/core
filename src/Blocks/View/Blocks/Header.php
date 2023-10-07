<?php

namespace Felixbeer\SiteCore\Blocks\View\Blocks;

use Felixbeer\SiteCore\Blocks\AttributeType;

class Header extends Block
{
    public static array $metadata = [
        'name' => 'Header',
        'description' => 'A simple header block',
        'viewName' => 'site-core::blocks.header',
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
        public string $backgroundImage = '',
    ) {
        parent::__construct();
    }
}

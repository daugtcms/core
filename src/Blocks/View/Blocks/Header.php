<?php

namespace Felixbeer\SiteCore\Blocks\View\Blocks;

class Header extends Block
{
    public static array $metadata = [
        'name' => 'Header',
        'description' => 'A simple header block',
        'viewName' => 'site-core::blocks.header',
        'attributes' => [
            'title' => [
                'type' => 'string',
                'title' => 'Title',
                'description' => 'The top text',
            ],
            'subtitle' => [
                'type' => 'string',
                'title' => 'Subtitle',
                'description' => 'The bottom text'
            ],
            'backgroundImage' => [
                'type' => 'image',
                'title' => 'Background Image'
            ]
        ]
    ];

    public function __construct(
        public string $title = '',
        public string $subtitle = '',
        public string $backgroundImage = '',
    )
    {
        parent::__construct();
    }
}

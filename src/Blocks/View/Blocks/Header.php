<?php

namespace Felixbeer\SiteCore\Blocks\View\Blocks;

use Closure;
use Felixbeer\SiteCore\Blocks\Attributes\Image;
use Illuminate\Contracts\View\View;

class Header extends Block
{
    public static array $metadata = [
        'name' => 'Header',
        'description' => 'A simple header block',
        'viewName' => 'site-core::blocks.header',
        'attributes' => [
            'title' => [
                'type' => 'string',
                'default' => 'Title'
            ],
            'subtitle' => [
                'type' => 'string',
                'default' => 'Subtitle'
            ],
            'backgroundImage' => [
                'type' => 'image',
                'default' => ''
            ]
        ]
    ];

    public static function getMetadata(): array
    {
        return self::$metadata;
    }

    public function __construct(
        public string $title = '',
        public string $subtitle = '',
        #[Image]
        public string $backgroundImage = '',
    )
    {
        //
    }
}

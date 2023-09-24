<?php

namespace Felixbeer\SiteCore\Blocks\View\Blocks;

use Closure;
use Felixbeer\SiteCore\Blocks\Attributes\Image;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Block extends Component
{

    public static array $metadata = [
        'name' => 'Example Block',
        'description' => 'A basic example of what a block looks like',
        'viewName' => 'site-core::blocks.block',
        'attributes' => [
        ]
    ];

    public static function getMetadata(): array
    {
        return self::$metadata;
    }

    public static function getAttributes(string $attributeName): array
    {
        return self::$metadata['attributes'][$attributeName];
    }

    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        // get_called_class():: is necessary as self:: returns the Block class instead of the actual child class
        return view(get_called_class()::getMetadata()['viewName']);
    }
}

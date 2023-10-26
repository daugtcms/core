<?php

namespace Sitebrew\Blocks\View\Blocks;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Block extends Component
{
    public string $uuid;

    public static array $metadata = [
        'name' => 'Example Block',
        'description' => 'A basic example of what a block looks like',
        'viewName' => 'sitebrew::blocks.block',
        'attributes' => [
        ],
    ];

    public static function getMetadata(): array
    {
        return get_called_class()::$metadata;
    }

    public function getAttributeValues(): array
    {
        $attributes = [];
        foreach (get_called_class()::getMetadata()['attributes'] as $attributeName => $attribute) {
            $attributes[$attributeName] = $this->$attributeName;
        }

        return $attributes;
    }

    public function __construct()
    {
        $this->uuid = Str::uuid();
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

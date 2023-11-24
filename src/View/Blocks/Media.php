<?php

namespace Sitebrew\View\Blocks;

use Sitebrew\Enums\Blocks\AttributeType;

class Media extends Block
{
    public static array $metadata = [
        'name' => 'Media',
        'description' => 'A section that can display a list of media items',
        'viewName' => 'sitebrew::blocks.media',
        'attributes' => [
            'mediaList' => [
                'type' => AttributeType::MEDIA,
                'title' => 'Media List',
                'description' => 'All media items that should be displayed in this section'
            ],
            'showLabel' => [
                'type' => AttributeType::BOOLEAN,
                'title' => 'Show Label',
                'description' => 'Whether or not to show the name of each item'
            ],
            'maxItemHeight' => [
                'type' => AttributeType::NUMBER,
                'title' => 'Max Item Height',
                'description' => 'The maximum height in pixel of each item in the list'
            ],
        ],
    ];

    public function __construct(
        public array $mediaList = [],
        public bool $showLabel = false,
        public int $maxItemHeight = 512,
    ) {
        parent::__construct();
    }
}

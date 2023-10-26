<?php

namespace Sitebrew\View\Blocks;

use Sitebrew\Enums\Blocks\AttributeType;

class FullWidthHeader extends Block
{
    public static array $metadata = [
        'name' => 'Full Width Header',
        'description' => 'A header block that spans across the entire width of the page',
        'viewName' => 'sitebrew::blocks.full-width-header',
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
            'personImage' => [
                'type' => AttributeType::IMAGE,
                'title' => 'Person Image',
                'description' => 'Picture of a person, cut out with a transparent background',
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
        public string $personImage = '',
        public string $backgroundImage = '',
    ) {
        parent::__construct();
    }
}

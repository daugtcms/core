<?php

namespace Daugt\View\Blocks;

use Daugt\Enums\Blocks\AttributeType;

class FullWidthHeader extends Block
{
    public static array $metadata = [
        'name' => 'Full Width Header',
        'description' => 'A header block that spans across the entire width of the page',
        'viewName' => 'daugt::blocks.full-width-header',
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
                'type' => AttributeType::MEDIA,
                'title' => 'Person Image',
                'description' => 'Picture of a person, cut out with a transparent background',
            ],
            'backgroundImage' => [
                'type' => AttributeType::MEDIA,
                'title' => 'Background Image',
            ],
        ],
    ];

    public function __construct(
        public string $title = '',
        public string $subtitle = '',
        public array $personImage = [],
        public array $backgroundImage = [],
    ) {
        parent::__construct();
    }
}

<?php

namespace Sitebrew\View\Blocks;

use Sitebrew\Enums\Blocks\AttributeType;

class Spacer extends Block
{
    public static array $metadata = [
        'name' => 'Spacer',
        'description' => 'Add space between blocks',
        'viewName' => 'sitebrew::blocks.spacer',
        'attributes' => [
            'height' => [
                'type' => AttributeType::NUMBER,
                'title' => 'Height',
                'description' => 'The height of the spacer in pixels',
            ],
        ],
    ];

    public function __construct(
        public ?int $height = 25,
    ) {
        parent::__construct();
    }
}

<?php

namespace Sitebrew\View\Blocks;

use Sitebrew\Enums\Blocks\AttributeType;

class Text extends Block
{
    public static array $metadata = [
        'name' => 'Text',
        'description' => 'A section to display formatted text',
        'viewName' => 'sitebrew::blocks.text',
        'attributes' => [
            'text' => [
                'type' => AttributeType::RICH_TEXT,
                'title' => 'Text',
                'description' => 'The text that will be displayed in this block'
            ],
        ],
    ];

    public function __construct(
        public string $text = '',
    ) {
        parent::__construct();
    }
}

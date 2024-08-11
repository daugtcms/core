<?php

namespace Daugt\View\Blocks;

use Daugt\Enums\Blocks\AttributeType;

class Text extends Block
{
    public static array $metadata = [
        'name' => 'Text',
        'description' => 'A section to display formatted text',
        'viewName' => 'daugt::blocks.text',
        'attributes' => [
            'text' => [
                'type' => AttributeType::RICH_TEXT,
                'title' => 'Text',
                'description' => 'The text that will be displayed in this block'
            ],
            'fullWidth' => [
                'type' => AttributeType::BOOLEAN,
                'title' => 'Full Width',
                'description' => 'Whether or not the text should be displayed full width'
            ],
        ],
    ];

    public function __construct(
        public string $text = '',
        public bool $fullWidth = false,
    ) {
        parent::__construct();
    }
}

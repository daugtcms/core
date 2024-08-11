<?php

namespace Daugt\View\Blocks\Templates;

use Daugt\Models\Content\Content;
use Daugt\Models\Shop\Product;
use Daugt\View\Blocks\Block as DaugtBlock;
use Daugt\Enums\Blocks\AttributeType;

class BlogOverview extends DaugtBlock
{
    public static array $metadata = [
        'viewName' => 'daugt::blocks.templates.blog-overview',
        'attributes' => [
            'title' => [
                'type' => AttributeType::TEXT,
                'title' => 'Title',
            ],
            'subtitle' => [
                'type' => AttributeType::TEXT,
                'title' => 'Subtitle',
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
        public array $backgroundImage = [],
    ) {
        parent::__construct();
    }
}

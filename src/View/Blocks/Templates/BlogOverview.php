<?php

namespace Sitebrew\View\Blocks\Templates;

use Sitebrew\Models\Content\Content;
use Sitebrew\Models\Shop\Product;
use Sitebrew\View\Blocks\Block as SitebrewBlock;
use Sitebrew\Enums\Blocks\AttributeType;

class BlogOverview extends SitebrewBlock
{
    public static array $metadata = [
        'viewName' => 'sitebrew::blocks.templates.blog-overview',
        'attributes' => [
            'title' => [
                'type' => AttributeType::TEXT,
                'title' => 'Title',
            ],
            'subtitle' => [
                'type' => AttributeType::TEXT,
                'title' => 'Subtitle',
            ],
        ],
    ];

    public function __construct(
        public string $title = '',
        public string $subtitle = '',
    ) {
        parent::__construct();
    }
}

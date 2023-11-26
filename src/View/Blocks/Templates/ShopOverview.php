<?php

namespace Sitebrew\View\Blocks\Templates;

use Sitebrew\Models\Shop\Product;
use Sitebrew\View\Blocks\Block as SitebrewBlock;
use Sitebrew\Enums\Blocks\AttributeType;

class ShopOverview extends SitebrewBlock
{
    public static array $metadata = [
        'viewName' => 'sitebrew::blocks.templates.shop-overview',
        'attributes' => [
            'title' => [
                'type' => AttributeType::TEXT,
                'title' => 'Title',
            ],
            'description' => [
                'type' => AttributeType::TEXT,
                'title' => 'Description',
            ],
            'backgroundImage' => [
                'type' => AttributeType::MEDIA,
                'title' => 'Background Image',
            ],
        ],
    ];

    public function __construct(
        public string $title = '',
        public string $description = '',
        public array $backgroundImage = [],
    ) {
        parent::__construct();
    }
}

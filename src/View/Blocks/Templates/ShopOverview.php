<?php

namespace Daugt\View\Blocks\Templates;

use Daugt\Models\Shop\Product;
use Daugt\View\Blocks\Block as DaugtBlock;
use Daugt\Enums\Blocks\AttributeType;

class ShopOverview extends DaugtBlock
{
    public static array $metadata = [
        'viewName' => 'daugt::blocks.templates.shop-overview',
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

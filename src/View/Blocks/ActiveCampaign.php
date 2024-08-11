<?php

namespace Daugt\View\Blocks;

use Daugt\Enums\Blocks\AttributeType;

class ActiveCampaign extends Block
{
    public static array $metadata = [
        'name' => 'Active Campaign',
        'description' => 'A section containing an Active Campaign newsletter signup form.',
        'viewName' => 'daugt::blocks.active-campaign',
        'attributes' => [
            'title' => [
                'type' => AttributeType::TEXT,
                'title' => 'Title',
            ],
            'description' => [
                'type' => AttributeType::TEXT,
                'title' => 'Description',
            ],
            'url' => [
                'type' => AttributeType::TEXT,
                'title' => 'Active Campaign URL',
            ],
            'key' => [
                'type' => AttributeType::TEXT,
                'title' => 'Active Campaign Key',
            ]
        ],
    ];

    public function __construct(
        public string $title = '',
        public string $description = '',
        public string $url = '',
        public string $key = '',
    ) {
        parent::__construct();
    }
}

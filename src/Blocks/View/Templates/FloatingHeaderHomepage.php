<?php

namespace Sitebrew\Blocks\View\Templates;

use Sitebrew\Blocks\AttributeType;
use Sitebrew\Blocks\View\Blocks\Block;

class FloatingHeaderHomepage extends Block
{
    public static array $metadata = [
        'viewName' => 'sitebrew::blocks.templates.floating-header-homepage',
        'attributes' => [
            'transparentNavigation' => [
                'type' => AttributeType::BOOLEAN,
                'title' => 'Transparent Navigation',
                'description' => 'Whether the navigation should be transparent or not',
            ],
            'mainNavigation' => [
                'type' => AttributeType::NAVIGATION,
                'title' => 'Main Navigation',
            ],
            'logo' => [
                'type' => AttributeType::IMAGE,
                'title' => 'Logo',
            ],
        ],
    ];

    public function __construct(
        public bool $transparentNavigation = false,
        public int $mainNavigation = 0,
        public string $logo = '',
    ) {
        parent::__construct();
    }
}

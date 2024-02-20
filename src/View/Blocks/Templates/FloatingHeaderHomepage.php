<?php

namespace Sitebrew\View\Blocks\Templates;

use Sitebrew\View\Blocks\Block as SitebrewBlock;
use Sitebrew\Enums\Blocks\AttributeType;

class FloatingHeaderHomepage extends SitebrewBlock
{
    public static array $metadata = [
        'viewName' => 'sitebrew::blocks.templates.floating-header-homepage',
        'attributes' => [
            'title' => [
                'type' => AttributeType::TEXT,
                'title' => 'Title',
            ],
            'transparentNavigation' => [
                'type' => AttributeType::BOOLEAN,
                'title' => 'Transparent Navigation',
                'description' => 'Whether the listing should be transparent or not',
            ],
            'mainNavigation' => [
                'type' => AttributeType::NAVIGATION,
                'title' => 'Main Navigation',
            ],
            'logo' => [
                'type' => AttributeType::MEDIA,
                'title' => 'Logo',
            ],
            'footerNavigation' => [
                'type' => AttributeType::NAVIGATION,
                'title' => 'Footer Navigation',
            ],
            'socialMediaLinks' => [
                'type' => AttributeType::NAVIGATION,
                'title' => 'Social Media Links',
            ]
        ],
    ];

    public function __construct(
        public string $title = '',
        public bool $transparentNavigation = false,
        public int $mainNavigation = 0,
        public array $logo = [],
        public int $footerNavigation = 0,
        public int $socialMediaLinks = 0,
    ) {
        parent::__construct();
    }
}

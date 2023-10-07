<?php

namespace Felixbeer\SiteCore\Blocks\View\Templates;

use Felixbeer\SiteCore\Blocks\AttributeType;
use Felixbeer\SiteCore\Blocks\View\Blocks\Block;

class Homepage extends Block
{
    public static array $metadata = [
        'viewName' => 'site-core::templates.homepage',
        'attributes' => [
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
        public string $mainNavigation = '',
        public string $logo = '',
    ) {
        parent::__construct();
    }
}
